<?php

/**
 * ------------------------------------------------------------------------------------------------
 * Router Script for the built-in web server to emulate Apache's "mod_rewrite" functionality.
 * ------------------------------------------------------------------------------------------------
 *
 * This script is useful when you use the built-in web server to support application development or
 * testing.
 *
 * Command to starting the built-in web server:
 *  php -S localhost:8000 -t public/ router.php
 *
 * After you run the command above, enter this address into your browser to call your application:
 *  http://localhost:8000
 *
 * @see http://php.net/manual/en/features.commandline.webserver.php
 */

$url = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if ($url !== '/' && file_exists(__DIR__ . '/public' . $url)) {
    return false;
}

require __DIR__ . '/public/index.php';
