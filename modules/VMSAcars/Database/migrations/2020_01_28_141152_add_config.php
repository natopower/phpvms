<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\VMSAcars\Contracts\Migration;

class AddConfig extends Migration
{
    public function up()
    {
        Schema::create('vmsacars_config', function (Blueprint $table) {
            $table->string('id');
            $table->unsignedInteger('order')->default(99);
            $table->string('name');
            $table->string('value');
            $table->string('default')->nullable();
            $table->string('type')->nullable();
            $table->text('options')->nullable();
            $table->string('description')->nullable();

            $table->primary('id');
            $table->timestamps();
        });
    }

    public function down()
    {

    }
}
