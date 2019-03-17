<?php

if(!version_compare(PHP_VERSION, '5.6', '>='))
{
    die("This application use php version >= 5.6, but your current version is [". PHP_VERSION."]");
}