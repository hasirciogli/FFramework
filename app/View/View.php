<?php

namespace View;

use Router\Router;

enum pageTypes
{
    case PAGE_TYPE_NORMAL;
    case PAGE_TYPE_ERROR;
    case PAGE_TYPE_DERROR;
}

class View
{
    public static function Show($load, $type)
    {
        switch ($type) {
            case pageTypes::PAGE_TYPE_NORMAL:
                if (file_exists(configs_site_rootfolder . "/app/View/Views/" . $load . ".php"))
                    include(configs_site_rootfolder . "/app/View/Views/" . $load . ".php");
                else {
                    self::Show("404", pageTypes::PAGE_TYPE_ERROR);
                }

                break;

            case pageTypes::PAGE_TYPE_ERROR:

                if (file_exists(configs_site_rootfolder . "/app/Pages/" . $load . ".php"))
                    include(configs_site_rootfolder . "/app/Pages/" . $load . ".php");
                else {
                    header("HTTP/1.0 404 Not Found");
                }

                break;

            case pageTypes::PAGE_TYPE_DERROR:
                include $_SERVER["DOCUMENT_ROOT"] . "/app/View/datapages/header.php";

                include($_SERVER["DOCUMENT_ROOT"] . "/app/FrameworkPages/" . $load . ".php");

                include $_SERVER["DOCUMENT_ROOT"] . "/app/View/datapages/footer.php";
                break;
            default:

                break;
        }
        return 1;
    }
}