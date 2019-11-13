<?php

namespace Omnipay\Dwolla\Message;

/**
 * Dwolla Abstract Request
 *
 * @method \Omnipay\Dwolla\Message\Response send()
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    public $host = 'https://www.dwolla.com';
    public $sandbox_host = 'https://uat.dwolla.com';

    public function getHost()
    {
        return $this->getSandbox() ? $this->sandbox_host : $this->host;
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

    public function sendRequest($method, $endpoint, $data)
    {
        // Don't throw exceptions for 4xx errors
        // (everybody copied this from the stripe library)
        $this->httpClient->getEventDispatcher()->addListener(
            'request.error',
            function ($event) {
                if ($event['response']->isClientError()) {
                    $event->stopPropagation();
                }
            }
        );

        // Leverage Guzzle for the request
        $httpRequest = $this->httpClient->createRequest(
            $method,
            $this->getHost() . $endpoint,
            array(
                'Content-Type' => 'application/json',
                'User-Agent' => 'omnipay-dwolla/1.x'
            ),
            $data
        );

        return $httpRequest->send();
    }
}
