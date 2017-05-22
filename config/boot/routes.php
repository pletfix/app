<?php

$route = \Core\Application::route();

$route->get('', 'HomeController@index');

$route->get('test', function() {
});

// Authentication Routes
$route->get('auth/login',   'Auth\LoginController@form');
$route->post('auth/login',  'Auth\LoginController@login');
$route->post('auth/logout', 'Auth\LoginController@logout');

//// Registration Routes
//$route->get('auth/register',  'Auth\RegisterController@showRegistrationForm');
//$route->post('auth/register', 'Auth\RegisterController@register');
//
//// Password Reset Routes
//$route->get('auth/password/reset',         'Auth\ForgotPasswordController@showLinkRequestForm');
//$route->post('auth/password/email',        'Auth\ForgotPasswordController@sendResetLinkEmail');
//$route->get('auth/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
//$route->post('auth/password/reset',        'Auth\ResetPasswordController@reset');