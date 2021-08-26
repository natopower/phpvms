<?php

use Modules\VMSAcars\Contracts\Migration;

class ResetRules extends Migration
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
