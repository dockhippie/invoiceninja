<?php

namespace Omnipay\Multicards\Message;

use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(
            array(
                'merId' => 999999,
                'password' => 'veryverysecret',
                'merUrlIdx' => 1,
                'amount' => '10.00',
                'currency' => 'USD',
                'description' => 'Super Deluxe Excellent Discount Package',
                'clientIp' => '127.0.0.1',
                'card' => $this->getValidCard(),
            )
        );
    }

    public function testCaptureIsTrue()
    {
        $data = $this->request->getData();
        $this->assertEquals('1', $data['req_trans_token']);
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('12345678', $response->getTransactionReference());
        $this->assertSame('tokenTOKENtokenTOKEN', $response->getCardReference());
        $this->assertSame('Accepted', $response->getMessage());
    }

    public function testSendError()
    {
        $this->setMockHttpResponse('PurchaseFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getCardReference());
        $this->assertSame('600', $response->getCode());
        $this->assertSame('ErrorMessageGoesHere', $response->getMessage());
    }
}
