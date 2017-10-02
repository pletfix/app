<?php

$router = \Core\Services\DI::getInstance()->get('router');

$router->middleware(['Csrf', 'Locale']);
$router->prefix(is_multilingual() && is_supported_locale(request()->segment(0)) ? request()->segment(0) : null);

$router->get('', 'HomeController@index');

$router->get('test', function() {
    return 'Just a test!';
});
