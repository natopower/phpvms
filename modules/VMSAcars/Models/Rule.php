<?php

namespace Modules\VMSAcars\Models;

use App\Contracts\Model;

/**
 * @property string $id
 * @property string $name
 * @property string $description
 * @property number $points
 * @property number $parameter
 * @property bool   $has_parameter
 * @property bool   $repeatable
 * @property number $delay
 * @property number $cooldown
 * @property bool   $enabled
 * @package Modules\VMSAcars\Models
 */
class Rule extends Model
{
    public $table = 'vmsacars_rules';
    public $incrementing = false;

    public $fillable = [
        'parameter',
        'repeatable',
        'cooldown',
        'delay',
        'enabled',
    ];

    protected $casts = [
	    'parameter'     => 'integer',
        'repeatable'    => 'bool',
        'delay'         => 'integer',
        'cooldown'      => 'integer',
        'enabled'       => 'bool',
        'has_parameter' => 'bool',
    ];
}
