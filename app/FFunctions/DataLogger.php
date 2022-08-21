<?php

namespace DataLogger;

use DATABASE\Database;
use DATABASE\FFDatabase;

class DataLogger
{
    public static function logData($header, $body){
        FFDatabase::cfun()->insert("data_log",[["header", $header], ["body", $body]])->run();
    }
}