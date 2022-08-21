<?php

namespace SessionController;

use SessionModel\SessionModel;

class SessionController extends SessionModel
{
    public function Get($key){
        return $this->_get($key);
    }

    public function Set($key, $val){
        return $this->_set($key, $val);
    }

    public function ResetSession(){
        session_unset();
        session_destroy();
    }
}