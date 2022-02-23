<?php

use Modules\VMSAcars\Contracts\Migration;

class RemoveOldDiscordId extends Migration
{
    public function up()
    {
        DB::table('vmsacars_config')
            ->where(['id' => 'discord_client_id'])
            ->delete();

        //$this->seedFile('settings.yml');
        //$this->seedFile('rules.yml');
    }

    public function down()
    {

    }
}
