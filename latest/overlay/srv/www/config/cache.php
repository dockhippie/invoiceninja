<?php

return [
  'default' => env('INVOICENINJA_CACHE_DRIVER', 'file'),

  'stores' => [
    'apc' => [
      'driver' => 'apc'
    ],

    'array' => [
      'driver' => 'array'
    ],

    'database' => [
      'driver' => 'database',
      'table' => 'cache',
      'connection' => env('INVOICENINJA_CACHE_DATABASE', 'mysql'),
    ],

    'file' => [
      'driver' => 'file',
      'path' => storage_path().'/framework/cache',
    ],

    'memcached' => [
      'driver' => 'memcached',
      'servers' => [
        [
          'host' => env('INVOICENINJA_CACHE_MEMCACHED_HOST', '127.0.0.1'),
          'port' => env('INVOICENINJA_CACHE_MEMCACHED_PORT', 11211),
          'weight' => 100
        ],
      ],
    ],

    'redis' => [
      'driver' => 'redis',
      'connection' => 'default',
    ],
  ],

  'prefix' => 'laravel',
];
