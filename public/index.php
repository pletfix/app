<?php

/*
 * Set the base path of the application.
 */
define('BASE_PATH', realpath(__DIR__ . '/..'));

/*
 * Register the Composer Autoloader
 *
 * @link https://getcomposer.org/
 */
require __DIR__ . '/../vendor/autoload.php';

/*
 * Run...
 */
\Core\Application::run();
