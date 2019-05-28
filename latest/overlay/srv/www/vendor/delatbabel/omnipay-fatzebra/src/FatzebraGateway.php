<?php
/**
 * Fat Zebra / Paystream Gateway
 */

namespace Omnipay\Fatzebra;

use Omnipay\Common\AbstractGateway;

/**
 * Fat Zebra / Paystream Gateway
 *
 * ### Example
 *
 * <code>
 * // Create a gateway for the Fat Zebra REST Gateway
 * // (routes to GatewayFactory::create)
 * $gateway = Omnipay::create('Fatzebra_Fatzebra');
 *
 * // Initialise the gateway
 * $gateway->initialize(array(
 *     'username' => 'TEST',
 *     'token'    => 'TEST',
 *     'testMode' => true, // Or false when you are ready for live transactions
 * ));
 *
 * // Create a credit card object
 * // This card can be used for testing.
 * $card = new CreditCard(array(
 *             'firstName'    => 'Example',
 *             'lastName'     => 'Customer',
 *             'number'       => '4005550000000001',
 *             'expiryMonth'  => '01',
 *             'expiryYear'   => '2020',
 *             'cvv'          => '123',
 * ));
 *
 * // Do a purchase transaction on the gateway
 * $transaction = $gateway->purchase(array(
 *     'amount'                   => '10.00',
 *     'transactionId'            => 'TestPurchaseTransaction123456',
 *     'clientIp'                 => $_SERVER['REMOTE_ADDR'],
 *     'card'                     => $card,
 * ));
 * $response = $transaction->send();
 * if ($response->isSuccessful()) {
 *     echo "Purchase transaction was successful!\n";
 *     $sale_id = $response->getTransactionReference();
 *     echo "Transaction reference = " . $sale_id . "\n";
 * }
 * </code>
 *
 * ### Test modes
 *
 * There are two test modes in the Paystream system - one is a
 * sandbox environment and the other is a test mode flag.
 *
 * The Sandbox Environment is an identical copy of the live environment
 * which is 100% functional except for communicating with the banks.
 *
 * The Test Mode Flag is used to switch the live environment into
 * test mode. If test: true is sent with your request your transactions
 * will be executed in the live environment, but not communicate with
 * the bank backends. This mode is useful for testing changes to your
 * live website.
 *
 * Currently this class makes the assumption that if the testMode
 * flag is set then the Sandbox Environment is being used.
 *
 * ### Authentication
 *
 * Authentication is by means of a username / token pair.  For each
 * username / token there will also be a "shared secret" which is
 * not used by this gateway, but is instead used by the Direct Post
 * gateway (see https://docs.fatzebra.com.au/direct).
 *
 * Developers can get in touch with Fat Zebra (see the contact page
 * at https://www.fatzebra.com.au/contact) directly to get their own
 * test account details. There is however generic test account details
 * available within the API Documentation. Please see these details below.
 *
 * * username: TEST
 * * token: TEST
 * * Shared Secret: 033bd94b11
 *
 * ### Quirks
 *
 * * All payments are in Australian Dollars (AUD). No other currency
 *   is supported.
 * * A unique transactionId must be provided for each transaction.
 * * Voids are not supported, only refunds are supported.
 * * I do not know all of the error codes, except for 05 (declined)
 *   and 99 (bad/missing data).  They do not appear in the API documentation
 *   anywhere.
 *
 * ### TODO
 *
 * * Fatzebra_Paystream gateway can be implemented using the same code but
 *   a different set of endpoints.
 * * Support a Fatzebra_DirectPost gateway for redirect based payments.
 *
 * @see \Omnipay\Common\AbstractGateway
 * @see \Omnipay\Fatzebra\Message\AbstractRestRequest
 * @link http://www.paystream.com.au/developer-guides/
 * @link https://www.fatzebra.com.au/
 */
class FatzebraGateway extends AbstractGateway
{
    const FREQUENCY_WEEKLY  = 'Weekly';
    const FREQUENCY_MONTHLY = 'Monthly';

    /**
     * Get the gateway display name
     *
     * @return string
     */
    public function getName()
    {
        return 'Fat Zebra v1.0';
    }

    /**
     * Get the gateway default parameters
     *
     * @return array
     */
    public function getDefaultParameters()
    {
        return array(
            'username' => '',
            'token'    => '',
            'testMode' => false,
        );
    }

    /**
     * Get the gateway username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->getParameter('username');
    }

    /**
     * Set the gateway username
     *
     * Note that all test usernames begin with the word TEST in upper case.
     *
     * @param string $value
     * @return FatzebraGateway provides a fluent interface.
     */
    public function setUsername($value)
    {
        return $this->setParameter('username', $value);
    }

    /**
     * Get the gateway token -- used as the password in HTTP Basic Auth
     *
     * @return string
     */
    public function getToken()
    {
        return $this->getParameter('token');
    }

    /**
     * Set the gateway token -- used as the password in HTTP Basic Auth
     *
     * @param string $value
     * @return FatzebraGateway provides a fluent interface.
     */
    public function setToken($value)
    {
        return $this->setParameter('token', $value);
    }

    //
    // Direct API Purchase Calls -- purchase, refund
    //

    /**
     * Create a purchase request.
     *
     * @param array $parameters
     * @return \Omnipay\Fatzebra\Message\PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Fatzebra\Message\PurchaseRequest', $parameters);
    }

    /**
     * Fetch a purchase
     *
     * @param array $parameters
     * @return \Omnipay\Fatzebra\Message\FetchTransactionRequest
     */
    public function fetchTransaction(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Fatzebra\Message\FetchTransactionRequest', $parameters);
    }

    /**
     * Refund a purchase
     *
     * @param array $parameters
     * @return \Omnipay\Fatzebra\Message\RefundRequest
     */
    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Fatzebra\Message\RefundRequest', $parameters);
    }

    //
    // Token Payment Calls -- createCard
    // There is no facility in the Fat Zebra gateway to update or delete a stored card.
    //

    /**
     * Tokenize a card
     *
     * @link http://www.paystream.com.au/developer-guides/
     * @param array $parameters
     * @return \Omnipay\Fatzebra\Message\CreateCardRequest
     */
    public function createCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Fatzebra\Message\CreateCardRequest', $parameters);
    }

    //
    // Recurring Purchases -- Creating Plans, etc
    // TODO: This is only partially finished -- need to add customers, subscriptions
    // etc.
    //

    /**
     * Create a plan
     *
     * @link http://www.paystream.com.au/developer-guides/
     * @param array $parameters
     * @return \Omnipay\Fatzebra\Message\CreatePlanRequest
     */
    public function createPlan(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Fatzebra\Message\CreatePlanRequest', $parameters);
    }

    /**
     * Fetch details of a plan
     *
     * @param array $parameters
     * @return \Omnipay\Fatzebra\Message\FetchPlanRequest
     */
    public function fetchPlan(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Fatzebra\Message\FetchPlanRequest', $parameters);
    }

    /**
     * Fetch all plans
     *
     * @param array $parameters
     * @return \Omnipay\Fatzebra\Message\FetchAllPlansRequest
     */
    public function fetchAllPlans(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Fatzebra\Message\FetchAllPlansRequest', $parameters);
    }

    // There is no current method to update a plan -- the gateway supports it
    // but only the plan name and description can be updated, none of the other
    // fields (such as amount).  Therefore probably the best idea is to just
    // create a new plan.  If someone wants to implement updatePlan then do so.

    //
    // Create/Update customer methods.  Here we represent a customer by a
    // CreditCard object because they contain much the same information.
    //

    /**
     * Create a customer
     *
     * @link http://www.paystream.com.au/developer-guides/
     * @param array $parameters
     * @return \Omnipay\Fatzebra\Message\CreateCustomerRequest
     */
    public function createCustomer(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Fatzebra\Message\CreateCustomerRequest', $parameters);
    }

    /**
     * Fetch details of a customer
     *
     * @param array $parameters
     * @return \Omnipay\Fatzebra\Message\FetchCustomerRequest
     */
    public function fetchCustomer(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Fatzebra\Message\FetchCustomerRequest', $parameters);
    }

    /**
     * Delete a customer
     *
     * @param array $parameters
     * @return \Omnipay\Fatzebra\Message\DeleteCustomerRequest
     */
    public function deleteCustomer(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Fatzebra\Message\DeleteCustomerRequest', $parameters);
    }

    //
    // Create/Update subscription methods.
    //

    /**
     * Create a subscription
     *
     * A subscription is an instance of a customer subscribing to a plan.
     *
     * @link http://www.paystream.com.au/developer-guides/
     * @param array $parameters
     * @return \Omnipay\Fatzebra\Message\CreateSubscriptionRequest
     */
    public function createSubscription(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Fatzebra\Message\CreateSubscriptionRequest', $parameters);
    }

    /**
     * Fetch details of a subscription
     *
     * @param array $parameters
     * @return \Omnipay\Fatzebra\Message\FetchSubscriptionRequest
     */
    public function fetchSubscription(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Fatzebra\Message\FetchSubscriptionRequest', $parameters);
    }
}
