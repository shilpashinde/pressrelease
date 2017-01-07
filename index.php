<?php

ini_set("display_errors", E_ALL);
error_reporting(E_ALL);



define("NO_DIRECT", TRUE);
define('SYSTEM_PATH', dirname(__FILE__));

include_once dirname(__FILE__).DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."autoload.php";

$controller = isset($_GET['q']) ? ucfirst($_GET['q']) : "Home";
$controller.="Controller";



$method = isset($_GET['action']) ? $_GET['action'] : "index";

try {
    if (class_exists($controller))
        $controller = @new $controller;
    else
        throw new Exception("Cannot Load $controller");
    if (is_object($controller) && method_exists($controller, $method))
        $controller->$method();
    else
        throw new Exception("Method Doesn't Exist");
} catch (Exception $e) {

    echo $e->getMessage();
}