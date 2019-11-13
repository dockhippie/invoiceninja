<?php

namespace Omnipay\Fatzebra\Message;

use Omnipay\Fatzebra\Message\FetchTransactionRequest;
use Omnipay\Tests\TestCase;

class FetchTransactionRequestTest extends TestCase
{
    /**
     * @var \Omnipay\Fatzebra\Message\FetchTransactionRequest
     */
    private $request;

    public function setUp()
    {
        $client = $this->getHttpClient();

        $request = $this->getHttpRequest();

        $this->request = new FetchTransactionRequest($client, $request);
    }

    public function testGetData()
    {
        $this->request->setTransactionReference('ABC-123');
        $this->request->setUsername('testuser');
        $this->request->setToken('testpass');

        // FetchTransactionRequest always has no data.
        $expected = array();

        $this->assertEquals($expected, $this->request->getData());
        // protected $this->assertEquals('GET', $this->request->getHttpMethod());
        $this->assertEquals('https://gateway.fatzebra.com.au/v1.0/purchases/' . $this->request->getTransactionReference(), $this->request->getEndpoint());
    }
}
