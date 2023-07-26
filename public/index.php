<?php

//die(var_dump($_SERVER));
//die (phpinfo());

require $_SERVER["DOCUMENT_ROOT"]. "/app/Kernel.php";

use app\route\Router;
use app\route\RouterGroup;

$router = Router::cfun();

$router->addRoute('GET', '/', function () {
    \app\view\View::Show("home", \app\assignments\view\PAGETYPES::PAGE_TYPE_NORMAL);
});

$router->group( '/hello', function ($routerGroup) use ($router) {

    $routerGroup->addRoute("GET", "", function () use ($router) {
        echo "Hello";
    });

    $routerGroup->addRoute("GET", "bro", function () use ($router) {
        echo "Hello bro";
    });

    $routerGroup->addRoute("GET", "bro/:name", function () use ($router) {
        echo "Hello bro " . $router->getParam("name");
    });

    $routerGroup->addRoute("GET", "bro/:name/comein", function () use ($router) {
        echo "Hello bro " . $router->getParam("name"). " Welcome Back! come in >";
    });
});

$router->handleRequest($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);