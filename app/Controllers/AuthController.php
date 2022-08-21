<?php

namespace AuthController;

use AuthModel\AuthModel;
use FCrypter\FCrypter;
use SessionController\SessionController;

class AuthController extends AuthModel
{
    private static $authedUserUID = null;

    public static function initializeAuthlib($uid){
        AuthController::$authedUserUID = $uid;
    }

    public static function isLogged(){
        $ACSC = new SessionController();
        $returnval = $ACSC->Get("usersession_is_loggedin");
        $ACSC = null;

        if ($returnval){
            return true;
        }
        else{
            return false;
        }
    }

    public static function isAdmin(){
        return false; // or true
    }

    public static function getUserData(){
        return "user-statement-in-your-database"; // or null/false
    }

    public static function passwordCheck($password){
        return false; // or true
    }

    public static function getUserID(){
        $result = AuthController::getUserData();

        if (!$result)
            return null;

       return $result["id"];
    }
}