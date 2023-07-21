<?php

namespace app\models;

use app\database\FFDatabase;
use app\ffunctions\DataLogger;
use app\assignments\datalogger\DATALOGGER_LOG_TYPE;
use app\ffunctions\FrameworkFunctions;
use PDO;
use Router\Router;

class RestApiModel extends FFDatabase
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


    static function sendParamDie($error, array $paramters, $error_desc, $class)
    {
        die(json_encode([
            "action" => false,
            "data" => [
                "error" => $error,
                "error-description" => $error_desc,
                "class" => $class,
                "required-parameters" => $paramters,
                "your-ip-adress-recorded" => $_SERVER["REMOTE_ADDR"],
                "ip-address-info" => "Dont worry. This is our security process. Just trust us :) ",
            ]
        ], JSON_UNESCAPED_UNICODE));
    }

    static function sendErrDie($error, $error_desc, $class)
    {
        die(json_encode([
            "action" => false,
            "data" => [
                "error" => $error,
                "error-description" => $error_desc,
                "class" => $class,
                "your-ip-adress-recorded" => $_SERVER["REMOTE_ADDR"],
                "ip-address-info" => "Dont worry. This is our security process. Just trust us :) ",
            ]
        ], JSON_UNESCAPED_UNICODE));
    }

    static function sendCreateErr()
    {
        die(json_encode([
            "action" => false,
            "data" => [
                "error" => "payment-create-error",
                "error-description" => "Playment create failed please try again",
                "class" => $_SERVER["REQUEST_URI"],
                "your-ip-adress-recorded" => $_SERVER["REMOTE_ADDR"],
                "ip-address-info" => "Dont worry. This is our security process. Just trust us :) ",
            ]
        ], JSON_UNESCAPED_UNICODE));
    }

    static function checkApiKeys()
    {
        $api_key = FrameworkFunctions::get()->getCustomHeader("api-key");
        $api_secret = FrameworkFunctions::get()->getCustomHeader("api-secret");

        if (!$api_key || !$api_secret)
            return false;

        $v = parent::sql("SELECT * FROM users WHERE api_key=? AND api_secret=?");
        $x = $v->execute([$api_key, $api_secret]);
        $user = $v->fetch(PDO::FETCH_ASSOC);

        if ($v->rowCount() > 0 && $x) {
            return $user;
        }
        return false;
    }

    static function checkPostParams(array $params)
    {
        foreach ($params as $item) {
            if (!isset($_POST[$item]) || $_POST[$item] == null || $_POST[$item] == "") {
                return false;
                break;
            }
        }
        return true;
    }

    static function checkPostParam($param, $check_var_type = null)
    {
        if (!isset($_POST[$param]) || $_POST[$param] == null || $_POST[$param] == "")
            return false;

        return true;
    }

    static function checkGetParam($param, $check_var_type = null)
    {
        if (!isset($_GET[$param]) || $_GET[$param] == null || $_GET[$param] == "")
            return false;

        return true;
    }

    static function checkHost($param_domain)
    {
        $param_domain_addr = gethostbyname($param_domain);
        $request_addr = $_SERVER["REMOTE_ADDR"];

        if ($request_addr != $param_domain_addr) {
            RestApiModel::sendErrDie("invalid-host", "Please send any requst to your confirmed or active website('s)", $_SERVER["REQUEST_URI"]);
            return false;
        }

        $v = Database::sql("SELECT * FROM websites WHERE domain=?");
        $x = $v->execute([$param_domain]);
        $result = $v->fetch(PDO::FETCH_ASSOC);

        if ($v->rowCount() > 0 && $x) {
            return $result;
        } else {
            RestApiModel::sendErrDie("website-not-found", "Website not registered our server's", $_SERVER["REQUEST_URI"]);
            return false;
        }
    }

    static function FinishPayWithError($err)
    {
        Router::Route("");
        die();
        //echo "ERROR -> " . $err;
    }


}