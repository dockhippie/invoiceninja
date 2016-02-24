<?php
return [
  'fetch' => PDO::FETCH_CLASS,

  'default' => env('DB_TYPE', 'mysql'),

  'connections' => [
    'sqlite' => [
      'driver' => 'sqlite',
      'database' => env('DB_DATABASE', '/storage/database.sqlite3'),
      'prefix' => env('DB_PREFIX', ''),
    ],
    'mysql' => [
      'driver' => 'mysql',
      'host' => env('DB_HOST', 'localhost'),
      'database' => env('DB_DATABASE', 'ninja'),
      'username' => env('DB_USERNAME', 'root'),
      'password' => env('DB_PASSWORD', 'root'),
      'charset' => env('DB_CHARSET', 'utf8'),
      'collation' => env('DB_COLLATION', 'utf8_general_ci'),
      'prefix' => env('DB_PREFIX', ''),
      'strict' => env('DB_STRICT', false),
    ],
    'pgsql' => [
      'driver' => 'pgsql',
      'host' => env('DB_HOST', 'localhost'),
      'database' => env('DB_DATABASE', 'ninja'),
      'username' => env('DB_USERNAME', 'root'),
      'password' => env('DB_PASSWORD', 'root'),
      'charset' => env('DB_CHARSET', 'utf8'),
      'prefix' => env('DB_PREFIX', ''),
      'schema' => env('DB_SCHEMA', 'public'),
    ],
  ],

  'migrations' => 'migrations',

  'redis' => [
    'cluster' => false,

    'default' => [
      'host' => '127.0.0.1',
      'port' => 6379,
      'database' => 0,
    ],
  ],
];
