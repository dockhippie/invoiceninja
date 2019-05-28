<?php
namespace Omnipay\Neteller\Message;

use Omnipay\Tests\TestCase;

class InstantPayoutRequestTest extends TestCase
{
    /**
     * @var InstantPayoutRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new InstantPayoutRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testGetData()
    {
        $expectedData = array(
            'merchantId'       => 123,
            'merchantKey'      => 'phpunit-key',
            'merchantPassword' => 'password',
            'merchantAccount'  => 'phpunit-account',
            'transactionId'    => 't1',
            'account'          => 'account',
            'amount'           => '12.34',
            'currency'         => 'EUR',
            'customValues'     => array('one', 'two', 'three'),
        );
        $this->request->initialize($expectedData);

        $data = $this->request->getData();

        $this->assertSame($expectedData['merchantId'], $data['merchant_id']);
        $this->assertSame($expectedData['merchantKey'], $data['merch_key']);
        $this->assertSame($expectedData['merchantPassword'], $data['merch_pass']);
        $this->assertSame($expectedData['merchantAccount'], $data['merch_account']);
        $this->assertSame($expectedData['transactionId'], $data['merch_transid']);
        $this->assertSame($expectedData['account'], $data['net_account']);
        $this->assertSame($expectedData['amount'], $data['amount']);
        $this->assertSame($expectedData['currency'], $data['currency']);
        $this->assertSame($expectedData['customValues'][0], $data['custom_1']);
        $this->assertSame($expectedData['customValues'][1], $data['custom_2']);
        $this->assertSame($expectedData['customValues'][2], $data['custom_3']);
    }
}
