<?php

namespace SessionModel;

use \DATABASE\FFDatabase;

class SessionModel extends FFDatabase
{
    protected function _get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    protected function _set($key, $val)
    {
        return $_SESSION[$key] = $val;
    }
}