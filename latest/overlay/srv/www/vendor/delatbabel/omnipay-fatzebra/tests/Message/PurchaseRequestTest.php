<?php

namespace Omnipay\Fatzebra\Message;

use Omnipay\Common\CreditCard;
use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    /** @var PurchaseRequest */
    private $request;

    public function testGetData()
    {
        $card = new CreditCard($this->getValidCard());
        $card->setStartMonth(1);
        $card->setStartYear(2000);

        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(array(
            'amount' => '10.00',
            'transactionReference' => 'TestReference999',
            'card' => $card
        ));

        $this->request->setTransactionId('525-P-S2Y05UQ9');
        $this->request->setClientIp('127.0.0.1');

        $data = $this->request->getData();

        $this->assertSame('10.00', $data['amount']);

        $this->assertSame($card->getNumber(), $data['card_number']);
        $this->assertSame($card->getExpiryDate('m/Y'), $data['card_expiry']);
        $this->assertSame($card->getCvv(), $data['cvv']);
    }

    public function testStoreCard()
    {
        $card = new CreditCard($this->getValidCard());
        $card->setStartMonth(1);
        $card->setStartYear(2000);

        $this->request = new CreateCardRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(array(
            'card' => $card
        ));

        $data = $this->request->getData();

        $this->assertSame($card->getNumber(), $data['card_number']);
        $this->assertSame($card->getExpiryDate('m/Y'), $data['card_expiry']);
        $this->assertSame($card->getCvv(), $data['cvv']);

        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(array(
            'amount' => '10.00',
            'transactionReference' => 'TestReference999',
            'cardReference' => 'abc1234',
        ));

        $this->request->setTransactionId('525-P-S2Y05UQ9');
        $this->request->setClientIp('127.0.0.1');

        $data = $this->request->getData();

        $this->assertSame('10.00', $data['amount']);

        $this->assertSame('abc1234', $data['card_token']);
    }

}
