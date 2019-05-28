<?php

namespace Websight\GcsProvider;

use CedricZiel\FlysystemGcs\GoogleCloudStorageAdapter;
use Google\Cloud\ServiceBuilder;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use Storage;

/**
 * Class CloudStorageServiceProvider
 * Configures Google Cloud Storage Access for flysystem
 *
 * @package Websight\GcsProvider
 */
class CloudStorageServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        Storage::extend('gcs', function ($app, $config) {

            $adapterConfiguration = ['bucket' => $config['bucket']];
            $serviceBuilderConfig = [];

            $optionalServiceBuilder = null;

            if (array_key_exists('project_id', $config) && false === empty($config['project_id'])) {
                $adapterConfiguration += ['projectId' => $config['project_id']];
                $serviceBuilderConfig += ['projectId' => $config['project_id']];
            }

            if (array_key_exists('credentials', $config) && false === empty($config['credentials'])) {
		// Fix from: https://github.com/websightgmbh/l5-google-cloud-storage/issues/12
		$adapterConfiguration += ['keyFilePath' => $config['credentials']];
                //$serviceBuilderConfig += ['keyFilePath' => $config['credentials']];
                //$optionalServiceBuilder = new ServiceBuilder($serviceBuilderConfig);
            }

            $adapter = new GoogleCloudStorageAdapter($optionalServiceBuilder, $adapterConfiguration);

            return new Filesystem($adapter);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        // Not needed
    }
}
