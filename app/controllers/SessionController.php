<?php

namespace app\controllers;


class SessionController
{
    public function Get($key){
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
        //return $this->dget($key);
    }

    public function Set($key, $val){
        $_SESSION[$key] = $val;
        //return $this->dset($key, $val);
    }

    public function ResetSessionData() : void{
        session_destroy();
        //$this->RESETSESSION();
    }

    public static function CreateInstance(){
        return new SessionController();
    }
}