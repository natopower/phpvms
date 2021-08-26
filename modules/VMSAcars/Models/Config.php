<?php

namespace Modules\VMSAcars\Models;

use App\Contracts\Model;

/**
 * @property string id
 * @property string name
 * @property string value
 * @property string default
 * @property int    order
 * @property string type
 * @property string options
 * @property string description
 */
class Config extends Model
{
    public $table = 'vmsacars_config';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'value',
        'options',
        'description',
    ];
}
