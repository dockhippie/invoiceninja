<?php

namespace Omnipay\Dwolla\Message;

/**
 * Class FetchPurchaseRequest
 *
 * Retrieves Dwolla off-site gateway checkouts,
 * OmniPay interface, implements capture().
 *
 * @package Omnipay\Dwolla\Message
 */
class FetchPurchaseRequest extends AbstractRequest
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
        $this->validate('transactionReference');

        return array(
            'client_id' => $this->getKey(),
            'client_secret' => $this->getSecret(),
            'CheckoutId' => $this->getTransactionReference()
        );
    }

    /**
     * Sends the checkout retrieval request to the Dwolla API.
     * Merges in the API hostname into the reply for "fake" HAL
     * compliance.
     *
     * @param mixed $data
     * @return Response
     */
    public function sendData($data)
    {
        $httpResponse = $this->sendRequest(
            'GET',
            '/oauth/rest/offsitegateway/checkouts/'
            . $data['CheckoutId']
            . '?client_id='
            . urlencode($data['client_id'])
            . '&client_secret='
            . urlencode($data['client_secret']),
            null
        );

        return $this->response = new Response($this, $httpResponse->json());
    }
}
