<?php

namespace Omnipay\Dwolla\Message;

use Omnipay\Tests\TestCase;

class FetchPurchaseRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new FetchPurchaseRequest($this->getHttpClient(), $this->getHttpRequest());

        $this->request->initialize(array(
            'key' => 'open',
            'secret' => 'sesame',
            'sandbox' => 1,
            'transactionReference' => 'c271d65c-7b71-421f-a80f-8682bb2ce2c4'));
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame('open', $data['client_id']);
        $this->assertSame('sesame', $data['client_secret']);
        $this->assertSame('c271d65c-7b71-421f-a80f-8682bb2ce2c4', $data['CheckoutId']);
    }

    public function testSendSuccess() 
    {
        $this->setMockHttpResponse('FetchPurchaseSuccess.txt');

        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Success', $response->getMessage());
        $this->assertSame('GET', $response->getRedirectMethod());
        $this->assertNull($response->getRedirectUrl());
        $this->assertNull($response->getRedirectData());
        $this->assertSame('c271d65c-7b71-421f-a80f-8682bb2ce2c4', $response->getTransactionReference());
    }

    public function testSendFailure() 
    {
        $this->setMockHttpResponse('FetchPurchaseFailure.txt');

        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Invalid checkout key.', $response->getMessage());
        $this->assertSame('GET', $response->getRedirectMethod());
        $this->assertNull($response->getRedirectUrl());
        $this->assertNull($response->getRedirectData());
        $this->assertFalse($response->getTransactionReference());   
    }
}