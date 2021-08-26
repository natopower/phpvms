<?php

namespace Modules\VMSAcars\Contracts;

use App\Support\Database;
use Illuminate\Support\Facades\Log;

abstract class Migration extends \App\Contracts\Migration
{
    public function seedFile($file): void
    {
        try {
            $path = base_path('modules/VMSAcars/Database/seeds/'.$file);
            Database::seed_from_yaml_file($path, false);
        } catch (\Exception $e) {
            Log::error('Unable to load '.$file.' file');
            Log::error($e);
        }
    }
}
