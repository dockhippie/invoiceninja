<?php

namespace Omnipay\Dwolla\Message;

/**
 * Class PurchaseRequest
 *
 * Off-site gateway interface for OmniPay's
 * AbstractRequest, implements purchase().
 *
 * @package Omnipay\Dwolla\Message
 */
class PurchaseRequest extends AbstractRequest
{
    /**
     * Initializes data parameters from OmniPay fields
     * to fields recognizable by the Dwolla API.
     *
     * For more details on what values are accepted
     * by Dwolla, visit: https://docs.dwolla.com/#checkouts
     *
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('amount');

        $data = array(
            'client_id' => $this->getKey(),
            'client_secret' => $this->getSecret(),
            'purchaseOrder' => array(
                'total' => $this->getAmount(),
                'destinationId' => $this->getDestinationId()),
            'redirect' => $this->getReturnUrl()
        );

        return $data;
    }

    /**
     * Sends the checkout request to the Dwolla API. Merges
     * in the API hostname into the reply for "fake" HAL
     * compliance.
     *
     * @param mixed $data
     * @return Response
     */
    public function sendData($data)
    {
        $httpResponse = $this->sendRequest('POST', '/oauth/rest/offsitegateway/checkouts', json_encode($data));

        return $this->response = new Response($this, array_merge($httpResponse->json(), ['host' => $this->getHost()]));
    }
}
