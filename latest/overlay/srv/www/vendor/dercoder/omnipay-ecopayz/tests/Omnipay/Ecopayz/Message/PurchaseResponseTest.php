<?php
namespace Omnipay\Ecopayz\Message;
use Mockery as m;
use Omnipay\Tests\TestCase;

class PurchaseResponseTest extends TestCase
{
    public function testResult()
    {
        $request = $this->getMockRequest();
        $request->shouldReceive('getTestMode');
        
        $response = new PurchaseResponse($request, array(
            'PaymentPageID' => '100',
            'MerchantAccountNumber' => '100001',
            'CustomerIdAtMerchant' => '1123456789',
            'TxID' => 'TX4567890',
            'Amount' => '12.34',
            'Currency' => 'EUR',
            'MerchantFreeText' => 'Free Text Description',
            'Checksum' => '84bbad2a636aa9226c03f17ff813a181'
        ));

        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertNull($response->getCode());
        $this->assertNull($response->getMessage());
        $this->assertSame('https://secure.ecopayz.com/PrivateArea/WithdrawOnlineTransfer.aspx?PaymentPageID=100&MerchantAccountNumber=100001&CustomerIdAtMerchant=1123456789&TxID=TX4567890&Amount=12.34&Currency=EUR&MerchantFreeText=Free+Text+Description&Checksum=84bbad2a636aa9226c03f17ff813a181', $response->getRedirectUrl());
        $this->assertSame('GET', $response->getRedirectMethod());
        $this->assertNull($response->getRedirectData());
    }

}
