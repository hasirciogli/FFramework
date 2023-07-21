<?php

namespace app\ffunctions;


//$BaseErrorHandler = new ErrorHandler(); // error handled disabled bcs have an error in this page;
//$BaseErrorHandler->initHandler();

class ErrorHandler
{
    public function initHandler(){
        set_error_handler(array(&$this, 'HANDLE_ERRORS'));
    }

    public function HANDLE_ERRORS($errno, $errstr, $errfile, $errline, $context = null){
        $_SESSION["FRAMEWORD_ERROR_VIEW_STATUS"]        = true;
        $_SESSION["FRAMEWORD_ERROR_VIEW_ERRNO"]         = $errno;
        $_SESSION["FRAMEWORD_ERROR_VIEW_ERRSTR"]        = $errstr;
        $_SESSION["FRAMEWORD_ERROR_VIEW_ERRFILE"]       = $errfile;
        $_SESSION["FRAMEWORD_ERROR_VIEW_ERRLINE"]       = $errline;
        $_SESSION["FRAMEWORD_ERROR_VIEW_ERRCONTEXT"]    = $context;
        $_SESSION["FRAMEWORD_ERROR_VIEW_ERRBACKLINK"]    = $_SERVER["REQUEST_URI"];

        header("Location: " . configs_host_ssl . "://" . configs_host_domain . "/debug_display_errors");
    }
}