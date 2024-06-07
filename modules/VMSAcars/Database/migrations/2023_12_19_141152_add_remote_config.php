<?php

use Modules\VMSAcars\Contracts\Migration;

return new class() extends Migration {
    public function up()
    {
        $this->seedFile('settings.yml');
        $this->seedFile('rules.yml');
    }

    public function down()
    {

    }
};