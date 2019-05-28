<?php
namespace Omnipay\Neteller\Message;

use DateTime;
use Omnipay\Tests\TestCase;

class InstantPayoutResponseTest extends TestCase
{
    public function testApproved()
    {
        $httpResponse = $this->getMockHttpResponse('InstantPayoutApproved.txt');
        $response = new InstantPayoutResponse($this->getMockRequest(), $httpResponse->xml());

        $this->assertTrue($response->isSuccessful());
        $this->assertSame(0, $response->getCode());
        $this->assertNotNull($response->getMessage());
        $this->assertSame(array('', '', ''), $response->getCustomValues());

        $this->assertSame('20.12', $response->getAmount());
        $this->assertSame('620392113464334', $response->getTransactionReference());
        $this->assertSame('0.71', $response->getFee());
        $this->assertEquals(new DateTime('2014-02-11 10:11:03'), $response->getTransactionTime());
        $this->assertSame('EURFirstname', $response->getCustomerFirstName());
        $this->assertSame('EURLastname', $response->getCustomerLastName());
        $this->assertSame('EUR', $response->getCustomerCurrency());
        $this->assertSame('20.12', $response->getCustomerAmount());
        $this->assertSame('EUR', $response->getMerchantCurrency());
        $this->assertSame('20.12', $response->getMerchantAmount());
        $this->assertSame('1.00000000', $response->getForeignExchangeRate());
    }
}
