<?php

namespace View;
use Router\Router;

enum pageTypes{
    case PAGE_TYPE_NORMAL;
    case PAGE_TYPE_ERROR;
    case PAGE_TYPE_DERROR;
}

class View
{
    public static function Show($load, $type){
        switch ($type){
            case pageTypes::PAGE_TYPE_NORMAL:
                include $_SERVER["DOCUMENT_ROOT"] . "/app/View/datapages/header.php";

                include ($_SERVER["DOCUMENT_ROOT"] . "/app/View/Views/". $load .".php");

                include $_SERVER["DOCUMENT_ROOT"] . "/app/View/datapages/footer.php";
                break;

            case pageTypes::PAGE_TYPE_ERROR:
                include $_SERVER["DOCUMENT_ROOT"] . "/app/View/datapages/header.php";

                include ($_SERVER["DOCUMENT_ROOT"] . "/app/Pages/". $load .".php");

                include $_SERVER["DOCUMENT_ROOT"] . "/app/View/datapages/footer.php";
                break;

            case pageTypes::PAGE_TYPE_DERROR:
                include $_SERVER["DOCUMENT_ROOT"] . "/app/View/datapages/header.php";

                include ($_SERVER["DOCUMENT_ROOT"] . "/app/FrameworkPages/". $load .".php");

                include $_SERVER["DOCUMENT_ROOT"] . "/app/View/datapages/footer.php";
                break;
            default:

                break;
        }
        return 1;
    }
}