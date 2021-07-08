<?php
use application\core\Route;
//require_once 'application/core/bootstrap.php';
spl_autoload_register(function($className) {
    $file =  str_replace('\\', '/', $className . '.php');
    if (file_exists($file)) {
        require $file;
    }
});

$route = new Route();
$route->path_route();
