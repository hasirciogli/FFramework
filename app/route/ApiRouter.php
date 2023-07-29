<?php

namespace ApiRouter;
use GatesController\GatesController;
use http\Client\Response;
use PaymentRequsetsController\PaymentRequsetsController;
use ResponseBankController\ResponseBankController;
use RestApiController\RestApiController;
use UserController\UserController;
use WebsitesController\WebsitesController;

class ApiRouter
{
    public static $isLoaded = false;

    private static function AnalyzeUri(){
        $uri = $_SERVER["REQUEST_URI"];
        return substr($uri,4, strlen($uri) - 4);
    }

    private static function AnalyzeUri2(){
        $uri = $_SERVER["REQUEST_URI"];
        return [ explode("/", substr($uri,5, strlen($uri) - 4))[0], substr(substr($uri,5, strlen($uri) - 4),strlen(explode("/", substr($uri,5, strlen($uri) - 4))[0]) + 1, strlen($uri) - 4) ];
    }

    public static function get($zName, $correctCallback){
        if (ApiRouter::$isLoaded)
            return false;
        if ($zName == ApiRouter::AnalyzeUri()) {
            $correctCallback();
            ApiRouter::$isLoaded = true;
        };
    }

    public static function getz($zName, $correctCallback){
        if ($zName == ApiRouter::AnalyzeUri()) {
            $correctCallback();
            ApiRouter::$isLoaded = true;
        };
    }

    public static function middleware($controllerZname, $controllerClass, $correctCallback){
        $analuri =  ApiRouter::AnalyzeUri2();
        if ($controllerZname == $analuri[0]) {
            $cc = new $controllerClass();
            $cc->apiControllerRun($analuri[1]);
            $correctCallback();
            ApiRouter::$isLoaded = true;
        };
    }

    public static function post(){

    }


    public static function Run(){
        header("Content-type: application/json");

        ApiRouter::middleware("rest", RestApiController::class, function (){

        });

        ApiRouter::middleware("user", UserController::class, function (){

        });

        ApiRouter::middleware("payment", PaymentRequsetsController::class, function (){

        });

        ApiRouter::middleware("gates", GatesController::class, function (){

        });

        ApiRouter::middleware("payment_back", ResponseBankController::class, function (){

        });

        if (!ApiRouter::$isLoaded){
            die(json_encode([
                "action" => false,
                "data"=> [
                    "error-what" => "please use correct args",
                    "your-ip-adress-recorded" => $_SERVER["REMOTE_ADDR"],
                    "ip-address-info" => "Dont worry. This is our security process. Trust us :) ",
                ]
            ],JSON_UNESCAPED_UNICODE));
        }
    }
}