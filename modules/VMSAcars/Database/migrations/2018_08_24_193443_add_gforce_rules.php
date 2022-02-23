<?php

use App\Contracts\Migration;
use Illuminate\Support\Facades\Schema;

class AddGForceRules extends Migration
{
    /**
     * Create the files table. Acts as a morphable
     * @return void
     */
    public function up()
    {
//        try {
//            $path = base_path('modules/VMSAcars/Database/seeds/rules.yml');
//            Database::seed_from_yaml_file($path, false);
//        } catch (Exception $e) {
//            Log::error('Unable to load rules.yml file');
//            Log::error($e);
//        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vmsacars_rules');
    }
}
