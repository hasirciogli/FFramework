<?php

include __DIR__ . "/../app/Configs/Config.php";
include __DIR__ . "/../app/Database/Database.php";

//$_POST = json_decode(file_get_contents('php://input'), true);


class ApiRouter
{
    private function getRequestHeaders()
    {
        $headers = array();
        foreach (getallheaders() as $name => $value) {
            $headers[$name] = $value;
        }

        return $headers;
    }

    private function initializeUri($uri) // initialize uri
    {
        $inetUri = substr($uri, 5); // remove /api from requested url
        return explode('/', $inetUri . str_contains("?", $inetUri) ? explode('?', $inetUri)[0] : $inetUri); // if uri contains '?' get it first array from explode function if is not contains get all uri
    }

    public function run($uri)
    {
        function makeResponse($res_code, $res_text, $status, $data) // Easy response function, call if you want 
        {
            header("Content-Type: application/json");
            http_response_code($res_code); // http response code function. like 404 not found...
            die(json_encode([
                "response" => [
                    "code" => $res_code,
                    "text" => $res_text
                ],
                "status" => $status,
                "data" => $data
            ], true));
        }

        $uriA = $this->initializeUri($uri); // initialize uri function
        //var_dump($uriA);


        $rHeaders = $this->getRequestHeaders();
        if (@$rHeaders["client_id"] != "admin" || @$rHeaders["client_secret"] != "admin")
            makeResponse(401, "Unauthorized", false, [
                "err" => "need client credentials",
            ]);

        if (isset($uriA[0]) && file_exists("./vfuns/" . $uriA[0] . ".php")) {  // if uri contains controller file name
            require("./vfuns/" . $uriA[0] . ".php"); // if uri contains controller file name. load controller file

            $plController = PluginController::cfun([]); // call plugin controller constructor(own) function
            if (method_exists($plController, $uriA[1])) // plugin class is if contains function from second uri array
            {
                $plController->{$uriA[1]}($uriA); // call plugin class constructor(own) function
            } else { // plugin class is if not contains a method, call makeresponse function with correct response code :)
                makeResponse(400, "Bad Request", false, [
                    "err" => "invalid request",
                ]);
            }
        } else {
            makeResponse(400, "Bad Request", false, [
                "err" => "invalid request",
            ]);
        }
    }

    public function errorHandler($errno, $errstr, $errfile, $errline, $errcontext)
    {
        return true;
    }

    public static function cfun()
    {
        return new ApiRouter();
    }
}


$ar = ApiRouter::cfun();

$ar->run($_SERVER["REQUEST_URI"]);
