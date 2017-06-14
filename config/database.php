<?php

return [

    /**
     * ----------------------------------------------------------------
     * Default Database Store Name
     * ----------------------------------------------------------------
     *
     * Here you may specify which of the database stores below you wish
     * to use as your default store.
     */

    'default' => env('DB_STORE', 'mysql'),

    /**
     * ----------------------------------------------------------------
     * Database Stores
     * ----------------------------------------------------------------
     *
     * Here are each of the database setup for your application.
     *
     *  Supported Driver:
     * - "mysql"     (MySql)
     * - "pgsql"     (PostgreSQL)
     * - "sqlite"    (SQLite)
     * - "sqlsrv"    (Microsoft SQL Server)
     */

    'stores' => [

        'mysql' => [
            'driver'     => 'mysql',
            'host'       => env('DB_MYSQL_HOST', 'localhost'),
            'port'       => env('DB_MYSQL_PORT', 3306),
            'database'   => env('DB_MYSQL_DATABASE'),
            'username'   => env('DB_MYSQL_USERNAME', 'forge'),
            'password'   => env('DB_MYSQL_PASSWORD', ''),
        ],

        'pgsql' => [
            'driver'     => 'pgsql',
            'host'       => env('DB_PGSQL_HOST', 'localhost'),
            'port'       => env('DB_PGSQL_PORT', 5432),
            'database'   => env('DB_PGSQL_DATABASE'),
            'username'   => env('DB_PGSQL_USERNAME'),
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
            'database'   => env('DB_SQLSRV_DATABASE'),
            'username'   => env('DB_SQLSRV_USERNAME'),
            'password'   => env('DB_SQLSRV_PASSWORD', ''),
        ],

    ],
];
