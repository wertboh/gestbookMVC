<?php
session_start();

use application\core\Route;

spl_autoload_register(function($className) {
    $file =  str_replace('\\', '/', $className . '.php');
    if (file_exists($file)) {
        require $file;
    }
});

$route = new Route();
$route->path_route();
