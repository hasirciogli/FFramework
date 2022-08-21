<?php

require $_SERVER["DOCUMENT_ROOT"] . "/app/Kernel.php";

use Router\Router;
use View\View;
use View\pageTypes;
use UserController\UserController;
use SessionController\SessionController;

$RouteSideUserController = new UserController();

if (framework_is_debug_mode){
    Router::get("/debug_display_errors", function (){
        View::Show("display_error", pageTypes::PAGE_TYPE_DERROR);
        die();
    });
}

function chkmntc(){
    if(\AuthController\AuthController::isLogged() && \AuthController\AuthController::isAdmin())
        return true;

        // TODO: check maintenance mod is open in your database;

    if("maintenance_mode" == "true"){
        die("maintenance mode on please try again");
    }
}

Router::get("/", function (){
    chkmntc();
    View::Show("home", pageTypes::PAGE_TYPE_NORMAL);
});



if(false){ // TODO: examples :)
    Router::middleware("dashboard", \AuthController\AuthController::isLogged() ,
        function (){
            chkmntc();
            View::Show("user/dashboard", pageTypes::PAGE_TYPE_NORMAL);
        }, function (){
            Router::Route("/login"); // if user not authenticated
        }
    );

    Router::middleware("admin", \AuthController\AuthController::isAdmin(),
        function (){
            chkmntc();
            View::Show("admin/dashboard", pageTypes::PAGE_TYPE_NORMAL);
        }, function (){
            Router::Route("/dashboard"); // if user does not have admin permissions
        }
    );

    Router::middleware("logout", \AuthController\AuthController::isLogged(),
        function (){
            $LGTSC = new SessionController();
            $LGTSC->ResetSession();
            $LGTSC = null;
            Router::Route("/login");
        }, function (){
            Router::Route("/login");
        }
    );

}





if(!Router::$isLoaded){
    View::Show("404", pageTypes::PAGE_TYPE_ERROR);
}