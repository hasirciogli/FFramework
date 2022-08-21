<?php

namespace RestApiController;
use RestApiModel\RestApiModel;


class RestApiController extends RestApiModel
{
    public static $isLoaded = false;

    private static function AnalyzeUri($uri, &$sequence){
        $result = explode("/", $uri)[$sequence] ?? null;
        $sequence++;
        return $result;
    }

    public static function SendPostDie(){
        die(json_encode([
            "action" => false,
            "data"=> [
                "error" => "USE POST METHOD",
                "url" => $_SERVER["REQUEST_URI"],
                "your-ip-adress-recorded" => $_SERVER["REMOTE_ADDR"],
                "ip-address-info" => "Dont worry. This is our security process. Just trust us :) ",
            ]
        ],JSON_UNESCAPED_UNICODE));
    }
    public static function SendGettDie(){
        die(json_encode([
            "action" => false,
            "data"=> [
                "error" => "USE GET METHOD",
                "url" => $_SERVER["REQUEST_URI"],
                "your-ip-adress-recorded" => $_SERVER["REMOTE_ADDR"],
                "ip-address-info" => "Dont worry. This is our security process. Just trust us :) ",
            ]
        ],JSON_UNESCAPED_UNICODE));
    }
    public static function SendApiCredentialsDie(){
        die(json_encode([
            "action" => false,
            "data"=> [
                "error" => "invalid-api-keys",
                "error-description" => "PLEASE SET API-KEY AND API-SECRET (INVALID CREDENTIALS)",
                "url" => $_SERVER["REQUEST_URI"],
                "your-ip-adress-recorded" => $_SERVER["REMOTE_ADDR"],
                "ip-address-info" => "Dont worry. This is our security process. Just trust us :) ",
            ]
        ],JSON_UNESCAPED_UNICODE));
    }
    public static function SendClassDie(){
        die(json_encode([
            "action" => false,
            "data"=> [
                "error" => "invalid-api-class",
                "error-description" => "Please use valid class. Check our api documentation",
                "url" => $_SERVER["REQUEST_URI"],
                "your-ip-adress-recorded" => $_SERVER["REMOTE_ADDR"],
                "ip-address-info" => "Dont worry. This is our security process. Just trust us :) ",
            ]
        ],JSON_UNESCAPED_UNICODE));
    }

    public static function apiControllerRun($uri){
        header("Content-type: application/json");

        $seq = 0;

        switch(RestApiController::AnalyzeUri($uri, $seq)){
            case "ccc": //  =>  /api/rest/ccc/
                
                break;

            default:
                die(json_encode([
                    "action" => false,
                    "data"=> [
                        "error" => "class-required",
                        "error-description" => "Api class required example: '" . $_SERVER["REQUEST_URI"] . "/user' ",
                        "url" => $_SERVER["REQUEST_URI"],
                        "your-ip-adress-recorded" => $_SERVER["REMOTE_ADDR"],
                        "ip-address-info" => "Dont worry. This is our security process. Just trust us :) ",
                    ]
                ],JSON_UNESCAPED_UNICODE));
                break;
        }
    }
}