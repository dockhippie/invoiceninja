<?php

return [
  'default' => env('INVOICENINJA_FILESYSTEMS_DEFAULT', 'local'),
  'cloud' => env('INVOICENINJA_FILESYSTEMS_CLOUD', 's3'),

  'disks' => [
    'local' => [
      'driver' => 'local',
      'root' => storage_path().'/app',
    ],

    'logos' => [
      'driver' => 'local',
      'root' => env('INVOICENINJA_LOGO_PATH', public_path().'/logo'),
    ],

    'documents' => [
      'driver' => 'local',
      'root' => storage_path().'/documents',
    ],

    's3' => [
      'driver' => 's3',
      'key' => env('INVOICENINJA_FILESYSTEMS_S3_KEY', ''),
      'secret' => env('INVOICENINJA_FILESYSTEMS_S3_SECRET', ''),
      'region' => env('INVOICENINJA_FILESYSTEMS_S3_REGION', 'us-east-1'),
      'bucket' => env('INVOICENINJA_FILESYSTEMS_S3_BUCKET', ''),
    ],

    'rackspace' => [
      'driver' => 'rackspace',
      'username' => env('INVOICENINJA_FILESYSTEMS_RACKSPACE_USERNAME', ''),
      'key' => env('INVOICENINJA_FILESYSTEMS_RACKSPACE_KEY', ''),
      'container' => env('INVOICENINJA_FILESYSTEMS_RACKSPACE_CONTAINER', ''),
      'endpoint' => env('INVOICENINJA_FILESYSTEMS_RACKSPACE_ENDPOINT', 'https://identity.api.rackspacecloud.com/v2.0/'),
      'region' => env('INVOICENINJA_FILESYSTEMS_RACKSPACE_REGION', 'IAD'),
      'url_type' => env('INVOICENINJA_FILESYSTEMS_RACKSPACE_URL_TYPE', 'publicURL')
    ],

    'gcs' => [
      'driver' => 'gcs',
      'bucket' => env('INVOICENINJA_FILESYSTEMS_GCS_BUCKET', 'cloud-storage-bucket'),
      'project_id' => env('INVOICENINJA_FILESYSTEMS_GCS_PROJECT_ID'),
      'credentials' => env('INVOICENINJA_FILESYSTEMS_GCS_CREDENTIALS_PATH', storage_path().'/gcs-credentials.json'),
    ],
  ],
];
