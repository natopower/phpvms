<?php

use Illuminate\Support\Facades\DB;
use Modules\VMSAcars\Contracts\Migration;

/**
 * Remove the rule for beacon lights on during taxi phase
 */
class RemoveBeaconLightsRule extends Migration
{
    public function up()
    {
        DB::table('vmsacars_rules')
            ->where(['id' => 'BEACON_LIGHTS_ON'])
            ->delete();
    }

    public function down()
    {

    }
}
