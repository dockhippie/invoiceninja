<?php

namespace Omnipay\Dwolla;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testPurchase()
    {
        $request = $this->gateway->purchase(array(
            'amount' => '5.00',
            'destinationId' => '812-124-7074'));

        $this->assertInstanceOf('Omnipay\Dwolla\Message\PurchaseRequest', $request);
        $this->assertSame('5.00', $request->getAmount());
    }
}