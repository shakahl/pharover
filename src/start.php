<?php

if (file_exists(__DIR__.'/../../autoload.php'))
{
    require __DIR__.'/../../autoload.php';
}
else
{
    require __DIR__.'/../vendor/autoload.php';
}

define('APP_DIR', realpath(__DIR__ . '/../'));

use App\Application;

$application = new Application(APP_DIR);
$application->run();

