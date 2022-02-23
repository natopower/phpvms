<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
    }

    public function down()
    {

    }
}
