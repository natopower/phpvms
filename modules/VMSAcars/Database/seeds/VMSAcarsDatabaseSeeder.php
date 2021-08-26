<?php

namespace Modules\VMSAcars\Database\seeders\Database\Seeders;

use App\Support\Database;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class VMSAcarsDatabaseSeeder extends Seeder
{
    public function run()
    {
        Log::info('VMSACARS Database seeder');
        Model::unguard();

        $this->seedFile('rules.yml');
        $this->seedFile('settings.yml');
    }

    private function seedFile($file): void
    {
        try {
            $path = base_path('modules/VMSAcars/Database/seeds/'.$file);
            Database::seed_from_yaml_file($path, false);
        } catch (Exception $e) {
            Log::error('Unable to load '.$file.' file');
            Log::error($e);
        }
    }
}
