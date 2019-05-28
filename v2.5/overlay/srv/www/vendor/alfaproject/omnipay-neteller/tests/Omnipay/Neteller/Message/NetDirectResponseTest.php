<?php
namespace Omnipay\Neteller\Message;

use DateTime;
use Omnipay\Tests\TestCase;

class NetDirectResponseTest extends TestCase
{
    public function testMemberSuspendedError()
    {
        $httpResponse = $this->getMockHttpResponse('MemberSuspendedError.txt');
        $response = new NetDirectResponse($this->getMockRequest(), $httpResponse->xml());

        $this->assertFalse($response->isSuccessful());
        $this->assertSame(1004, $response->getCode());
        $this->assertNotNull($response->getMessage());
        $this->assertSame(array('', '', ''), $response->getCustomValues());
    }

    public function testApproved()
    {
        $httpResponse = $this->getMockHttpResponse('NetDirectApproved.txt');
        $response = new NetDirectResponse($this->getMockRequest(), $httpResponse->xml());

        $this->assertTrue($response->isSuccessful());
        $this->assertSame(0, $response->getCode());
        $this->assertNotNull($response->getMessage());
        $this->assertSame(array('', '', ''), $response->getCustomValues());

        $this->assertSame('20.12', $response->getAmount());
        $this->assertSame('469391781523238', $response->getTransactionReference());
        $this->assertSame('0.78', $response->getFee());
        $this->assertEquals(new DateTime('2014-02-07 13:58:41'), $response->getTransactionTime());
        $this->assertSame('EURFirstname', $response->getCustomerFirstName());
        $this->assertSame('EURLastname', $response->getCustomerLastName());
        $this->assertSame('netellertest_eur@neteller.com', $response->getCustomerEmail());
        $this->assertSame('0.78', $response->getTotalFee());
        $this->assertSame('EUR', $response->getCustomerCurrency());
        $this->assertSame('20.12', $response->getCustomerAmount());
        $this->assertSame('EUR', $response->getMerchantCurrency());
        $this->assertSame('20.12', $response->getMerchantAmount());
        $this->assertSame('1.00000000', $response->getForeignExchangeRate());
    }
}
