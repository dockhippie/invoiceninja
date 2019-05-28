<?php
/**
 * Fat Zebra REST Response
 */

namespace Omnipay\Fatzebra\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * Fat Zebra REST Response
 *
 * This is the response class for all Fat Zebra REST requests.
 *
 * @see \Omnipay\Fatzebra\FatzebraGateway
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
        // The Fat Zebra gateway returns errors in several possible different ways.
        if ($this->getCode() >= 400) {
            return false;
        }
        
        if (! empty($this->data['errors'])) {
            return false;
        }
        
        if (! empty($this->data['response']['successful'])) {
            return $this->data['response']['successful'];
        }
        
        return true;
    }

    public function getTransactionReference()
    {
        // This is usually correct for payments, authorizations, etc
        if (!empty($this->data['response']) && !empty($this->data['response']['id'])) {
            return $this->data['response']['id'];
        }

        // This is correct for tokenize
        if (!empty($this->data['response']) && !empty($this->data['response']['token'])) {
            return $this->data['response']['token'];
        }

        // This is correct for create customer
        if (!empty($this->data['response']) && !empty($this->data['response']['card_token'])) {
            return $this->data['response']['card_token'];
        }

        // This is correct for create plan
        if (!empty($this->data['response']) && !empty($this->data['response']['plan'])) {
            return $this->data['response']['plan'];
        }

        return null;
    }

    /**
     * Get Card Reference
     *
     * This is used after createCard or createCustomer to get the credit card token to be
     * used in future transactions.
     *
     * @return string
     */
    public function getCardReference()
    {
        if (isset($this->data['response']['token'])) {
            return $this->data['response']['token'];
        }
        if (isset($this->data['response']['card_token'])) {
            return $this->data['response']['card_token'];
        }
    }

    /**
     * Get Customer Reference
     *
     * This is used after createCustomer to get the customer token to be
     * used in future transactions.
     *
     * @return string
     */
    public function getCustomerReference()
    {
        if (isset($this->data['response']['customer'])) {
            return $this->data['response']['customer'];
        }
        if (isset($this->data['response']['id'])) {
            return $this->data['response']['id'];
        }
    }

    /**
     * Get Plan Reference
     *
     * This is used after createPlan to get the plan token to be
     * used in future transactions.
     *
     * @return string
     */
    public function getPlanReference()
    {
        if (isset($this->data['response']['plan'])) {
            return $this->data['response']['plan'];
        }
    }

    /**
     * Get Subscription Reference
     *
     * This is used after createSubscription to get the subscription token to be
     * used in future transactions.
     *
     * @return string
     */
    public function getSubscriptionReference()
    {
        if (isset($this->data['response']['id'])) {
            return $this->data['response']['id'];
        }
    }

    public function getMessage()
    {
        if (isset($this->data['errors'])) {
            return implode(', ', $this->data['errors']);
        }

        if (isset($this->data['response']['message'])) {
            return $this->data['response']['message'];
        }
        
        return null;
    }

    public function getCode()
    {
        return $this->statusCode;
    }
}
