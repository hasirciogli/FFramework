<?php

class PBSController
{

    public function requireOnlyPost()
    {
        if (!$_POST || $_GET)
            return false;

        return true;
    }

    public function requireOnlyGet()
    {
        if (!$_GET || $_POST)
            return false;

        return true;
    }

    public function requirePGTwice()
    {
        if (!$_GET || !$_POST)
            return false;

        return true;
    }




    public function checkNullOrBlankInPost($dataArray)
    {
       foreach ($dataArray as $val)
       {
            if(!isset($_POST[$val]) || $_POST[$val] == null || $_POST[$val] == "")
                return false;
       }

        return true;
    }

    public function checkNullOrBlankInGet($dataArray)
    {
       foreach ($dataArray as $val)
       {
            if(!isset($_GET[$val]) || $_GET[$val] == null || $_GET[$val] == "")
                return false;
       }

        return true;
    }


    public static function cfun()
    {
        return new PBSController();
    }
}
