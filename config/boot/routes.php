<?php

$route = Core\Application::route();

$route->middleware(['Csrf', 'Locale']);

$route->get('',              'HomeController@index');
$route->get('locale/{lang}', 'HomeController@locale');

$route->get('test', function() {
    return 'Just a test!';
});
