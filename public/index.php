<?php
//die(var_dump($_SERVER));
//die (phpinfo());
$cfg_way = "./../app/Configs/Config.php";

if (!file_exists($cfg_way))
    Router::Route("setup/index.php");


require $_SERVER["DOCUMENT_ROOT"] . "/app/Kernel.php";

use Router\Router;
use View\View;
use View\pageTypes;
use UserController\UserController;
use SessionController\SessionController;

$RouteSideUserController = new UserController();

$sessionEx = new SessionsFromMysql();

if (framework_is_debug_mode) {
    Router::get("/debug_display_errors", function () {
        View::Show("display_error", pageTypes::PAGE_TYPE_DERROR);
        die();
    });
}

Router::get("/", function () {
    //Router::Route("login");
    View::Show("home", pageTypes::PAGE_TYPE_NORMAL);
});

Router::get("/remote_owner_page", function () {
    //Router::Route("login");
    View::Show("owner/home", pageTypes::PAGE_TYPE_NORMAL);
});

Router::get("/login", function () {
    View::Show("login", pageTypes::PAGE_TYPE_NORMAL);
});

Router::get("/policy", function () {
    View::Show("../datapages/policy", pageTypes::PAGE_TYPE_NORMAL);
});


Router::Middleware("storage", true, function () {
    require configs_site_rootfolder . "/storage/storagemanager.php";
}, function () {

});

if (false) {
    Router::get("/register", function () {
        Router::Route("login");
        return;
        View::Show("register", pageTypes::PAGE_TYPE_NORMAL);
    });

    Router::get("/disclamier", function () {
        View::Show("disclamier", pageTypes::PAGE_TYPE_NORMAL);
    });

    Router::get("/pay", function () {
        View::Show("payment/pay", pageTypes::PAGE_TYPE_NORMAL);
    });

    Router::get("/success", function () {
        View::Show("payment/success", pageTypes::PAGE_TYPE_NORMAL);
    });

    Router::get("/unsuccess", function () {
        View::Show("payment/unsuccess", pageTypes::PAGE_TYPE_NORMAL);
    });

    Router::get("/policy", function () {
        View::Show("../datapages/policy", pageTypes::PAGE_TYPE_NORMAL);
    });

    Router::get("/test", function () {
        View::Show("test", pageTypes::PAGE_TYPE_NORMAL);
    });

    Router::get("/fatura", function () {
        View::Show("user/funcs/dfatura", pageTypes::PAGE_TYPE_NORMAL);
    });

    Router::get("/response_bank", function () {
        View::Show("response", pageTypes::PAGE_TYPE_NORMAL);
    });


    Router::middleware("dashboard", \AuthController\AuthController::isLogged(),
        function () {
            View::Show("user/dashboard", pageTypes::PAGE_TYPE_NORMAL);
        }, function () {
            Router::Route("login");
        }
    );

    Router::middleware("admin", \AuthController\AuthController::isAdmin(),
        function () {
            chkmntc();
            View::Show("admin/dashboard", pageTypes::PAGE_TYPE_NORMAL);
        }, function () {
            Router::Route("dashboard");
        }
    );

    Router::middleware("logout", \AuthController\AuthController::isLogged(),
        function () {
            $LGTSC = new SessionController();
            $LGTSC->ResetSessionData();
            $LGTSC = null;
            Router::Route("login");
        }, function () {
            Router::Route("login");
        }
    );
}


if (!Router::$isLoaded) {
    View::Show("404", pageTypes::PAGE_TYPE_ERROR);
}