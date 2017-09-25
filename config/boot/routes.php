<?php

$route = Core\Application::route();

$route->middleware(['Csrf', 'Locale']);
$route->prefix(is_multilingual() && is_supported_locale(request()->segment(0)) ? request()->segment(0) : null);

$route->get('', 'HomeController@index');

$route->get('test', function() {
    return 'Just a test!';
});
