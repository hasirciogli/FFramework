<?php

namespace app\controllers;
use app\assignments\view\PAGETYPES;
use app\view\View;

class LocalDevelopmentPanelController extends \app\model\LocalDevelopmentPanelModel
{

    /**
     * @param \app\route\RouterGroup $routerGroup
     * @param \app\route\Router $router
     * @return void
     */
    public function use (\app\route\RouterGroup $routerGroup, \app\route\Router $router): void
    {
        $router->staticMiddleware("app\\middlewares\\AuthMiddleware@handle", [
            "app\\middlewares\\AuthMiddleware@IsAuthed",
            "app\\middlewares\\AuthMiddleware@IsAdmin",
        ], true);

        die(getHostByName(getHostName()));

        if(getHostByName(getHostName()) != $_SERVER["REMOTE_ADDR"])
            die("Buraya sadece local pc den erişebilirsin.");

        if($router->ruri == "/ldp")
            $router::Route("/ldp/home");

        $routerGroup->addRoute("GET", "/:subpage", function (...$extraParams) use ($routerGroup, $router) {
            View::Show("home/index", PAGETYPES::PAGE_TYPE_LDP);
        });
    }



    /**
     * @static
     * @return LocalDevelopmentPanelController
     */
    public static function cfun(): LocalDevelopmentPanelController
    {
        return new LocalDevelopmentPanelController();
    }
}

?>