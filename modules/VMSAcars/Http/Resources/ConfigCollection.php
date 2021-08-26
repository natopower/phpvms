<?php

namespace Modules\VMSAcars\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Map the config into a flat key-value pair set
 *
 */
class ConfigCollection extends ResourceCollection
{
    private static $int_keys = [
        'acars_update_timer',
        'position_report_ground',
        'position_report_under_transition',
        'position_report_above_transition',
    ];

    /**
     * @param $obj
     *
     * @return bool|int
     */
    private static function mapField($obj)
    {
        // Special mapping of keys to ints (these are select boxes)
        if (in_array($obj->id, static::$int_keys)) {
            return (int) $obj->value;
        }

        if ($obj->type === 'int') {
            return (int) $obj->value;
        }

        if ($obj->type === 'bool' || $obj->type === 'boolean') {
            return get_truth_state($obj->value);
        }

        return $obj->value;
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $ret = [];

        foreach ($this->collection as $obj) {
            $ret[$obj->id] = static::mapField($obj);
        }

        return $ret;
    }
}
