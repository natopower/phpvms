<?php

use Illuminate\Support\Facades\DB;
use Modules\VMSAcars\Contracts\Migration;

/**
 * Remove the rule for beacon lights on during taxi phase
 */
class RemoveEngineStartTaxi extends Migration
{
    public function up()
    {
        DB::table('vmsacars_config')
            ->where(['id' => 'check_engine_start_taxi_out'])
            ->delete();
    }

    public function down()
    {

    }
}
