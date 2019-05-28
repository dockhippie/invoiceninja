<?php
namespace Omnipay\Neteller\Message;

use Omnipay\Tests\TestCase;

class NetDirectRequestTest extends TestCase
{
    /**
     * @var NetDirectRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $this->request = new NetDirectRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testGetData()
    {
        $expectedData = array(
            'merchantId'      => 123,
            'merchantKey'     => 'phpunit-key',
            'merchantName'    => 'phpunit',
            'merchantAccount' => 'phpunit-account',
            'transactionId'   => 't1',
            'account'         => 'account',
            'secureId'        => 12345,
            'languageCode'    => 'EN',
            'amount'          => '12.34',
            'currency'        => 'EUR',
            'customValues'    => array('one', 'two', 'three'),
        );
        $this->request->initialize($expectedData);

        $data = $this->request->getData();

        $this->assertSame($expectedData['merchantId'], $data['merchant_id']);
        $this->assertSame($expectedData['merchantKey'], $data['merch_key']);
        $this->assertSame($expectedData['merchantName'], $data['merch_name']);
        $this->assertSame($expectedData['merchantAccount'], $data['merch_account']);
        $this->assertSame($expectedData['transactionId'], $data['merch_transid']);
        $this->assertSame($expectedData['account'], $data['net_account']);
        $this->assertSame($expectedData['secureId'], $data['secure_id']);
        $this->assertSame($expectedData['languageCode'], $data['language_code']);
        $this->assertSame($expectedData['amount'], $data['amount']);
        $this->assertSame($expectedData['currency'], $data['currency']);
        $this->assertSame($expectedData['customValues'][0], $data['custom_1']);
        $this->assertSame($expectedData['customValues'][1], $data['custom_2']);
        $this->assertSame($expectedData['customValues'][2], $data['custom_3']);
    }
}
