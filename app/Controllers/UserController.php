<?php

namespace app\controllers;

use app\database\DB;
use app\models\UserModel;

class UserController extends UserModel
{

    public function createUser($name, $surname, $username, $email, $password): bool {
        return DB::cfun()->insert("users", [
            "user_id",
            "name",
            "surname",
            "username",
            "email",
            "password"
        ])
            ->bindParam("user_id", hash("sha256", time() .pack("H*", time() .sha1(time() . $name. time() .$surname. time() .$username. time() .$email. time() .$password. time() .$password))))
            ->bindParam("name", $name)
            ->bindParam("surname", $surname)
            ->bindParam("username", $username)
            ->bindParam("email", $email)
            ->bindParam("password", $password)
            ->run() != false;
    }

    public static function cfun(){
        return new UserController();
    }
}