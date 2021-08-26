<?php

namespace Modules\VMSAcars\Http\Controllers\Api;

use App\Contracts\Controller;
use App\Models\PirepField;
use Illuminate\Http\Request;
use Modules\VMSAcars\Http\Resources\ConfigCollection;
use Modules\VMSAcars\Http\Resources\PirepField as PirepFieldResource;
use Modules\VMSAcars\Http\Resources\Rule as RuleResource;
use Modules\VMSAcars\Models\Config;
use Modules\VMSAcars\Models\Rule;

class ApiController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function config(Request $request)
    {
        $config = Config::select(['id', 'type', 'value'])->orderBy('order', 'asc')->get();
        $fields = PirepField::all();

        $res = (new ConfigCollection($config))->toArray($request);
        $res['fields'] = PirepFieldResource::collection($fields);
        $res['plugins'] = [];
        $res['rules'] = $this->rules($request);
        $res['settings'] = [
            
        ];
        $res['units'] = [
            'd' => setting('units.distance'),
            'f' => setting('units.fuel'),
            's' => setting('units.speed'),
            't' => setting('units.temperature'),
            'v' => setting('units.volume'),
            'w' => setting('units.weight'),
        ];

        return response()->json($res);
    }

    /**
     * Return all of the rules
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function rules(Request $request)
    {
        $rules = Rule::where(['enabled' => true])->get();
        return RuleResource::collection($rules);
    }

    public function plugins(Request $request)
    {

    }
}
