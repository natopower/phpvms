<?php

use Modules\VMSAcars\Contracts\Migration;

class RemoveOldDiscordId extends Migration
{
    public function up()
    {
        DB::table('vmsacars_config')
            ->where(['id' => 'discord_client_id'])
            ->delete();
    }

    public function down()
    {

    }
}