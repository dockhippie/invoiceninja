<?php

namespace Omnipay\Dwolla\Message;

use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());

        $this->request->initialize(array(
            'key' => 'open',
            'secret' => 'sesame',
            'amount' => '5.00',
            'sandbox' => 1,
            'destinationId' => '812-124-7074',
            'returnUrl' => 'http://my_site.net/handle_callback'));
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame('open', $data['client_id']);
        $this->assertSame('sesame', $data['client_secret']);
        $this->assertSame('5.00', $data['purchaseOrder']['total']);
        $this->assertSame('812-124-7074', $data['purchaseOrder']['destinationId']);
        $this->assertSame('http://my_site.net/handle_callback', $data['redirect']);
    }

    public function testSendSuccess() 
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');

        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertSame('Success', $response->getMessage());
        $this->assertSame('GET', $response->getRedirectMethod());
        $this->assertSame('https://uat.dwolla.com/payment/checkout/c271d65c-7b71-421f-a80f-8682bb2ce2c4', $response->getRedirectUrl());
        $this->assertNull($response->getRedirectData());
        $this->assertSame('c271d65c-7b71-421f-a80f-8682bb2ce2c4', $response->getTransactionReference());
    }

    public function testSendFailure() 
    {
        $this->setMockHttpResponse('PurchaseFailure.txt');

        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Invalid destination user.', $response->getMessage());
        $this->assertSame('GET', $response->getRedirectMethod());
        $this->assertNull($response->getRedirectUrl());
        $this->assertNull($response->getRedirectData());
        $this->assertFalse($response->getTransactionReference());   
    }
}
