<?php

namespace RestApiModel;

use DATABASE\Database;
use DATABASE\FFDatabase;
use DataLogger\DataLogger;
use FrameworkFunctions\FrameworkFunctions;
USE PDO;

class RestApiModel extends \DATABASE\Database
{
    static function getDomainFromUrl($url)
    {
        $pieces = parse_url($url);
        $domain = isset($pieces['host']) ? $pieces['host'] : '';
        if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
            return $regs['domain'];
        }
        return false;
    }

    static function sendParamDie($error, array $paramters, $error_desc, $class){
        die(json_encode([
            "action" => false,
            "data"=> [
                "error" => $error,
                "error-description" => $error_desc,
                "class" => $class,
                "required-parameters" => $paramters,
                "your-ip-adress-recorded" => $_SERVER["REMOTE_ADDR"],
                "ip-address-info" => "Dont worry. This is our security process. Just trust us :) ",
            ]
        ],JSON_UNESCAPED_UNICODE));
    }

    static function sendErrDie($error, $error_desc, $class){
        die(json_encode([
            "action" => false,
            "data"=> [
                "error" => $error,
                "error-description" => $error_desc,
                "class" => $class,
                "your-ip-adress-recorded" => $_SERVER["REMOTE_ADDR"],
                "ip-address-info" => "Dont worry. This is our security process. Just trust us :) ",
            ]
        ],JSON_UNESCAPED_UNICODE));
    }

    static function sendCreateErr(){
        die(json_encode([
            "action" => false,
            "data"=> [
                "error" => "payment-create-error",
                "error-description" => "Playment create failed please try again",
                "class" => $_SERVER["REQUEST_URI"],
                "your-ip-adress-recorded" => $_SERVER["REMOTE_ADDR"],
                "ip-address-info" => "Dont worry. This is our security process. Just trust us :) ",
            ]
        ],JSON_UNESCAPED_UNICODE));
    }


    static function checkApiKeys(){
        $api_key    = FrameworkFunctions::get()->getCustomHeader("api-key");
        $api_secret = FrameworkFunctions::get()->getCustomHeader("api-secret");

        if (!$api_key || !$api_secret)
            return false;

        // TODO: check api keys in your database 
        
        if("api-keys-corrects" == true){
            return "database-fetch-data-'user-fetch-statement'";
        }
        

        return false;
    }


    static function checkPostParams(array $params){
        foreach($params as $item){
            if(!isset($_POST[$item]) || $_POST[$item] == null || $_POST[$item] == ""){
                return false;
                break;
            }
        }
        return true;
    }


    static function checkPostParam($param, $check_var_type = null){
        if(!isset($_POST[$param]) || $_POST[$param] == null || $_POST[$param] == "")
            return false;

        return true;
    }



    static function checkGetParam($param, $check_var_type = null){
        if(!isset($_GET[$param]) || $_GET[$param] == null || $_GET[$param] == "")
            return false;

        return true;
    }
    

    static function FinishPayWithError($err){
        header("Location: /");
        die();
        //echo "ERROR -> " . $err;
    }

}