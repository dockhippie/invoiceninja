<?php

namespace Omnipay\Fatzebra;

use Omnipay\Tests\GatewayTestCase;
use Omnipay\Common\CreditCard;

class GatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gateway = new FatzebraGateway($this->getHttpClient(), $this->getHttpRequest());

        $this->card = new CreditCard(array(
            'firstName' => 'Example',
            'lastName' => 'User',
            'number' => '4111111111111111',
            'expiryMonth' => '12',
            'expiryYear' => '2020',
            'cvv' => '123',
        ));
        $this->options = array(
            'amount' => '10.00',
            'transactionId' => '123412341234',
            'card' => $this->card,
        );
    }

    public function testPurchase()
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');

        $response = $this->gateway->purchase($this->options)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('525-P-S2Y05UQ9', $response->getTransactionReference());
        $this->assertEquals('Approved', $response->getMessage());
    }

    public function testFetchTransaction()
    {
        $request = $this->gateway->fetchTransaction(array('transactionReference' => '525-P-S2Y05UQ9'));

        $this->assertInstanceOf('\Omnipay\Fatzebra\Message\FetchTransactionRequest', $request);
        $this->assertSame('525-P-S2Y05UQ9', $request->getTransactionReference());
    }

    public function testRefund()
    {
        $this->setMockHttpResponse('RefundSuccess.txt');

        $response = $this->gateway->refund(array(
            'transactionReference'  => "525-P-S2Y05UQ9",
            'amount'                => 10.00,
        ))->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('525-R-XIVU3L9U', $response->getTransactionReference());
        $this->assertEquals('Approved', $response->getMessage());
    }

    public function testCreateCard()
    {
        $this->setMockHttpResponse('CreateCardSuccess.txt');

        $response = $this->gateway->createCard(array(
            'card'      => $this->card,
        ))->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('hmx8o839', $response->getTransactionReference());
        $this->assertEmpty($response->getMessage());
    }

    public function testCreatePlan()
    {
        $this->setMockHttpResponse('CreatePlanSuccess.txt');

        $response = $this->gateway->createPlan(array(
            "name"                  => "Gold Membership",
            "amount"                => 100.00,
            "transactionReference"  => "Gold-1",
            "description"           => "Gold level membership",
        ))->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('525-PL-IN37ICBK', $response->getTransactionReference());
        $this->assertEmpty($response->getMessage());
    }

    public function testFetchAllPlans()
    {
        $this->setMockHttpResponse('FetchAllPlansSuccess.txt');

        $response = $this->gateway->fetchAllPlans()->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEmpty($response->getMessage());
    }

    public function testFetchPlan()
    {
        $this->setMockHttpResponse('FetchPlanSuccess.txt');

        $response = $this->gateway->fetchPlan(array(
           'transactionReference'  => '525-PL-IN37ICBK',
        ))->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('525-PL-IN37ICBK', $response->getTransactionReference());
        $this->assertEmpty($response->getMessage());
    }

    public function testCreateCustomer()
    {
        $this->setMockHttpResponse('CreateCustomerSuccess.txt');

        // Create a credit card object
        // This card can be used for testing.
        $card = new CreditCard(array(
                    'firstName'             => 'Example',
                    'lastName'              => 'Customer',
                    'number'                => '4005550000000001',
                    'expiryMonth'           => '05',
                    'expiryYear'            => '2020',
                    'cvv'                   => '987',
                    'billingAddress1'       => '1 Lower Creek Road',
                    'billingCountry'        => 'AU',
                    'billingCity'           => 'Scrubby Creek',
                    'billingPostcode'       => '4999',
                    'billingState'          => 'QLD',
                    'email'                 => 'testcust@example.com',
        ));

        // Do a create customer transaction on the gateway
        $response = $this->gateway->createCustomer(array(
            'transactionReference'     => 'TestCust1234',
            'clientIp'                 => '127.0.0.1',
            'card'                     => $card,
        ))->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('525-C-G1ZKF1Y3', $response->getCustomerReference());
        $this->assertEquals('daers4x6', $response->getCardReference());
        $this->assertEmpty($response->getMessage());
    }

    public function testFetchCustomer()
    {
        $this->setMockHttpResponse('FetchCustomerSuccess.txt');

        $response = $this->gateway->fetchCustomer(array(
           'transactionReference'  => '525-C-G1ZKF1Y3',
        ))->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('525-C-G1ZKF1Y3', $response->getTransactionReference());
        $this->assertEmpty($response->getMessage());
    }

    public function testCreateSubscription()
    {
        $this->setMockHttpResponse('CreateSubscriptionSuccess.txt');

        $gateway = $this->gateway;

        $response = $this->gateway->createSubscription(array(
            'customerReference'            => '525-C-G1ZKF1Y3',
            'planReference'                => '525-PL-IN37ICBK',
            'frequency'                => $gateway::FREQUENCY_WEEKLY,
            'startDate'                => new \DateTime('tomorrow'),
            'transactionReference'     => 'TestSubscription123456',
        ))->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('525-PL-HT6AMO6J', $response->getPlanReference());
        $this->assertEquals('525-S-DYVABJ3L', $response->getSubscriptionReference());
        $this->assertEmpty($response->getMessage());
    }

    public function testDeleteCustomer()
    {
        $this->setMockHttpResponse('DeleteCustomerSuccess.txt');

        $response = $this->gateway->deleteCustomer(array(
           'transactionReference'  => '525-C-G1ZKF1Y3',
        ))->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('525-C-G1ZKF1Y3', $response->getTransactionReference());
        $this->assertEmpty($response->getMessage());
    }

    public function testFetchSubscription()
    {
        $this->setMockHttpResponse('FetchSubscriptionSuccess.txt');

        $response = $this->gateway->fetchSubscription(array(
           'transactionReference'  => '525-S-UQZHEXAT',
        ))->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('525-S-UQZHEXAT', $response->getSubscriptionReference());
        $this->assertEquals('525-PL-HT6AMO6J', $response->getPlanReference());
        $this->assertEquals('525-C-6CSDKGME', $response->getCustomerReference());
        $this->assertEmpty($response->getMessage());
    }
}
