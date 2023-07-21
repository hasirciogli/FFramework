<?php

namespace app\assignments\datalogger;


enum DATALOGGER_LOG_TYPE: int
{
    case DEFAULT = 0;
    case PAYMENT_GATES_LOG = 1;
    case PAYMENT_REQUESTS_CREATE_LOG = 2;
    case PAYMENT_REQUEST_PAY_LOG = 3;
}