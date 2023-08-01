<?php

namespace app\ffunctions;

class SessionManager {

    public function __construct()
    {
        $this->Start();
    }

    public function Start(){
        $sidc = session_id();
        if (!$sidc)
            session_start();

        $sidc = session_id();
    }

    public function getCSRF(){
        return $this->Get("csrf-token") ?? false;
    }

    public function checkCsrfTokenInPost() {
        if (!$_POST["csrf-token"])
            return false;

        if (!isset($_POST["csrf-token"]))
            return false;

        if ($_POST["csrf-token"] == "")
            return false;

        return ($this->getCSRF() ?? "") == ($_POST["csrf-token"] ?? "");
    }

    public function resetCSRF(){
        return $this->Set("csrf-token", bin2hex(random_bytes(24))) ?? false;
    }

    public function Get($key){
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
        //return $this->dget($key);
    }

    public function Set($key, $val){
        $_SESSION[$key] = $val;
    }

    public function ResetSessionData() : void {
        session_unset();
        session_destroy();
        //$this->RESETSESSION();
    }

    public static function CreateInstance(){
        return new SessionManager();
    }
}



?>