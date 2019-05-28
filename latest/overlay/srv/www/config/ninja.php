<?php

return [
  'video_urls' => [
    'all' => env('INVOICENINJA_VIDEOS_URL', 'https://www.youtube.com/channel/UCXAHcBvhW05PDtWYIq7WDFA/videos'),
    'custom_design' => env('INVOICENINJA_VIDEOS_CUSTOM_DESIGN_URL', 'https://www.youtube.com/watch?v=pXQ6jgiHodc'),
    'getting_started' => env('INVOICENINJA_VIDEOS_GETTING_STARTED_URL', 'https://www.youtube.com/watch?v=i7fqfi5HWeo'),
  ],
  'lock_sent_invoices' => env('INVOICENINJA_LOCK_SENT_INVOICES'),
  'time_tracker_web_url' => env('INVOICENINJA_TIME_TRACKER_WEB_URL', 'https://www.invoiceninja.com/time-tracker'),
  'knowledge_base_url' => env('INVOICENINJA_KNOWLEDGE_BASE_URL', 'https://www.invoiceninja.com/knowledge-base/'),
  'coupon_50_off' => env('INVOICENINJA_COUPON_50_OFF', false),
  'coupon_75_off' => env('INVOICENINJA_COUPON_75_OFF', false),
  'coupon_free_year' => env('INVOICENINJA_COUPON_FREE_YEAR', false),
  'exchange_rates_enabled' => env('INVOICENINJA_EXCHANGE_RATES_ENABLED', false),
  'exchange_rates_url' => env('INVOICENINJA_EXCHANGE_RATES_URL', 'https://api.fixer.io/latest'),
  'exchange_rates_base' => env('INVOICENINJA_EXCHANGE_RATES_BASE', 'EUR'),
  'terms_of_service_url' => [
    'hosted' => env('INVOICENINJA_TERMS_OF_SERVICE_URL', 'https://www.invoiceninja.com/terms/'),
    'selfhost' => env('INVOICENINJA_TERMS_OF_SERVICE_URL', 'https://www.invoiceninja.com/self-hosting-terms-service/'),
  ],
  'privacy_policy_url' => [
    'hosted' => env('INVOICENINJA_PRIVACY_POLICY_URL', 'https://www.invoiceninja.com/privacy-policy/'),
    'selfhost' => env('INVOICENINJA_PRIVACY_POLICY_URL', 'https://www.invoiceninja.com/self-hosting-privacy-data-control/'),
  ],
  'google_maps_enabled' => env('INVOICENINJA_GOOGLE_MAPS_ENABLED', true),
  'google_maps_api_key' => env('INVOICENINJA_GOOGLE_MAPS_API_KEY', ''),
  'voice_commands' => [
    'app_id' => env('INVOICENINJA_MSBOT_LUIS_APP_ID', 'ea1cda29-5994-47c4-8c25-2b58ae7ae7a8'),
    'subscription_key' => env('INVOICENINJA_MSBOT_LUIS_SUBSCRIPTION_KEY'),
  ],
];
