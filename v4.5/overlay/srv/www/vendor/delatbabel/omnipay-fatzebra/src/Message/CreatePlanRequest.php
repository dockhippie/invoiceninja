<?php
/**
 * Fat Zebra REST Create Plan Request
 */

namespace Omnipay\Fatzebra\Message;

/**
 * Fat Zebra REST Create Plan Request
 *
 * In order to create a new recurring purchase plan you must submit the
 * following details:
 *
 * * Name (string)
 * * Reference (your internal reference -- this will be used to look up the plan).  This
 *   must be unique -- plans with duplicate references will cause an error.
 * * Description
 * * Amount (numerical)
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
 *   // Do a create plan transaction on the gateway
 *   $transaction = $gateway->CreatePlan(array(
 *       'name'                     => 'Test Plan',
 *       'transactionReference'     => 'TestPlan',
 *       'description'              => 'A plan created for testing',
 *       'amount'                   => '10.00',
 *   ));
 *   $response = $transaction->send();
 *   if ($response->isSuccessful()) {
 *       echo "Create Plan transaction was successful!\n";
 *       $plan_id = $response->getTransactionReference();
 *       echo "Plan reference = " . $plan_id . "\n";
 *   }
 * </code>
 *
 * @link http://www.paystream.com.au/developer-guides/
 * @see Omnipay\Fatzebra\FatzebraGateway
 */
class CreatePlanRequest extends AbstractRestRequest
{
    /**
     * Get the plan name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getParameter('name');
    }

    /**
     * Set the plan name
     *
     * @return CreatePlanRequest provides a fluent interface.
     */
    public function setName($value)
    {
        return $this->setParameter('name', $value);
    }

    public function getData()
    {
        // An amount parameter is required.  All amounts are in
        // Australian dollars.
        $this->validate('name', 'description', 'amount', 'transactionReference');
        $data = array(
            'name'          => $this->getName(),
            'amount'        => $this->getAmount(),
            'reference'     => $this->getTransactionReference(),
            'description'   => $this->getDescription(),
        );

        return $data;
    }

    /**
     * Get transaction endpoint.
     *
     * Create Plans are created using the /purchases resource.
     *
     * @return string
     */
    protected function getEndpoint()
    {
        return parent::getEndpoint() . '/plans';
    }
}
