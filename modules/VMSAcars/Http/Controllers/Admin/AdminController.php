<?php

namespace Modules\VMSAcars\Http\Controllers\Admin;

use App\Contracts\Controller;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Modules\VMSAcars\Models\Config;
use Modules\VMSAcars\Models\Rule;
use Modules\VMSAcars\Services\LicenseService;

class AdminController extends Controller
{
    private $licenseSvc;

    public function __construct(LicenseService $licenseSvc)
    {
        $this->licenseSvc = $licenseSvc;
    }

    public function index()
    {
        $config = Config::select('*')->orderBy('order', 'asc')->get();
        $rules = Rule::select('*')->orderBy('order', 'asc')->get();

        return view('vmsacars::admin.index', [
            'all_config' => $config,
            'all_rules'  => $rules,
        ]);
    }

    public function config(Request $request)
    {
        // Update the config, and check the license at the end
        $config = Config::select(['id', 'value'])->get();

        foreach ($config as $c) {
            $value = $request->input($c->id);
            $c->value = trim($value);
            $c->save();
        }

        // Validate license, redirect with error if its invalid
        if (!empty($request->input('license_key'))) {
            $check = $this->licenseSvc->validateLicense($request->input('license_key'));
            if($check['error'] === true) {
                Flash::error('Error validating license: '.$check['message']);
            } else {
                Flash::success('License validated!');
            }
        }

        return redirect(route('vmsacars.admin.index'));
    }

    public function rules(Request $request)
    {
        // Update the rules
        $rules = Rule::all();
        foreach($rules as $rule) {
            if($rule->has_parameter) {
                $rule->parameter = $request[$rule->id.'_parameter'];
            }

            $rule->points = $request[$rule->id.'_points'];
            $rule->delay = $request[$rule->id.'_delay'];
            $rule->cooldown = $request[$rule->id.'_cooldown'];
            $rule->repeatable = get_truth_state($request[$rule->id.'_repeatable']);
            $rule->enabled = get_truth_state($request[$rule->id.'_enabled']);
            $rule->save();
        }

        return redirect(route('vmsacars.admin.index'));
    }
}
