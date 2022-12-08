<?php

namespace SessionModel;
use \DATABASE\Database;

class SessionModel extends Database
{
    protected function _get($key){
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    protected function _set($key, $val){
        return $_SESSION[$key] = $val;
    }
}