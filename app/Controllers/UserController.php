<?php

namespace UserController;

use AuthController\AuthController;
use Router\Router;
use SessionController\SessionController;
use UserModel\UserModel;

class UserController extends UserModel
{
    private function RedirectTo($where){
        Router::Route($where);
    }

    public function LoginUser($email, $password){
        $email_strlen       = strlen($email);
        $password_strlen    = strlen($password);
        if (!($email_strlen >= 5 && $email_strlen <= 25) || !($password_strlen >= 5 && $password_strlen <= 25)){
            SessionController::CreateInstance()->Set("SESSION_LOGIN_ERROR", "Password and Email bigger than 5 ");
            $this->RedirectTo("login");
        }

        $this->_LoginUser($email, $password);
        $this->RedirectTo("login");
    }

    public function RegisterUser($fullname, $email, $birthday, $password, $repassword){
        $password_strlen    = strlen($password);

        if (!($password_strlen >= 6 && $password_strlen <= 30)){
            SessionController::CreateInstance()->Set("SESSION_LOGIN_ERROR", "Password length bigger than 6 and less than 30");
            $this->RedirectTo("register");
            return false;
        }

        if ($password != $repassword){
            SessionController::CreateInstance()->Set("SESSION_LOGIN_ERROR", "Password's does not match!");
            $this->RedirectTo("register");
            return false;
        }

        $this->_RegisterUser($fullname, $email, $birthday, $password);
        $this->RedirectTo("register");
    }


    public function ConfirmateUserMailAddress($mail_key){
        $this->_ConfirmateUserMailAddress($mail_key);
        $this->RedirectTo("login");
    }



    public function GetUserData($id){
        return $this->_GetUserData($id);
    }

    public function UpdateUserData($action, $extra = null){
        switch ($action){
            case "password":
                $old_password       = $_POST["old_password"] ?? null;
                $new_password       = $_POST["new_password"] ?? null;
                $new_repassword     = $_POST["new_repassword"] ?? null;

                if (($old_password == "" || $new_password == "" || $new_repassword == "" ) || ($old_password == null || $new_password == null || $new_repassword == null))
                {
                    $UMSC = new SessionController();
                    $UMSC->Set("SESSION_PROFILE_SHOW_ERROR"    , true);
                    $UMSC->Set("SESSION_PROFILE_ERROR"          , "Password input's blank");
                    $UMSC->Set("SESSION_PROFILE_TYPE"           , "bg-red-400 shadow-lg shadow-red-300");
                    break;
                }

                if (!AuthController::passwordCheck($old_password))
                {
                    $UMSC = new SessionController();
                    $UMSC->Set("SESSION_PROFILE_SHOW_ERROR"    , true);
                    $UMSC->Set("SESSION_PROFILE_ERROR"          , "The old password is incorrect");
                    $UMSC->Set("SESSION_PROFILE_TYPE"           , "bg-red-400 shadow-lg shadow-red-300");
                    break;
                }

                if ($new_password != $new_repassword)
                {
                    $UMSC = new SessionController();
                    $UMSC->Set("SESSION_PROFILE_SHOW_ERROR"    , true);
                    $UMSC->Set("SESSION_PROFILE_ERROR"          , "New passwords do not match");
                    $UMSC->Set("SESSION_PROFILE_TYPE"           , "bg-red-400 shadow-lg shadow-red-300");
                    break;
                }

                if (strlen($new_password) <= 5)
                {
                    $UMSC = new SessionController();
                    $UMSC->Set("SESSION_PROFILE_SHOW_ERROR"    , true);
                    $UMSC->Set("SESSION_PROFILE_ERROR"          , "New password must be greater than 6 characters");
                    $UMSC->Set("SESSION_PROFILE_TYPE"           , "bg-red-400 shadow-lg shadow-red-300");
                    break;
                }

                if ($new_password != $new_repassword)
                {
                    $UMSC = new SessionController();
                    $UMSC->Set("SESSION_PROFILE_SHOW_ERROR"    , true);
                    $UMSC->Set("SESSION_PROFILE_ERROR"          , "New passwords do not match");
                    $UMSC->Set("SESSION_PROFILE_TYPE"           , "bg-red-400 shadow-lg shadow-red-300");
                    break;
                }

                $this->_UpdateUserPassword($new_password);
                break;

            default:

                break;
        }
    }



    public function apiControllerRun($rurl){
        $funcParam = 0;
        function getParam($url, &$state){
            $result = explode("/", $url)[$state] ?? null;
            $state++;
            return $result;
        }
        function checkYuri($zName, $url, $state){
            if (explode("/", $url)[$state] == $zName)
                return true;
            else
                return false;
        }

        function sendDieJsonError($way){
            die(json_encode([
                "action" => false,
                "data"=> [
                    "function" => $way,
                    "your-ip-adress-recorded" => $_SERVER["REMOTE_ADDR"],
                    "ip-address-info" => "Dont worry. This is our security process. Trust us :) ",
                ]
            ],JSON_UNESCAPED_UNICODE));
        }

        switch (getParam($rurl, $funcParam))
        {
            case "login":
                if(!$_POST) die("need post :)");

                $UserController = new UserController();
                $UserController->LoginUser($_POST["email"], $_POST["password"]);
                break;


            case "register":
                if(!$_POST) die("need post :)");

                $UserController = new UserController();
                $UserController->RegisterUser($_POST["fullname"], $_POST["email"], $_POST["birthday"], $_POST["password"], $_POST["repassword"]);
                break;

            case "update":
                if(!$_POST) die("need post :)");

                $callback           = $_POST["callback"] ?? null;

                $param1 = getParam($rurl, $funcParam);
                $param2 = getParam($rurl, $funcParam);

                UserController::get()->UpdateUserData($param1, $param2);
                Router::Route($callback);
                break;


            case "email":
                //if(!$_POST) die("need post :)");

                switch (getParam($rurl, $funcParam)){
                    case "confirmate":
                        $email_confirm_key = getParam($rurl, $funcParam);
                        if($email_confirm_key != null && $email_confirm_key != "" && strlen($email_confirm_key) >= 200){
                            UserController::get()->ConfirmateUserMailAddress($email_confirm_key);
                        }
                        else{
                            sendDieJsonError("user->email->confirmate");
                        }
                        break;

                    default:
                        sendDieJsonError("user->email");
                        break;
                }
                break;

            default:
                sendDieJsonError("user");
                break;
        }
    }

    public static function get(){ return new UserController();}
}