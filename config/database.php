<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Store Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_STORE', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Stores
    |--------------------------------------------------------------------------
    |
    | Here are each of the database setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    |  Supported Driver:
    | - "mysql"     (MySql)
    | - "pgsql"     (PostgreSQL)
    | - "sqlite"    (SQLite)
    | - "sqlsrv"    (Microsoft SQL Server)
    |
    */

    'stores' => [

        'mysql' => [
            'driver'     => 'mysql',
            'host'       => env('DB_MYSQL_HOST', 'localhost'),
            'port'       => env('DB_MYSQL_PORT', 3306),
            'database'   => env('DB_MYSQL_DATABASE', 'localhost\SQLEXPRESS'),
            'username'   => env('DB_MYSQL_USERNAME', 'forge'),
            'password'   => env('DB_MYSQL_PASSWORD', ''),
        ],

        'pgsql' => [
            'driver'     => 'pgsql',
            'host'       => env('DB_PGSQL_HOST', 'localhost'),
            'port'       => env('DB_PGSQL_PORT', 5432),
            'database'   => env('DB_PGSQL_DATABASE', 'forge'),
            'username'   => env('DB_PGSQL_USERNAME', 'forge'),
            'password'   => env('DB_PGSQL_PASSWORD', ''),
            'schema'     => 'test', //'public',
        ],

        'sqlite' => [
            'driver'     => 'sqlite',
            'database'   => storage_path(env('DB_SQLITE_DATABASE', 'db/sqlite.db')),
        ],

        'sqlsrv' => [
            'driver'     => 'sqlsrv',
            'host'       => env('DB_SQLSRV_HOST', 'localhost'),
            'port'       => env('DB_SQLSRV_PORT', 1433),
            'database'   => env('DB_SQLSRV_DATABASE', 'forge'),
            'username'   => env('DB_SQLSRV_USERNAME', 'forge'),
            'password'   => env('DB_SQLSRV_PASSWORD', ''),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

];
