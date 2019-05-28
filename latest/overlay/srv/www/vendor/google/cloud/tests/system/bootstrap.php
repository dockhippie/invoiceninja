<?php

require __DIR__ . '/../../vendor/autoload.php';

use Google\Cloud\Tests\System\BigQuery\BigQueryTestCase;
use Google\Cloud\Tests\System\Datastore\DatastoreTestCase;
use Google\Cloud\Tests\System\Logging\LoggingTestCase;
use Google\Cloud\Tests\System\PubSub\PubSubTestCase;
use Google\Cloud\Tests\System\Spanner\SpannerTestCase;
use Google\Cloud\Tests\System\Storage\StorageTestCase;
use Google\Cloud\Core\Testing\System\SystemTestCase;
use Google\Cloud\Tests\System\Whitelist\WhitelistTest;

if (!getenv('GOOGLE_CLOUD_PHP_TESTS_KEY_PATH')) {
    throw new \Exception(
        'Please set the \'GOOGLE_CLOUD_PHP_TESTS_KEY_PATH\' env var to run the system tests'
    );
}

if (!getenv('GOOGLE_CLOUD_PHP_FIRESTORE_TESTS_KEY_PATH')) {
    throw new \Exception(
        'Please set the \'GOOGLE_CLOUD_PHP_FIRESTORE_TESTS_KEY_PATH\' env var to run the system tests'
    );
}

if (getenv('GOOGLE_CLOUD_PHP_TESTS_WHITELIST_KEY_PATH')) {
    define('GOOGLE_CLOUD_WHITELIST_KEY_PATH', getenv('GOOGLE_CLOUD_PHP_TESTS_WHITELIST_KEY_PATH'));
}

SystemTestCase::setupQueue();

$pid = getmypid();
register_shutdown_function(function () use ($pid) {
    // Skip flushing deletion queue if exiting a forked process.
    if ($pid !== getmypid()) {
        return;
    }

    DatastoreTestCase::tearDownFixtures();

    // This should always be last.
    SystemTestCase::processQueue();
});
