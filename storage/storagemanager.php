<?php

$ttk = \Router\Router::AnalyzeMiddlewareUri();
$switchUri = "";

for ($i = 2; $i < sizeof($ttk); $i++) {
    $switchUri .= "/" . $ttk[$i];
}

if (!isset($ttk[2]) || $ttk[2] == "") {
    die("fuckoff");
}


switch ($ttk[1]) {
    case "js":
        {
            $attachment_location = "";
            $attachment_location .= configs_site_rootfolder . "/app/Includex/js";
            $attachment_location .= $switchUri;

            if (file_exists($attachment_location)) {
                header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
                header("Cache-Control: public"); // needed for internet explorer

                header('application/javascript');

                header("Content-Transfer-Encoding: Binary");
                header("Content-Length:" . filesize($attachment_location));
                readfile($attachment_location);
            } else {
                die("fuckoff");
            }


        }
        break;

    case "css":
        {
            $attachment_location = "";
            $attachment_location .= configs_site_rootfolder . "/app/Includex/css";
            $attachment_location .= $switchUri;

            if (file_exists($attachment_location)) {
                header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
                header("Cache-Control: public"); // needed for internet explorer

                header("Content-type: text/css");

                header("Content-Transfer-Encoding: Binary");
                header("Content-Length:" . filesize($attachment_location));
                readfile($attachment_location);
            } else {
                die("fuckoff");
            }
        }
        break;

    case "font":
        {
            $attachment_location = "";
            $attachment_location .= configs_site_rootfolder . "/storage/fonts";
            $attachment_location .= $switchUri;

            if (file_exists($attachment_location)) {
                header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
                header("Cache-Control: public"); // needed for internet explorer

                header("Content-type: font/ttf");

                header("Content-Transfer-Encoding: Binary");
                header("Content-Length:" . filesize($attachment_location));
                readfile($attachment_location);
            } else {
                die("fuckoff");
            }
        }
        break;

    case "image":
        {
            $attachment_location = "";
            $attachment_location .= configs_site_rootfolder . "/storage/fonts";
            $attachment_location .= $switchUri;

            if (file_exists($attachment_location)) {
                header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
                header("Cache-Control: public"); // needed for internet explorer

                header("Content-type: text/plain");

                header("Content-Transfer-Encoding: Binary");
                header("Content-Length:" . filesize($attachment_location));
                readfile($attachment_location);
            } else {
                die("fuckoff");
            }
        }

        break;

    default:
        die("invalid_request...");
        break;

}
?>
