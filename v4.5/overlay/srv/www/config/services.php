<?php

return [
  'postmark' => env('INVOICENINJA_POSTMARK_API_TOKEN', ''),

  'mailgun' => [
    'domain' => env('INVOICENINJA_MAILGUN_DOMAIN', ''),
    'secret' => env('INVOICENINJA_MAILGUN_SECRET', ''),
  ],

  'mandrill' => [
    'secret' => env('INVOICENINJA_MANDRILL_SECRET', ''),
  ],

  'sparkpost' => [
    'secret' => env('INVOICENINJA_SPARKPOST_SECRET', ''),
  ],

  'ses' => [
    'key' => env('INVOICENINJA_SES_KEY', ''),
    'secret' => env('INVOICENINJA_SES_SECRET', ''),
    'region' => env('INVOICENINJA_SES_REGION', 'us-east-1'),
  ],

  'stripe' => [
    'model' => env('INVOICENINJA_STRIPE_MODEL', 'User'),
    'secret' => env('INVOICENINJA_STRIPE_SECRET', ''),
  ],

  'github' => [
    'client_id' => env('INVOICENINJA_GITHUB_CLIENT_ID'),
    'client_secret' => env('INVOICENINJA_GITHUB_CLIENT_SECRET'),
    'redirect' => env('INVOICENINJA_GITHUB_OAUTH_REDIRECT'),
  ],

  'google' => [
    'client_id' => env('INVOICENINJA_GOOGLE_CLIENT_ID'),
    'client_secret' => env('INVOICENINJA_GOOGLE_CLIENT_SECRET'),
    'redirect' => env('INVOICENINJA_GOOGLE_OAUTH_REDIRECT'),
  ],

  'facebook' => [
    'client_id' => env('INVOICENINJA_FACEBOOK_CLIENT_ID'),
    'client_secret' => env('INVOICENINJA_FACEBOOK_CLIENT_SECRET'),
    'redirect' => env('INVOICENINJA_FACEBOOK_OAUTH_REDIRECT'),
  ],

  'linkedin' => [
    'client_id' => env('INVOICENINJA_LINKEDIN_CLIENT_ID'),
    'client_secret' => env('INVOICENINJA_LINKEDIN_CLIENT_SECRET'),
    'redirect' => env('INVOICENINJA_LINKEDIN_OAUTH_REDIRECT'),
  ],
];
