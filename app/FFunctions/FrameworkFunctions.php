<?php

namespace FrameworkFunctions;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

enum randomstringtypes{
    case RANDOM_STRING_INT;
    case RANDOM_STRING_STRING;
    case RANDOM_STRING_CHAR;
    case RANDOM_STRING_HIGH;
}

class FrameworkFunctions
{
    public function getCustomHeader($header){
        return isset(getallheaders()[$header]) ? getallheaders()[$header] : false;
    }


    public function getRandomString($length , array $type = null)
    {
        $characters = "";
        if($type != null && count($type) > 0){
            foreach ($type as $item){
                switch ($item){
                    case randomstringtypes::RANDOM_STRING_STRING:
                        $characters .= "abcdefghijklmnopqrstuvwxyz";
                        break;

                    case randomstringtypes::RANDOM_STRING_CHAR:
                        $characters .= ">'^+%&/()=?_é$<£#{%[]}\|";
                        break;

                    case randomstringtypes::RANDOM_STRING_HIGH:
                        $characters .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                        break;

                    case randomstringtypes::RANDOM_STRING_INT:
                        $characters .= "0123456789";
                        break;
                }
            }
        }
        else{
            $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        }

        $randstring = "";
        for ($i = 0; $i < $length; $i++) {
            $randstring .= $characters[rand(0, (strlen($characters) - 1))];
        }

        return $randstring;
    }

    public function SendMail($to, $title, $body, $footer) {

        $mail = new PHPMailer(false);

        try {
            $mail->SMTPDebug = false;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = configs_mail_host;
            $mail->SMTPAuth   = true;
            $mail->Username   = configs_mail_from;
            $mail->Password   = configs_mail_password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = configs_mail_port;                              //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            $mail->setFrom(configs_mail_from, configs_mail_sender);
            $mail->addAddress($to);
            $mail->isHTML(true);
            $mail->Subject = $title;
            $mail->Body    = $body;
            $mail->AltBody = $footer;

            $mail->send();

            return true;
        } catch (Exception $e) {
            return true;
        }
    }

    public static function get(){
        return new FrameworkFunctions();
    }
}