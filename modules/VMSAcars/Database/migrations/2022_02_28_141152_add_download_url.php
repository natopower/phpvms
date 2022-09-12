<?php

use Modules\VMSAcars\Contracts\Migration;

class AddDownloadUrl extends Migration
{
    public function up()
    {
        $this->seedFile('settings.yml');
        $this->seedFile('rules.yml');
    }

    public function down()
    {

    }
}
