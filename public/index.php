<?php

//die(var_dump($_SERVER));
//die (phpinfo());

require $_SERVER["DOCUMENT_ROOT"]. "/app/Kernel.php";

use app\route\Router;
use app\route\RouterGroup;



\app\database\FFDatabase::cfun()->init();

$router = Router::cfun();

$router->addRoute('GET', '/', function () {
    \app\view\View::Show("home", \app\assignments\view\PAGETYPES::PAGE_TYPE_NORMAL);
});

$router->addRoute('GET', '/login', function () {
    \app\view\View::Show("login", \app\assignments\view\PAGETYPES::PAGE_TYPE_NORMAL);

});

$router->addRoute('POST', '/login', function () {
    header("Content-Type: Application/json");

    header("Location: /login?err=Invalid Credentials...");
});



$router->handleRequest($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);