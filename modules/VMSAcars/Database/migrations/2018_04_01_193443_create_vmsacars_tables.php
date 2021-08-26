<?php

use App\Contracts\Migration;
use App\Support\Database;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateVMSAcarsTables extends Migration
{
    /**
     * Create the files table. Acts as a morphable
     * @return void
     */
    public function up()
    {
        Schema::create('vmsacars_rules', function (Blueprint $table) {
            $table->string('id', 50);
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('parameter')->nullable();
            $table->unsignedInteger('points')->default(5);
            $table->boolean('enabled')->default(true);
            $table->boolean('has_parameter')->default(true);
            $table->timestamps();
            $table->primary('id');
        });

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
