<?php

if (!defined('LUMEN_START')) {
    define('LUMEN_START', microtime(true));
}

include_once __DIR__.'/application.php';

$app = new Application();
$app->bindInterfaces();

if ((env('APP_DEBUG'))) {
    $app->register(Barryvdh\Debugbar\LumenServiceProvider::class);
   }

return $app;
