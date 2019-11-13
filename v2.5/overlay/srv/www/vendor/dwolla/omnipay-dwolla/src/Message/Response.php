<?php

namespace Omnipay\Dwolla\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Class Response
 *
 * Dwolla response interface for OmniPay.
 *
 * @package Omnipay\Dwolla\Message
 */
class Response extends AbstractResponse implements RedirectResponseInterface
{
    // This should be "false" for off-site gateway payments,
    // because the payment is not "complete" after the call
    // is finished. It is complete after the user finishes payment
    // off-site.
    public function isSuccessful()
    {
        return false;
    }

    // Only redirect if the API returns valid data.
    public function isRedirect()
    {
        return isset($this->data['host']) && $this->data['Success'] == 'true';
    }

    // The OmniPay reference is the Dwolla CheckoutId
    public function getTransactionReference()
    {
        return isset($this->data['Response']['CheckoutId']) ? $this->data['Response']['CheckoutId'] : false;
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectData()
    {
        return null;
    }

    public function getRedirectUrl()
    {
        return $this->getTransactionReference() && isset($this->data['host'])
        ? $this->data['host'] . "/payment/checkout/" . $this->getTransactionReference()
        : null;
    }

    public function getMessage()
    {
        return $this->data['Message'];
    }
}
