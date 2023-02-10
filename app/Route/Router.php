<?php

namespace Router;

use ApiRouter\ApiRouter;

class Router
{
    public static $isLoaded = false;
    public static $middlewareUri = "";

    public static function AnalyzeUri()
    {
        $req_url = $_SERVER["REQUEST_URI"];
        $splited_str = str_split($req_url);
        $link = "";
        foreach ($splited_str as $echar) {
            if ($echar == "?") {
                break;
            } else {
                $link .= $echar;
            }
        }
        return $link;
    }

    public static function AnalyzeMiddlewareUri()
    {
        $req_uri = $_SERVER["REQUEST_URI"];
        $splited_str = str_split($req_uri);
        $base_uri = "";

        foreach ($splited_str as $echar) {
            if ($echar == "?") {
                break;
            } else {
                $base_uri .= $echar;
            }
        }

        return explode("/", substr($base_uri, 1, strlen($base_uri)));
    }

    public static function Get($zName, $correctCallback)
    {
        if (Router::$isLoaded)
            return false;
        if ($zName == Router::AnalyzeUri() && !Router::CheckIfIsApi(configs_api_prefix)) {
            $correctCallback();
            Router::$isLoaded = true;
        } else if (Router::CheckIfIsApi(configs_api_prefix)) {
            ApiRouter::Run();
            Router::$isLoaded = true;
        }

        return false;
    }

    public static function Middleware($zName, $checkFunction, $correctCallback, $inCorrectCallback)
    {
        if (Router::$isLoaded)
            return false;

        if ($zName == Router::AnalyzeMiddlewareUri()[0] && !Router::CheckIfIsApi(configs_api_prefix)) {

            if (!$checkFunction) {
                $inCorrectCallback();
                return false;
            }

            $correctCallback();
            Router::$isLoaded = true;
        } else if (Router::CheckIfIsApi(configs_api_prefix)) {
            ApiRouter::Run();
            Router::$isLoaded = true;
        }
        return false;
    }

    public static function Route($link)
    {
        header("Location: " . configs_host_ssl . "://" . configs_host_domain . "/" . $link);
    }

    public static function CheckIfIsApi($prefix)
    {
        return false;
        if (substr(Router::AnalyzeUri(), 1, strlen($prefix)) == $prefix)
            return true;
        else
            return false;
    }
}