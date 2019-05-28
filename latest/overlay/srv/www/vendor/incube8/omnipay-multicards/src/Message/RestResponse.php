<?php
/**
 * MultiCards REST Response
 */

namespace Omnipay\Multicards\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * MultiCards REST Response
 *
 * This is the response class for all MultiCards REST requests.
 *
 * @see \Omnipay\Multicards\Gateway
 */
class RestResponse extends AbstractResponse
{
    protected $statusCode;

    public function __construct(RequestInterface $request, $data, $statusCode = 200)
    {
        parent::__construct($request, $data);
        $this->statusCode = $statusCode;
    }

    public function isSuccessful()
    {
        // The MultiCards gateway returns errors in several possible different ways.
        if ($this->getCode() >= 400) {
            return false;
        }

        if (! empty($this->data['response_code']) && $this->data['response_code'] > 1) {
            return false;
        }

        // Special case for refunds where response_code 1 means error
        if (! empty($this->data['response_code']) &&
            $this->data['response_code'] == '001' &&
            ! empty($this->data['response_text']) &&
            strpos($this->data['response_text'], 'invalid MerchantID') > 0) {
            return false;
        }

        return true;
    }

    public function getTransactionReference()
    {
        // This is usually correct for payments, authorizations, etc
        if (! empty($this->data['trans_id'])) {
            return $this->data['trans_id'];
        }
        return null;
    }

    /**
     * Get the card reference
     *
     * Where a card is provided when a purchase is made, and the variable req_trans_token
     * is sent with the payment, a card reference is returned as part of the response, in
     * the token_id entry.
     *
     * @return string
     */
    public function getCardReference()
    {
        // This is correct for payments
        if (! empty($this->data['token_id'])) {
            return $this->data['token_id'];
        }

        return null;
    }

    public function getMessage()
    {
        if (isset($this->data['response_text'])) {
            return $this->data['response_text'];
        }
        return null;
    }

    public function getCode()
    {
        if (isset($this->data['response_code'])) {
            return $this->data['response_code'];
        }
        return $this->statusCode;
    }
}
