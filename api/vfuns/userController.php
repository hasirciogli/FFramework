<?php

require __DIR__ . "/../internal_funcs/PluginBaseController.php";

class PluginController
{
    public function run($params)
    {
        //die("ok" . var_dump($params));
    }

    public function login($params)
    {


        if (!PBSController::cfun()->requireOnlyPost())
            makeResponse(400, "Bad Request", false, [
                "err" => "you just need a post request",
            ]);

        if (!PBSController::cfun()->checkNullOrBlankInPost(["username", "password"]))
            makeResponse(400, "Bad Request", false, [
                "err" => "please use correct post parameters",
            ]);


        // TODO: do login here...

        // example: YourInternalUserController()->cfun()->login($_POST["username"], $_POST["password"]);

        makeResponse(200, "Success", false, [
            "info" => "Successfully logged in",
            "userFields" => [
                "username" => $_POST["username"],
                "password" => $_POST["password"],
                "params" => $params
            ]
        ]);

        makeResponse(500, "Internal Server Error", false, [
            "err" => "Function is blank",
        ]);
    }

    public static function cfun($params)
    {
        $pc = new PluginController();
        $pc->run($params);
        return $pc;
    }
}
