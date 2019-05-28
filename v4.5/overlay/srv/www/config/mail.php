<?php

return [
  'driver' => env('INVOICENINJA_MAIL_DRIVER', 'smtp'),
  'host' => env('INVOICENINJA_MAIL_HOST', 'smtp.mailgun.org'),
  'port' => env('INVOICENINJA_MAIL_PORT', 587),
  'from' => [
    'address' => env('INVOICENINJA_MAIL_FROM_ADDRESS'),
    'name' => env('INVOICENINJA_MAIL_FROM_NAME')
  ],
  'encryption' => env('INVOICENINJA_MAIL_ENCRYPTION', 'tls'),
  'username' => env('INVOICENINJA_MAIL_USERNAME', ''),
  'password' => env('INVOICENINJA_MAIL_PASSWORD', ''),
  'sendmail' => '/usr/sbin/sendmail -bs',
];
