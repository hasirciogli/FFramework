<?php

namespace app\view;

use app\assignments\view\PAGETYPES;
use app\route\Router;



class View
{
    public static function Show($load, $type)
    {
        switch ($type) {
            case PAGETYPES::PAGE_TYPE_NORMAL:
                if (file_exists(configs_site_rootfolder . "/app/view/views/" . $load . ".hff.php"))
                    include(configs_site_rootfolder . "/app/view/views/" . $load . ".hff.php");
                else {
                    self::Show("404", PAGETYPES::PAGE_TYPE_ERROR);
                }

                break;

            case PAGETYPES::PAGE_TYPE_ERROR:

                header("HTTP/1.0 404 Not Found");

                if (file_exists(configs_site_rootfolder . "/app/pages/" . $load . ".php"))
                    include(configs_site_rootfolder . "/app/pages/" . $load . ".php");

                break;

            case PAGETYPES::PAGE_TYPE_DERROR:
                include $_SERVER["DOCUMENT_ROOT"] . "/app/view/datapages/header.php";

                include($_SERVER["DOCUMENT_ROOT"] . "/app/frameworkpages/" . $load . ".php");

                include $_SERVER["DOCUMENT_ROOT"] . "/app/view/datapages/footer.php";
                break;
            default:

                break;
        }
        return 1;
    }
}