<?php

namespace Omnipay\Multicards\Message;

use Omnipay\Tests\TestCase;

class VoidRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new VoidRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(
            array(
                'merId' => 999999,
                'password' => 'veryverysecret',
                'merUrlIdx' => 1,
                'transactionReference' => '987654',
                'description' => 'Full Refund',
            )
        );
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('VoidSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('000', $response->getCode());
        $this->assertSame('Success', $response->getMessage());
        $this->assertEmpty($response->getTransactionReference());
    }

    public function testSendError()
    {
        $this->setMockHttpResponse('VoidFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getCardReference());
        $this->assertSame('600', $response->getCode());
        $this->assertSame('ErrorMessageGoesHere', $response->getMessage());
    }
}
