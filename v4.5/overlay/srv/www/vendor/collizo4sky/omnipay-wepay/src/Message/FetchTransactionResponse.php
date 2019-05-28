<?php

namespace Omnipay\WePay\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * WePay Fetch Transaction Response.
 */
class FetchTransactionResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return isset($this->data['state'])
               && in_array($this->data['state'], array('authorized', 'reserved', 'captured'));
    }

    public function getTransactionReference()
    {
        return isset($this->data['checkout_id']) ? $this->data['checkout_id'] : null;
    }

    public function getTransactionId()
    {
        return isset($this->data['reference_id']) ? $this->data['reference_id'] : null;
    }

    public function getCode()
    {
        return isset($this->data['error_code']) ? $this->data['error_code'] : null;
    }

    public function getMessage()
    {
        return isset($this->data['error_description']) ? $this->data['error_description'] : null;
    }
}
