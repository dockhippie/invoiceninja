<?php

return [
  'ninjaIOS' => [
    'environment' => 'production',
    'certificate' => env('INVOICENINJA_PUSH_IOS_CERTIFICATE_PATH', storage_path().'/productionNinjaIOS.pem'),
    'passPhrase' => env('INVOICENINJA_PUSH_IOS_PASSPHRASE'),
    'service' => 'apns'
  ],
  'ninjaAndroid' => [
    'environment' => 'production',
    'apiKey' => env('INVOICENINJA_PUSH_ANDROID_APIKEY'),
    'service' => 'gcm'
  ]
];
