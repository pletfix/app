<?php

/*
 * Save the start time for benchmark tests.
 */
define('APP_STARTTIME', microtime(true));

/*
 * Set the base path for the application.
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


///*
// * Push the Services into the Dependency Injector.
// */
//call_user_func(function() {
//    require __DIR__ . '/../boot/services.php';
//});
//
///*
// * Bootstraps the framework
// */
//(new Bootstraps\LoadConfiguration)->bootstrap();
//(new Bootstraps\HandleExceptions)->bootstrap();
//(new Bootstraps\HandleShutdown)->bootstrap();
//
///*
// * Register routes.
// */
//call_user_func(function() {
//    require __DIR__ . '/../boot/routes.php';
//});
//
///*
// * Dispatch the HTTP request and send the response to the browser.
// */
//App\Services\DI::getInstance()->get('route')->dispatch(
//    App\Services\DI::getInstance()->get('request')
//)->send();
