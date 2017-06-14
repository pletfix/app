<?php

return [

    /**
     * ----------------------------------------------------------------
     * Default Cache Store
     * ----------------------------------------------------------------
     *
     * This option controls the default cache connection that gets used while
     * using this caching library. This connection is used when another is
     * not explicitly specified when executing a given caching function.
     */

    'default' => env('CACHE_DRIVER', 'file'),

    /**
     * ----------------------------------------------------------------
     * Cache Stores
     * ----------------------------------------------------------------
     *
     * Here you may define all of the cache "stores" for your application as
     * well as their drivers. You may even define multiple stores for the
     * same cache driver to group types of items stored in your caches.
     *
     * Supported Driver:
     * - "apc"          (requires ext/apc)
     * - "array"        (in memory, lifetime of the request)
     * - "file"         (not optimal for high concurrency)
     * - "memcached"    (requires ext/memcached)
     * - "redis"        (requires ext/phpredis)
     */

    'stores' => [

        'apc' => [
            'driver' => 'apc',
        ],

        'array' => [
            'driver' => 'array',
        ],

        'file' => [
            'driver' => 'file',
            'path'   => storage_path('cache/doctrine'),
        ],

        'memcached' => [
            'driver' => 'memcached',
            'host'   => env('MEMCACHED_HOST', '127.0.0.1'),
            'port'   => env('MEMCACHED_PORT', 11211),
            'weight' => 100,
        ],

        'redis' => [
            'driver'  => 'redis',
            'host'    => env('REDIS_HOST', '127.0.0.1'),
            'port'    => env('REDIS_PORT', 6379),
            'timeout' => 0.0,
        ],

    ],

];
