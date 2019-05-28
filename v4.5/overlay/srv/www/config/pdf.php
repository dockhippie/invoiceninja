<?php

return [
  'phantomjs' => [
    'secret' => env('INVOICENINJA_PHANTOMJS_SECRET'),
    'bin_path' => env('INVOICENINJA_PHANTOMJS_BIN_PATH'),
    'cloud_key' => env('INVOICENINJA_PHANTOMJS_CLOUD_KEY')
  ]
];
