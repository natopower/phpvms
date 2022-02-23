<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Modules\VMSAcars\Contracts\Migration;

class AddOrderColumn extends Migration
{
    public function up()
    {
        Schema::table('vmsacars_rules', function (Blueprint $table) {
            $table->unsignedSmallInteger('order')->after('cooldown')->default(0);
        });

        //$this->seedFile('rules.yml');
    }

    public function down()
    {

    }
}
