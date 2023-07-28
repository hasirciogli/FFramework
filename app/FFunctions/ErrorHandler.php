<?php

namespace app\ffunctions;


//$BaseErrorHandler = new ErrorHandler(); // error handled disabled bcs have an error in this page;
//$BaseErrorHandler->initHandler();

class ErrorHandler
{
    public static function handleErrors($errorNumber, $errorMessage, $errorFile, $errorLine)
    {
        // Loglama veya Slack gibi bir hizmete hata bilgilerini gönderme işlemleri burada yapılır.
        // Örneğin, error_log() işlevini kullanarak hataları loglama yapabilirsiniz.

        $logMessage = "Hata: $errorMessage at $errorFile line $errorLine";
        error_log($logMessage);

        die($logMessage);

        // Slack gibi bir hizmete hata bildirimi göndermek için gerekli kodları buraya ekleyebilirsiniz.
    }

    public static function handleExceptions($exception)
    {
        // Loglama veya Slack gibi bir hizmete istisna bilgilerini gönderme işlemleri burada yapılır.
        // Örneğin, error_log() işlevini kullanarak istisnaları loglama yapabilirsiniz.

        $logMessage = "İstisna: " . $exception->getMessage() . " at " . $exception->getFile() . " line " . $exception->getLine();
        error_log($logMessage);
        die($logMessage);

        // Slack gibi bir hizmete istisna bildirimi göndermek için gerekli kodları buraya ekleyebilirsiniz.
    }
}