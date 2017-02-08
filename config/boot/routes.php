<?php

$route = \Core\Application::route();

$route->get('', function() {
    return view('test2', $data = collect(['name' => 'Anton']));
});

$route->get('migrations/{store}', function($store) {
    dd(database($store)->query('SELECT * FROM _migrations'));
});

$route->get('test/{id}/{format}', function($id, $format) {

    $log = logger();
    $log->log('warning', 'dings {foo} bums', ['foo' => 'bar']);

    return 'ok';
});

$route->get('testdb', 'TestDBController@index');

$route->get('home/{id}', 'HomeController@index');

//$route->get('home/{format?}', 'FeedController@test');
//$route->resource('admin/newsletters', 'HomeController');
