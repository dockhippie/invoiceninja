<?php
/**
 * Fat Zebra REST Create Subscription Request
 */

namespace Omnipay\Fatzebra\Message;

/**
 * Fat Zebra REST Create Subscription Request
 *
 * To create a new subscription the following details are required:
 *
 * * customer ID (getCustomerReference from a CreateCustomerRequest response)
 * * plan ID (getTransactionReference from a CreatePlanRequest response)
 * * frequency
 * * start_date
 * * reference
 *
 * Example:
 *
 * <code>
 *   // Create a gateway for the Fat Zebra REST Gateway
 *   // (routes to GatewayFactory::create)
 *   $gateway = Omnipay::create('FatzebraGateway');
 *
 *   // Initialise the gateway
 *   $gateway->initialize(array(
 *       'username' => 'TEST',
 *       'token'    => 'TEST',
 *       'testMode' => true, // Or false when you are ready for live transactions
 *   ));
 *
 *   // Create a credit card object
 *   // This card can be used for testing.
 *   $card = new CreditCard(array(
 *               'firstName'    => 'Example',
 *               'lastName'     => 'Customer',
 *               'number'       => '4005550000000001',
 *               'expiryMonth'  => '01',
 *               'expiryYear'   => '2020',
 *               'cvv'          => '123',
 *               'billingAddress1'       => '1 Scrubby Creek Road',
 *               'billingCountry'        => 'AU',
 *               'billingCity'           => 'Scrubby Creek',
 *               'billingPostcode'       => '4999',
 *               'billingState'          => 'QLD',
 *               'email'                 => 'email@example.com',
 *   ));
 *
 *   // Do a create customer transaction on the gateway
 *   $transaction = $gateway->createCustomer(array(
 *       'transactionReference'     => 'TestCustomer',
 *       'clientIp'                 => $_SERVER['REMOTE_ADDR'],
 *       'card'                     => $card,
 *   ));
 *   $response = $transaction->send();
 *   $customer_id = $response->getCustomerReference();
 *
 *   // Do a create plan transaction on the gateway
 *   $transaction = $gateway->CreatePlan(array(
 *       'name'                     => 'Test Plan',
 *       'transactionReference'     => 'TestPlan',
 *       'description'              => 'A plan created for testing',
 *       'amount'                   => '10.00',
 *   ));
 *   $response = $transaction->send();
 *   $plan_id = $response->getTransactionReference();
 *
 *   // Do a create subscription transaction on the gateway
 *   $transaction = $gateway->createSubscription(array(
 *       'customerReference'            => $customer_id,
 *       'planReference'                => $plan_id,
 *       'frequency'                => $gateway::FREQUENCY_WEEKLY,
 *       'startDate'                => new \DateTime('tomorrow'),
 *       'transactionReference'     => 'TestSubscription',
 *   ));
 *   $response = $transaction->send();
 *   if ($response->isSuccessful()) {
 *       echo "createSubscription transaction was successful!\n";
 *       $subscription_id = $response->getSubscriptionReference();
 *       echo "Subscription Reference = " . $subscription_id . "\n";
 *   }
 * </code>
 *
 * @link http://www.paystream.com.au/developer-guides/
 * @see Omnipay\Fatzebra\FatzebraGateway
 */
class CreateSubscriptionRequest extends AbstractRestRequest
{
    public function getData()
    {
        $this->validate('customerReference', 'planReference', 'frequency', 'startDate', 'transactionReference');
        $data = array(
            'customer'      => $this->getCustomerReference(),
            'plan'          => $this->getPlanReference(),
            'frequency'     => $this->getFrequency(),
            'start_date'    => $this->getStartDate()->format('Y-m-d'),
            'reference'     => $this->getTransactionReference(),
            'is_active'     => 'true',
        );
        return $data;
    }

    /**
     * Get transaction endpoint.
     *
     * Referenceizes are created using the /purchases resource.
     *
     * @return string
     */
    protected function getEndpoint()
    {
        return parent::getEndpoint() . '/subscriptions';
    }

    /**
     * Get the customer token
     *
     * @return string
     */
    public function getCustomerReference()
    {
        return $this->getParameter('customerReference');
    }

    /**
     * Set the customer token
     *
     * @return CreateSubscriptionRequest provides a fluent interface.
     */
    public function setCustomerReference($value)
    {
        return $this->setParameter('customerReference', $value);
    }

    /**
     * Get the plan token
     *
     * @return string
     */
    public function getPlanReference()
    {
        return $this->getParameter('planReference');
    }

    /**
     * Set the plan token
     *
     * @return CreateSubscriptionRequest provides a fluent interface.
     */
    public function setPlanReference($value)
    {
        return $this->setParameter('planReference', $value);
    }

    /**
     * Get the frequency
     *
     * @return string
     */
    public function getFrequency()
    {
        return $this->getParameter('frequency');
    }

    /**
     * Set the frequency
     *
     * @return CreateSubscriptionRequest provides a fluent interface.
     */
    public function setFrequency($value)
    {
        return $this->setParameter('frequency', $value);
    }

    /**
     * Get the start date
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->getParameter('startDate');
    }

    /**
     * Set the start date
     *
     * @return CreateSubscriptionRequest provides a fluent interface.
     */
    public function setStartDate($value)
    {
        return $this->setParameter('startDate', $value);
    }
}
