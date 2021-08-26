<?php

use Modules\VMSAcars\Contracts\Migration;

class AddBidsConfig extends Migration
{
    public function up()
    {
        $this->seedFile('settings.yml');
    }

    public function down()
    {

    }
}
