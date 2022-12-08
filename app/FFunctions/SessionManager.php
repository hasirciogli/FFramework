<?php

namespace FFramework\FFunctions;

use Router\Router;

class SessionManager {

    public $sessionToken = null;

    private $dgb = 0;


    public function __construct()
    {
        $this->init_data();
    }

    private function getSessionFromDatabase($token){
        $result = \DATABASE\FFDatabase::cfun()->select("sessions")->where("session_key", $token)->run()->get();

        if ($result && $result != "no-record")
        {
            $this->sessionToken = $token;
            return $result;
        }
        else
            return $this->createNewSession();
    }

    public function createNewSession() : array|null|bool|string{
        $keys = "abcdefghijklmnoprstuvyzABCDEFGHIJKLMNOPRSTUVYZ12345678900_-";
        $new_session_key = "";
        $breaker = 0;

        while(true)
        {
            for ($i = 0; $i < 50; $i++){
                $new_session_key .= $keys[random_int(0, strlen($keys) - 1)];
            }

            $result = \DATABASE\FFDatabase::cfun()->select("sessions")->where("session_key", $new_session_key)->run()->get();

            if ($result && $result == "no-record")
            {
                $result = \DATABASE\FFDatabase::cfun()->insert("sessions", [["session_key", $new_session_key], ["expiry", date("Y-m-d")]])->run()->get();
                setcookie("__token", $new_session_key);
                break;
            }
            else if (!$result)
            {
                die("FATAL ERROR: sa74we*/qw4f");
                break;
            }

            if ($breaker >= 100){
                die("erro #xmwlnasşçw4dq-we");
                break;
            }

            $breaker++;
        }

        $this->sessionToken = $new_session_key;
        return $new_session_key;
    }


    public function init_data()
    {
        $token = @$_COOKIE["__token"];

        if($token != null || $token != ""){
            $this->getSessionFromDatabase($token);
        }
        else{
            $this->createNewSession();
            Router::Route("");
            //setcookie("__token", );
        }
    }

    public function StopSession() : void
    {

    }


    public function dget($key)
    {
        $result = \DATABASE\FFDatabase::cfun()->select("sessions")->where("session_key", $this->sessionToken)->run()->get();
        $adata = null;
        if ($result["data"] == "" || $result["data"] == null)
        {
            $result = null;
        }
        else{
            $adata = $result["data"];
            $adata = isset(json_decode($adata)->{$key}) ? json_decode($adata)->{$key} : null;
        }

        return $adata;
    }


    public function dset($add_key, $add_val){
        $result = \DATABASE\FFDatabase::cfun()->select("sessions")->where("session_key", $this->sessionToken)->run()->get();

        $udata = null;

        if ($result["data"] == "" || $result["data"] == null)
        {
            $udata[$add_key] = $add_val;
        }
        else{
            foreach (json_decode($result["data"]) as $key => $item)
            {
                $udata[$key] = $item;
            }

            $udata[$add_key] = $add_val;
        }

        $result = \DATABASE\FFDatabase::cfun()->update("sessions", [["data", json_encode($udata, JSON_UNESCAPED_UNICODE)]])->where("session_key", $this->sessionToken)->run();

        if ($result->x)
            return true;
        else
            return false;
    }


    public function RESETSESSION(){
        $result = \DATABASE\FFDatabase::cfun()->update("sessions", [["data", ""]])->where("session_key", $this->sessionToken)->run();

        if ($result->x)
            return true;
        else
            return false;
    }

    public static function CreateInstance(){
        $res = new SessionManager();
        $res->init_data();
        return $res;
    }
}



?>