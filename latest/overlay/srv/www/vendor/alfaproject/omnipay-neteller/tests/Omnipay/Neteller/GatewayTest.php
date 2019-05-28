<?php
namespace Omnipay\Neteller;

use DateTime;
use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setMerchantId(123);
        $this->gateway->setMerchantKey('phpunit-key');
        $this->gateway->setMerchantPassword('phpunit-pass');

        $this->purchaseOptions = array(
            'merchantAccount' => 'phpunit-account',
            'transactionId'   => 't1',
            'account'         => 'netellertest_EUR@neteller.com',
            'secureId'        => 908379,
            'amount'          => '20.12',
            'currency'        => 'EUR',
        );

        $this->payoutOptions = array(
            'merchantAccount' => 'phpunit-account',
            'transactionId'   => 't1',
            'account'         => 'netellertest_EUR@neteller.com',
            'secureId'        => 908379,
            'amount'          => '20.12',
            'currency'        => 'EUR',
        );
    }

    public function testOptionalParametersHaveMatchingMethods()
    {
        $parameters = array(
            'merchantPassword',
        );
        foreach ($parameters as $parameter) {
            $getter = 'get' . ucfirst($parameter);
            $setter = 'set' . ucfirst($parameter);
            $value = uniqid();

            $this->assertTrue(method_exists($this->gateway, $getter), "Gateway must implement $getter()");
            $this->assertTrue(method_exists($this->gateway, $setter), "Gateway must implement $setter()");

            // setter must return instance
            $this->assertSame($this->gateway, $this->gateway->$setter($value));
            $this->assertSame($value, $this->gateway->$getter());
        }
    }

    public function testPurchaseSuccess()
    {
        $this->setMockHttpResponse('NetDirectApproved.txt');

        $request = $this->gateway->purchase($this->purchaseOptions);
        $response = $request->send();

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

    public function testPayoutSuccess()
    {
        $this->setMockHttpResponse('InstantPayoutApproved.txt');

        $request = $this->gateway->payout($this->payoutOptions);
        $response = $request->send();

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
