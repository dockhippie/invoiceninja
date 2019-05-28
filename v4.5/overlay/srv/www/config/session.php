<?php

return [
	'driver' => env('INVOICENINJA_SESSION_DRIVER', 'file'),
	'lifetime' => env('INVOICENINJA_SESSION_LIFETIME', (60 * 8)),
	'expire_on_close' => env('INVOICENINJA_SESSION_EXPIRE_ON_CLOSE', true),
	'encrypt' => env('INVOICENINJA_SESSION_ENCRYPT', false),
	'files' => storage_path().'/framework/sessions',
	'connection' => env('INVOICENINJA_SESSION_CONNECTION', 'mysql'),
	'table' => 'sessions',
	'lottery' => [2, 100],
	'cookie' => env('INVOICENINJA_SESSION_COOKIE', 'ninja_session'),
	'path' => '/',
	'domain' => env('INVOICENINJA_SESSION_DOMAIN', null),
	'secure' => env('INVOICENINJA_SESSION_SECURE', false),
];
