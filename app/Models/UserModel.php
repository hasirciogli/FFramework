<?php

namespace UserModel;

use DATABASE\Database;
use PDO;
use AuthController\AuthController;
use SessionController\SessionController;
use FCrypter\FCrypter;
use FrameworkFunctions\FrameworkFunctions;
use FrameworkFunctions\randomstringtypes;

class UserModel extends Database
{
    protected function _LoginUser($email, $password){

        $UMSC = new SessionController();

        $v = $this::sql("SELECT * FROM users WHERE BINARY email=?");
        $v2 = $v->execute([$email]);
        $v3 = $v->fetch(PDO::FETCH_ASSOC);

        if($v->rowCount() > 0){
            $fc = new FCrypter();
            if($fc->getEncrypt($password) == $v3["password"]){
                AuthController::initializeAuthlib($v3["id"]);

                $UMSC->Set("usersession_is_loggedin"    , true);
                $UMSC->Set("usersession_is_id"          , $v3["id"]);
                $UMSC->Set("usersession_is_email"       , $v3["email"]);
            }else{
                $UMSC->Set("SESSION_LOGIN_ERROR"        , "Invalid password");
            }
        }else{
            $UMSC->Set("SESSION_LOGIN_ERROR"            , "Invalid email address");
        }
    }

    protected function _RegisterUser($fullname, $email, $birthday, $password){
        $UMSC = new SessionController();

        $v = $this::sql("SELECT * FROM users WHERE BINARY email=?");
        $v2 = $v->execute([$email]);
        $v3 = $v->fetch(PDO::FETCH_ASSOC);

        if($v->rowCount() > 0){
            $UMSC->Set("SESSION_REGISTER_ERROR"        , "Email allready registered");
        }else{
            $fc = new FCrypter();
            $crypted_password = $fc->getEncrypt($password);

            $api_key_gen        = false;
            $api_secret_gen     = false;

            $mail_cfm_gen     = false;

            $api_key        = "";
            $api_secret     = "";
            $mail_cfm     = "";

            while(!$api_key_gen){
                $temp_api_key = FrameworkFunctions::get()->getRandomString(128,[randomstringtypes::RANDOM_STRING_INT, randomstringtypes::RANDOM_STRING_STRING]);

                $v = $this::sql("SELECT * FROM users WHERE BINARY api_key=?");
                $v2 = $v->execute([$temp_api_key]);
                $v3 = $v->fetch(PDO::FETCH_ASSOC);

                if (!$v->rowCount()){
                    $api_key = $temp_api_key;
                    $api_key_gen = true;
                    break;
                }
            }

            while(!$api_secret_gen){
                $temp_secret_key = FrameworkFunctions::get()->getRandomString(128,[randomstringtypes::RANDOM_STRING_INT, randomstringtypes::RANDOM_STRING_STRING]);

                $v = $this::sql("SELECT * FROM users WHERE BINARY api_secret=?");
                $v2 = $v->execute([$temp_secret_key]);
                $v3 = $v->fetch(PDO::FETCH_ASSOC);

                if (!$v->rowCount()){
                    $api_secret = $temp_secret_key;
                    $api_secret_gen = true;
                    break;
                }
            }

            while(!$mail_cfm_gen){
                $temp_secret_key = FrameworkFunctions::get()->getRandomString(250,[randomstringtypes::RANDOM_STRING_INT, randomstringtypes::RANDOM_STRING_STRING]);

                $v = $this::sql("SELECT * FROM users WHERE BINARY mail_conf_key=?");
                $v2 = $v->execute([$temp_secret_key]);
                $v3 = $v->fetch(PDO::FETCH_ASSOC);

                if (!$v->rowCount()){
                    $mail_cfm = $temp_secret_key;
                    $mail_cfm_gen = true;
                    break;
                }
            }

            $v = $this::sql("INSERT INTO users (name,email, birthday, api_key, api_secret,type,password, email_state, mail_conf_key) VALUES (?, ?, ?, ?, ?, 'user', ?, 'waiting', ?)");
            $v2 = $v->execute([$fullname, $email, $birthday, $api_key, $api_secret, $crypted_password, $mail_cfm]);
            $v3 = $v->fetch(PDO::FETCH_ASSOC);

            if($v->rowCount() > 0 && $v2){

                $v = $this::sql("SELECT * FROM users WHERE BINARY email=?");
                $v2 = $v->execute([$email]);
                $v3 = $v->fetch(PDO::FETCH_ASSOC);


                AuthController::initializeAuthlib($v3["id"]);

                $UMSC->Set("usersession_is_loggedin"    , true);
                $UMSC->Set("usersession_is_id"          , $v3["id"]);
                $UMSC->Set("usersession_is_email"       , $v3["email"]);

                FrameworkFunctions::get()->SendMail($v3["email"],"Confirm email address", '
                    <center>
                        <h1>Please confirmate your email address</h1>
                        <h3><a href="http://'. $_SERVER["SERVER_NAME"] . "/api/user/email/confirmate/" . $v3["mail_conf_key"] . '"><span style="color:skyblue;">Confirm</span></a></h3>
                    </center>
                ',null);

            }
            else{
                $UMSC->Set("SESSION_REGISTER_ERROR"        , "Invalid error try again later...");
            }
        }
    }

    protected function _ConfirmateUserMailAddress($mail_key = null){
        $UMSC = new SessionController();

        $v = $this::sql("SELECT * FROM users WHERE mail_conf_key=?");
        $v2 = $v->execute([$mail_key]);
        $founded_user_data = $v->fetch(PDO::FETCH_ASSOC);

        if ($v->rowCount() > 0 && $v2)
        {

            $v = $this::sql("UPDATE users SET mail_conf_key=?, email_state=? WHERE id=?");
            $v2 = $v->execute(["", "confirmed", $founded_user_data["id"]]);
            $v3 = $v->fetch(PDO::FETCH_ASSOC);

            if ($v->rowCount() > 0 && $v2)
            {
                $UMSC->Set("SESSION_LOGIN_ERROR"    , "Mail Confirmed. Please login");
            }
            else{
                $v = null;
                return false;
            }
        }
        else{
            $v = null;
            return false;
        }

        return true;
    }


    protected function _UpdateUserPassword($new_password){
        $UMSC = new SessionController();

        $v = $this::sql("UPDATE users SET password=? WHERE id=?");
        $v2 = $v->execute([FCrypter::get()->getEncrypt($new_password), AuthController::getUserID()]);
        $v3 = $v->fetch(PDO::FETCH_ASSOC);

        if ($v->rowCount() > 0 && $v2)
        {
            $UMSC = new SessionController();
            $UMSC->Set("SESSION_PROFILE_SHOW_ERROR"    , true);
            $UMSC->Set("SESSION_PROFILE_ERROR"          , "Your password successfully updated!");
            $UMSC->Set("SESSION_PROFILE_TYPE"           , "bg-green-400 shadow-lg shadow-green-300");
        }
        else{

            $UMSC->Set("SESSION_PROFILE_SHOW_ERROR"    , true);
            $UMSC->Set("SESSION_PROFILE_ERROR"          , "Rw error please contact a support or try again later...");
            $UMSC->Set("SESSION_PROFILE_TYPE"           , "bg-red-400 shadow-lg shadow-red-300");

            $v = null;
            return false;
        }

        return true;
    }


    protected function _GetUserData($id){
        $v = $this::sql("SELECT * FROM users WHERE id=?");
        $v2 = $v->execute([$id]);
        $v3 = $v->fetch(PDO::FETCH_ASSOC);

        if ($v->rowCount() > 0 && $v2)
        {
            $v = null;
            return [true, $v3];
        }
        else{
            $v = null;
            return [false, null];
        }
    }
}