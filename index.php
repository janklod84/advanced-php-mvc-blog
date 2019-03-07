<?php 
/*
|---------------------------------------------
|          MVC FRAMEWORK APLLICATION
|---------------------------------------------
*/
# http://localhost/blog/

require __DIR__.'/vendor/System/Application.php';
require __DIR__.'/vendor/System/File.php';

use System\File;
use System\Application;


if(!version_compare(PHP_VERSION, '5.6', '>='))
{
    die("This application use php version >= 5.6, but your current version is [". PHP_VERSION."]");
}

$file = new File(__DIR__);
$app  = Application::getInstance($file);

$app->run();

