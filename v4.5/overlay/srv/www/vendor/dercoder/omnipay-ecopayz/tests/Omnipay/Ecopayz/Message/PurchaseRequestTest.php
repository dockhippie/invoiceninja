<?php
namespace Omnipay\Ecopayz\Message;

use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    private $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(array(
            'merchantId'                => '100',
            'merchantAccountNumber'     => '100001',
            'customerIdAtMerchant'      => '1123456789',
            'transactionId'             => 'TX4567890',
            'description'               => 'Free Text Description',
            'amount'                    => '12.34',
            'currency'                  => 'EUR',
            'returnUrl'                 => 'http://example.com/return',
            'cancelUrl'                 => 'http://example.com/cancel',
            'notifyUrl'                 => 'http://example.com/notify',
        ));
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame('100', $data['PaymentPageID']);
        $this->assertSame('100001', $data['MerchantAccountNumber']);
        $this->assertSame('1123456789', $data['CustomerIdAtMerchant']);
        $this->assertSame('TX4567890', $data['TxID']);
        $this->assertSame('12.34', $data['Amount']);
        $this->assertSame('EUR', $data['Currency']);
        $this->assertSame('Free Text Description', $data['MerchantFreeText']);
        $this->assertSame('7320d93a3daa1e296f56fa7f40d6fb8b', $data['Checksum']);
        $this->assertSame('http://example.com/return', $data['OnSuccessUrl']);
        $this->assertSame('http://example.com/cancel', $data['OnFailureUrl']);
        $this->assertSame('http://example.com/notify', $data['TransferUrl']);
    }

    public function testSendData()
    {
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertSame('Omnipay\Ecopayz\Message\PurchaseResponse', get_class($response));
    }
}
