<?php 
date_default_timezone_set('Europe/Moscow');

/*
|---------------------------------------------
|          MVC FRAMEWORK APLLICATION
|---------------------------------------------
*/

require __DIR__.'/vendor/autoload.php';


use System\File;
use System\Application;


$file = new File(__DIR__); 
$app  = Application::getInstance($file);

$app->run();

