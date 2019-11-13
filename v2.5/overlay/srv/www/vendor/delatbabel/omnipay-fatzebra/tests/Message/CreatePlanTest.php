<?php

namespace Omnipay\Fatzebra\Message;

use Omnipay\Common\CreditCard;
use Omnipay\Tests\TestCase;

class CreatePlanTest extends TestCase
{
    /** @var PurchaseRequest */
    private $request;

    public function testGetData()
    {
        $this->plandata = array(
           'name'                     => 'Test Plan',
           'transactionReference'     => 'TestPlan',
           'description'              => 'A plan created for testing',
           'amount'                   => '10.00',
        );
        $this->request = new CreatePlanRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize($this->plandata);

        $data = $this->request->getData();

        $this->assertSame($this->plandata['name'], $data['name']);
        $this->assertSame($this->plandata['amount'], $data['amount']);
        $this->assertSame($this->plandata['transactionReference'], $data['reference']);
        $this->assertSame($this->plandata['description'], $data['description']);
    }


}
