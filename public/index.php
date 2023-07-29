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

$router->addRoute('GET', '/test', function () {
   
    echo "Merhaba";

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

$router->addRoute("GET", "/storage/*", function () use ($router) {
    if(str_contains($router->ruri, "../"))
    {return;}

    $fway = configs_site_rootfolder . "/storage/". str_replace("/storage", "", $router->ruri);


    if(!file_exists($fway))
    {
        echo "Böyle bir dosya yok...";
        Router::Route( !empty($_GET["BackUri"]) ? $_GET["BackUri"] : "/u" , 3);
        die();
    }

    $fname = explode("/",$fway);
    $fname = end($fname);
        
    //Define header information
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: 0");
    header('Content-Disposition: attachment; filename="'. $fname .'"');
    header('Content-Length: ' . filesize($fway));
    header('Pragma: public');

    //Clear system output buffer
    flush();

    //Read the size of the file
    readfile($fway);
});

$router->handleRequest($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);