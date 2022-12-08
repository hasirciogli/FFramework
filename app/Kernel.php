<?php

//session_start();



require $_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php";

require $_SERVER["DOCUMENT_ROOT"] . "/app/Configs/Config.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/Database/Database.php";

require $_SERVER["DOCUMENT_ROOT"] . "/app/FFunctions/SessionsFromMysql.php";

require $_SERVER["DOCUMENT_ROOT"] . "/app/FFunctions/ErrorHandler.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/FFunctions/FCrypter.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/FFunctions/FrameworkFunctions.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/FFunctions/DataLogger.php";

require $_SERVER["DOCUMENT_ROOT"] . "/app/pgates/3/pay.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/pgates/5/pay.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/pgates/9/pay.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/pgates/10/pay.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/pgates/11/pay.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/pgates/12/pay.php";



require $_SERVER["DOCUMENT_ROOT"] . "/app/Models/SessionModel.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/Models/AuthModel.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/Models/UserModel.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/Models/PaymentRequsetsModel.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/Models/WebsitesModel.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/Models/RestApiModel.php";


require $_SERVER["DOCUMENT_ROOT"] . "/app/Controllers/SessionController.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/Controllers/AuthController.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/Controllers/UserController.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/Controllers/PaymentRequsetsController.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/Controllers/WebsitesController.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/Controllers/RestApiController.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/Controllers/GatesController.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/Controllers/ResponseBankController.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/Controllers/OwnerController.php";


require $_SERVER["DOCUMENT_ROOT"] . "/app/Route/Router.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/Route/ApiRouter.php";
require $_SERVER["DOCUMENT_ROOT"] . "/app/View/View.php";


