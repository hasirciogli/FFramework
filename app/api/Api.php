<?php 

namespace app\api;

use app\route\Router;
use app\route\RouterGroup;

class Api {
    public function __construct(Type $var = null) {
        $this->var = $var;
    }

    public function use(Router $router, RouterGroup $routerGroup = null){

        $routerGroup->addRoute("GET", "", function () use ($router) {
            echo "Hello World";
        });

        $routerGroup->addRoute("GET", "/:serviceProvider", function () use ($router) {
            echo "ServiceProvider: " . $router->getParam("serviceProvider");
        });


        $routerGroup->addRoute("GET", "/:serviceProvider/:serviceProviderService", function () use ($router) {
            echo "ServiceProvider: " . $router->getParam("serviceProvider") . " | Service: " . $router->getParam("serviceProviderService");
        });

        $routerGroup->addRoute("GET", "/:serviceProvider/:serviceProviderService/:serviceFunction", function () use ($router) {
            echo "ServiceProvider: " . $router->getParam("serviceProvider") . " | Service: " . $router->getParam("serviceProviderService") . " | Service Function: " . $router->getParam("serviceFunction");
        });
    }



    public static function cfun() : Api {
        return new Api();
    }
}

?>