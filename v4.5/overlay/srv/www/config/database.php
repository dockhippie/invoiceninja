<?php

return [
  'fetch' => PDO::FETCH_CLASS,

  'default' => env('INVOICENINJA_DB_TYPE', 'mysql'),

  'connections' => [
    'sqlite' => [
      'driver' => 'sqlite',
      'database' => env('INVOICENINJA_DB_DATABASE', '/var/lib/invoiceninja/database.sqlite3'),
      'prefix' => env('INVOICENINJA_DB_PREFIX', ''),
    ],
    'mysql' => [
      'driver' => 'mysql',
      'host' => env('INVOICENINJA_DB_HOST', 'mysql'),
      'port' => env('INVOICENINJA_DB_PORT', '3306'),
      'database' => env('INVOICENINJA_DB_DATABASE', 'ninja'),
      'username' => env('INVOICENINJA_DB_USERNAME', 'root'),
      'password' => env('INVOICENINJA_DB_PASSWORD', ''),
      'charset' => env('INVOICENINJA_DB_CHARSET', 'utf8'),
      'collation' => env('INVOICENINJA_DB_COLLATION', 'utf8_general_ci'),
      'prefix' => env('INVOICENINJA_DB_PREFIX', ''),
      'strict' => env('INVOICENINJA_DB_STRICT', false),
      'engine' => 'InnoDB',
    ],
    'pgsql' => [
      'driver' => 'pgsql',
      'host' => env('INVOICENINJA_DB_HOST', 'postgres'),
      'port' => env('INVOICENINJA_DB_PORT', '5432'),
      'database' => env('INVOICENINJA_DB_DATABASE', 'ninja'),
      'username' => env('INVOICENINJA_DB_USERNAME', 'postgres'),
      'password' => env('INVOICENINJA_DB_PASSWORD', ''),
      'charset' => env('INVOICENINJA_DB_CHARSET', 'utf8'),
      'prefix' => env('INVOICENINJA_DB_PREFIX', ''),
      'schema' => env('INVOICENINJA_DB_SCHEMA', 'public'),
    ],
  ],

  'migrations' => 'migrations',

  'redis' => [
    'cluster' => false,

    'default' => [
      'host' => env('INVOICENINJA_REDIS_HOST', 'redis'),
      'port' => env('INVOICENINJA_REDIS_PORT', 6379),
      'database' => env('INVOICENINJA_REDIS_DATABASE', 0),
    ],
  ],
];
