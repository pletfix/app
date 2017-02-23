<?php

$route = \Core\Application::route();

$route->get('', 'HomeController@index');

$route->get('test', function() {
});
