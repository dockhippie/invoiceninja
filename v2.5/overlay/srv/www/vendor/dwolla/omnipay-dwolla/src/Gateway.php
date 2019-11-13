<?php

namespace Omnipay\Dwolla;

use Omnipay\Common\AbstractGateway;

/**
 * Dwolla Gateway
 *
 * @link https://developers.dwolla.com/dev/docs
 */

class Gateway extends AbstractGateway
{

    public function getName()
    {
        return 'Dwolla';
    }

    /**
     * Retrieves default parameters for the OmniPay
     * standardized field names
     *
     * @return array
     */
    public function getDefaultParameters()
    {
        return array(
            // Required
            'key' => '',
            'secret' => '',
            'sandbox' => false,
            'destinationId' => '',
            'returnUrl' => ''
        );
    }

    public function getKey()
    {
        return $this->getParameter('key');
    }

    public function setKey($value)
    {
        return $this->setParameter('key', $value);
    }

    public function getSecret()
    {
        return $this->getParameter('secret');
    }

    public function setSecret($value)
    {
        return $this->setParameter('secret', $value);
    }

    public function getDestinationId()
    {
        return $this->getParameter('destinationId');
    }

    public function setDestinationId($value)
    {
        return $this->setParameter('destinationId', $value);
    }

    public function getReturnUrl()
    {
        return $this->getParameter('returnUrl');
    }

    public function setReturnUrl($value)
    {
        return $this->setParameter('returnUrl', $value);
    }

    public function getSandbox()
    {
        return $this->getParameter('sandbox');
    }

    public function setSandbox($value)
    {
        return $this->setParameter('sandbox', $value);
    }

    /**
     * Create a purchase using Dwolla's off-site gateway.
     *
     * @param array $parameters
     * @return \Omnipay\Dwolla\Message\PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Dwolla\Message\PurchaseRequest', $parameters);
    }

    /**
     * Retrieve details about a created checkout.
     *
     * @param array $parameters
     * @return \Omnipay\Dwolla\Message\PurchaseRequest
     */
    public function capture(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Dwolla\Message\FetchPurchaseRequest', $parameters);
    }
}
