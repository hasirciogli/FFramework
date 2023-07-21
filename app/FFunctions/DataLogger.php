<?php

namespace app\ffunctions;

use app\database\FFDatabase;
use app\assignments\datalogger\DATALOGGER_LOG_TYPE;



class DataLogger
{
    public function logData($logtype, $header, $body) : DataLogger {
        switch ($logtype){
            case DATALOGGER_LOG_TYPE::PAYMENT_GATES_LOG:
                $logtype = 1;
                break;
            case DATALOGGER_LOG_TYPE::PAYMENT_REQUESTS_CREATE_LOG:
                $logtype = 2;
                break;
            case DATALOGGER_LOG_TYPE::PAYMENT_REQUEST_PAY_LOG:
                $logtype = 3;
                break;
            default:
                $logtype = 0;
                break;
        }
        FFDatabase::cfun()->insert("data_log",[["header", $header], ["body", $body], ["log_type", $logtype]])->run();
        return $this;
    }

    public static function cfun(){
        return new DataLogger();
    }
}