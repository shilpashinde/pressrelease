<?php

define("DS", DIRECTORY_SEPARATOR);
session_start();

function games_autoload($class) {
    $path = dirname(dirname(__FILE__));
    $filename0 = $path . DS . strtolower($class) . DS . 'class.' . strtolower($class) . ".php";
    $filename1 = $path . DS . "Library" . DS . strtolower($class) . DS . 'class.' . strtolower($class) . ".php";

    $cArray = explode("_", $class);
    $filename2 = $path . DS . "Library" . DS . (isset($cArray[1]) ? strtolower($cArray[1]) . DS : "") . 'class.' . $cArray[0] . ".php";
    if (defined("SYSTEM_PATH"))
        $filename3 = SYSTEM_PATH . DS . "controllers" . DS . $class . ".php";
    else
        $filename3 = $path . DS . "controllers" . DS . $class . ".php";
    $filename4 = $path . DS . "Library" . DS . (isset($cArray[1]) ? strtolower($cArray[1]) . DS : "") . 'class.' . strtolower($cArray[0]) . ".php";


    if (file_exists($filename0))
        include_once $filename0;
    elseif (file_exists($filename1))
        include_once $filename1;
    elseif (file_exists($filename2))
        include_once $filename2;
    elseif (file_exists($filename3))
        include_once $filename3;
    elseif (file_exists($filename4))
        include_once $filename4;
}

spl_autoload_register("games_autoload");