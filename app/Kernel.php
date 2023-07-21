<?php

require __DIR__ . "/configs/config.php";

if(framework_is_debug_mode)
{
    error_reporting(E_ALL);
    ini_set("display_errors", "True");
}
else{
    error_reporting(0);
    ini_set("display_errors", "False");
}

require configs_site_rootfolder . "/vendor/autoload.php";


/*

require $_SERVER["DOCUMENT_ROOT"] . "/app/database/database.php";


require $_SERVER["DOCUMENT_ROOT"] . "/app/ffunctions/SessionsFromMysql.php";

require $_SERVER["DOCUMENT_ROOT"] . "/app/ffunctions/ErrorHandler.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/ffunctions/FCrypter.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/ffunctions/FrameworkFunctions.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/ffunctions/DataLogger.php";


require $_SERVER["DOCUMENT_ROOT"] . "/app/models/SessionModel.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/models/AuthModel.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/models/UserModel.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/models/RestApiModel.php";


require $_SERVER["DOCUMENT_ROOT"] . "/app/controllers/SessionController.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/controllers/UserController.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/controllers/OwnerController.php";


require $_SERVER["DOCUMENT_ROOT"] . "/app/route/Router.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/route/ApiRouter.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/view/view.php";
*/

// PSR-4 autoloader işlevi
spl_autoload_register(function ($class) {


    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    // Sınıf dosyasının tam yolunu oluşturun
    $file = configs_site_rootfolder . "/" . $classPath . '.php';

    // Dosya varsa, onu yükle
    if (file_exists($file)) {
        require $file;
    }

});
