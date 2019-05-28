<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/privacy/dlp/v2beta1/storage.proto

namespace Google\Cloud\Dlp\V2beta1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Message for a unique key indicating a record that contains a finding.
 *
 * Generated from protobuf message <code>google.privacy.dlp.v2beta1.RecordKey</code>
 */
class RecordKey extends \Google\Protobuf\Internal\Message
{
    protected $type;

    public function __construct() {
        \GPBMetadata\Google\Privacy\Dlp\V2Beta1\Storage::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.google.privacy.dlp.v2beta1.CloudStorageKey cloud_storage_key = 1;</code>
     * @return \Google\Cloud\Dlp\V2beta1\CloudStorageKey
     */
    public function getCloudStorageKey()
    {
        return $this->readOneof(1);
    }

    /**
     * Generated from protobuf field <code>.google.privacy.dlp.v2beta1.CloudStorageKey cloud_storage_key = 1;</code>
     * @param \Google\Cloud\Dlp\V2beta1\CloudStorageKey $var
     * @return $this
     */
    public function setCloudStorageKey($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Dlp\V2beta1\CloudStorageKey::class);
        $this->writeOneof(1, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.google.privacy.dlp.v2beta1.DatastoreKey datastore_key = 2;</code>
     * @return \Google\Cloud\Dlp\V2beta1\DatastoreKey
     */
    public function getDatastoreKey()
    {
        return $this->readOneof(2);
    }

    /**
     * Generated from protobuf field <code>.google.privacy.dlp.v2beta1.DatastoreKey datastore_key = 2;</code>
     * @param \Google\Cloud\Dlp\V2beta1\DatastoreKey $var
     * @return $this
     */
    public function setDatastoreKey($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Dlp\V2beta1\DatastoreKey::class);
        $this->writeOneof(2, $var);

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->whichOneof("type");
    }

}

