<?php

return [
  'default' => env('INVOICENINJA_QUEUE_DRIVER', 'sync'),

  'connections' => [
    'sync' => [
      'driver' => 'sync',
    ],

    'database' => [
      'connection' => env('INVOICENINJA_QUEUE_DATABASE_CONNECTION', 'mysql'),
      'driver' => 'database',
      'table' => 'jobs',
      'queue' => 'default',
      'expire' => 60,
    ],

    'beanstalkd' => [
      'driver' => 'beanstalkd',
      'host'   => env('INVOICENINJA_QUEUE_BEANSTALKD_HOST', 'localhost'),
      'queue'  => env('INVOICENINJA_QUEUE_BEANSTALKD_NAME', 'default'),
      'ttr'    => 60,
    ],

    'sqs' => [
      'driver' => 'sqs',
      'key'    => env('INVOICENINJA_QUEUE_SQS_KEY', 'your-public-key'),
      'secret' => env('INVOICENINJA_QUEUE_SQS_SECRET', 'your-secret-key'),
      'queue'  => env('INVOICENINJA_QUEUE_SQS_NAME', 'your-queue-url'),
      'region' => env('INVOICENINJA_QUEUE_SQS_REGION', 'us-east-1'),
    ],

    'iron' => [
      'driver'  => 'iron',
      'host'    => env('INVOICENINJA_QUEUE_IRON_HOST', 'mq-aws-us-east-1.iron.io'),
      'token'   => env('INVOICENINJA_QUEUE_IRON_TOKEN'),
      'project' => env('INVOICENINJA_QUEUE_IRON_PROJECT'),
      'queue'   => env('INVOICENINJA_QUEUE_IRON_NAME'),
      'encrypt' => env('INVOICENINJA_QUEUE_IRON_ENCRYPT', true),
    ],

    'redis' => [
      'driver' => 'redis',
      'queue'  => 'default',
      'expire' => 60,
    ],
  ],

  'failed' => [
    'database' => env('INVOICENINJA_QUEUE_DATABASE_CONNECTION', 'mysql'),
    'table' => 'failed_jobs',
  ],
];
