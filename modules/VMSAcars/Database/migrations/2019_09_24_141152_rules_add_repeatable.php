<?php

use App\Support\Database;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class RulesAddRepeatable extends Migration
{
    public function up()
    {
        Schema::table('vmsacars_rules', function (Blueprint $table) {
            $table->boolean('repeatable')->after('parameter')->nullable();
            $table->unsignedSmallInteger('delay')->after('repeatable')->default(0);
            $table->unsignedSmallInteger('cooldown')->after('delay')->default(30);
        });

        try {
            $path = base_path('modules/VMSAcars/Database/seeds/rules.yml');
            Database::seed_from_yaml_file($path, false);
        } catch (Exception $e) {
            Log::error('Unable to load rules.yml file');
            Log::error($e);
        }
    }

    public function down()
    {

    }
}
