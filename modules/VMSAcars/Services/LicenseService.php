<?php

namespace Modules\VMSAcars\Services;

use App\Support\Utils;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Log;

class LicenseService
{
    private static $license_url = 'https://vmshost.io';

    /**
     * @param string $licenceKey
     *
     * @return bool|array False if failed
     */
    public function validateLicense(string $licenceKey)
    {
        $domain = Utils::getRootDomain(config('app.url'));

        $check_token = time().md5(mt_rand(100000000, mt_getrandmax()).$licenceKey);
        $body = [
            'licensekey' => $licenceKey,
            'domain'     => $domain,
            'ip'         => '',
            'dir'        => '',
            'checktoken' => $check_token,
        ];

        $query_string = '';
        foreach ($body AS $k => $v) {
            $query_string .= $k.'='.urlencode($v).'&';
        }

        Log::info('Validating ACARS license, domain='.$domain.', checktoken='.$check_token);

        $client = new GuzzleClient(['base_uri' => static::$license_url]);
        $response = $client->post('/modules/servers/licensing/verify.php', [
            'form_params' => $body,
        ]);

        $body = $response->getBody()->getContents();

        if ($response->getStatusCode() !== 200) {
            Log::error('Error with license: '.$body);
            return ['error' => true, 'message' => $body];
        }

        $results = [
            'error' => false,
        ];

        preg_match_all('/<(.*?)>([^<]+)<\/\\1>/i', $body, $matches);
        foreach ($matches[1] AS $k => $v) {
            $results[$v] = $matches[2][$k];
        }

        if ($results['status'] !== 'Active') {
            Log::error('Error in license validation='.$body);
            $results['error'] = true;
        }

        return $results;
    }
}
