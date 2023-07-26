<?php

define("configs_site_rootfolder", $_SERVER["DOCUMENT_ROOT"]);



define("configs_framework_version", "2.6"); // I forget to commit between V1 and V2 with sub verisons
define("configs_site_version", "xxxxx");  // Like 1.0 or 1.1 or 1.2 or .... 9.16.8


define("configs_db_host", "db_host");
define("configs_db_username", "db_user");
define("configs_db_name", "db_name");
define("configs_db_password", "db_pass");

define("configs_mail_host", "mail..com");
define("configs_mail_username", "admin@.com");
define("configs_mail_from", "admin@.com");
define("configs_mail_sender", ".com");
define("configs_mail_port", 587);
define("configs_mail_password", "");


define("configs_host_domain", $_SERVER["HTTP_HOST"] ?? "fframework");   
define("configs_host_ssl", $_SERVER["REQUEST_SCHEME"] ?? "http");

define("configs_site_favicon", '<link rel="icon" href="'. configs_host_ssl . '://' . configs_host_domain . '/storage/favicon.ico" type="image/x-icon">');

define("configs_host_full", configs_host_ssl . "://" . configs_host_domain);


define("configs_api_prefix", "api");



define("framework_is_debug_mode", true);


define("configs_site_jquery", '<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>');
define("configs_site_tailwind", '<script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>');
define("configs_site_ionicicons", '<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script> <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>');

?>