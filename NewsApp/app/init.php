<?php

require 'core/config.php';

spl_autoload_register('myAutoLoader');

function myAutoLoader($fileName){
    $path="core/";
    $extension=".php";
    //var_dump($fullPath=$path . $fileName . $extension);
    $fullPath=$path . $fileName . $extension;

    include_once $fullPath;
}