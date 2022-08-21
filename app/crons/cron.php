<?php
//return;
//$data = file_get_contents("/home/yokartkc/domains/hsrcpay.com/public_html/app/crons/x.txt");
//file_put_contents("/home/yokartkc/domains/hsrcpay.com/public_html/app/crons/x.txt", $data . "31 \n");


require "/home/yokartkc/domains/hsrcpay.com/public_html/vendor/autoload.php";
require "/home/yokartkc/domains/hsrcpay.com/public_html/app/FFunctions/FrameworkFunctions.php";
require "/home/yokartkc/domains/hsrcpay.com/public_html/app/Database/Database.php";
require "/home/yokartkc/domains/hsrcpay.com/public_html/app/Configs/Config.php";

use DATABASE\Database;
use \FrameworkFunctions\FrameworkFunctions;

class cronexample
{
    public function run(array $args = null)
    {
        
    }

    public static function get()
    {
        return new cronexample();
    }
}

cronexample::get()->run([["arg-key" => "arg-val"], ["arg2-key", "arg2-val"]]);