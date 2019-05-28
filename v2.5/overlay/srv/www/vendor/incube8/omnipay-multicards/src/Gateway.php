<?php
/**
 * MultiCards Gateway
 */

namespace Omnipay\Multicards;

use Omnipay\Common\AbstractGateway;

/**
 * MultiCards Gateway
 *
 * MultiCards Internet Billing is a provider of online credit card and debit
 * card processing and payment solutions to many retailers worldwide.
 *
 * MultiCards is a registered trade name of PM International BV, Chamber of
 * Commerce Eindhoven 17131862, VAT Number NL809335141B01, an independent
 * business unit of De Postel Beheer BV, Eindhoven, The Netherlands.
 *
 * ### Example
 *
 * <code>
 * // Create a gateway for the Multicards REST Gateway
 * // (routes to GatewayFactory::create)
 * $gateway = Omnipay::create('Multicards');
 *
 * // Initialise the gateway
 * $gateway->initialize(array(
 *     'merId'     => '12341234',
 *     'password'  => 'thisISmyPASSWORD',
 *     'merUrlIdx' => 1,
 *     'testMode'  => true, // Or false when you are ready for live transactions
 * ));
 *
 * // Create a credit card object
 * $card = new CreditCard(array(
 *     'firstName'            => 'Example',
 *     'lastName'             => 'Customer',
 *     'number'               => '4222222222222222',
 *     'expiryMonth'          => '01',
 *     'expiryYear'           => '2020',
 *     'cvv'                  => '123',
 *     'email'                => 'customer@example.com',
 *     'billingAddress1'      => '1 Scrubby Creek Road',
 *     'billingCountry'       => 'AU',
 *     'billingCity'          => 'Scrubby Creek',
 *     'billingPostcode'      => '4999',
 *     'billingState'         => 'QLD',
 * ));
 *
 * // Do a purchase transaction on the gateway
 * $transaction = $gateway->purchase(array(
 *     'description'              => 'Your order for widgets',
 *     'amount'                   => '10.00',
 *     'currency'                 => 'AUD',
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
 * ### Quirks
 *
 * There is no createCard message in this gateway.  Token purchases are supported,
 * but a call to purchase() needs to be made in order to create a card token.
 *
 * @see \Omnipay\Common\AbstractGateway
 * @link https://www.multicards.com/
 * @link https://www.multicards.com/en/support/merchant_integration_guide.html
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Multicards';
    }

    public function getDefaultParameters()
    {
        return array(
            'merId'         => '',
            'password'      => '',
            'merUrlIdx'     => '1',
            'testMode'      => false,
        );
    }

    /**
     * Get Merchant ID
     *
     * Calls to the Multicards Payments API are secured with a merchant ID and
     * password.  Merchant ID should be a 6 digit number.
     *
     * @return string
     */
    public function getMerId()
    {
        return $this->getParameter('merId');
    }

    /**
     * Set Merchant ID
     *
     * Calls to the Multicards Payments API are secured with a merchant ID and
     * password.  Merchant ID should be a 6 digit number.
     *
     * @param string $value
     * @return Gateway implements a fluent interface
     */
    public function setMerId($value)
    {
        return $this->setParameter('merId', $value);
    }

    /**
     * Get Password
     *
     * Calls to the Multicards Payments API are secured with a merchant ID and
     * password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->getParameter('password');
    }

    /**
     * Set Password
     *
     * Calls to the Multicards Payments API are secured with a merchant ID and
     * password
     *
     * @param string $value
     * @return Gateway implements a fluent interface
     */
    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    /**
     * Get Merchant URL Index
     *
     * Refers to the page ID (page properties) in the MultiCards database.
     * Every order page should have its own idx number. You can create new
     * page IDs in the Merchant Menu.
     *
     * @return string
     */
    public function getMerUrlIdx()
    {
        return $this->getParameter('merUrlIdx');
    }

    /**
     * Set Merchant URL Index
     *
     * Refers to the page ID (page properties) in the MultiCards database.
     * Every order page should have its own idx number. You can create new
     * page IDs in the Merchant Menu.
     *
     * @param string $value
     * @return Gateway implements a fluent interface
     */
    public function setMerUrlIdx($value)
    {
        return $this->setParameter('merUrlIdx', $value);
    }

    /**
     * Get the client IP -- used in every request
     *
     * @return string
     */
    public function getClientIp()
    {
        return $this->getParameter('clientIp');
    }

    /**
     * Set the client IP -- used in every request
     *
     * @return Gateway provides a fluent interface.
     */
    public function setClientIp($value)
    {
        return $this->setParameter('clientIp', $value);
    }

    //
    // Direct API Purchase Calls -- purchase, refund
    //

    /**
     * Create a purchase request.
     *
     * @param array $parameters
     * @return \Omnipay\Multicards\Message\PurchaseRequest
     */

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Multicards\Message\PurchaseRequest', $parameters);
    }

    /**
     * Create an authorize request.
     *
     * @param array $parameters
     * @return \Omnipay\Multicards\Message\AuthorizeRequest
     */

    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Multicards\Message\AuthorizeRequest', $parameters);
    }

    /**
     * Create a refund request.
     *
     * @param array $parameters
     * @return \Omnipay\Multicards\Message\RefundRequest
     */

    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Multicards\Message\RefundRequest', $parameters);
    }

    /**
     * Create a void request.
     *
     * @param array $parameters
     * @return \Omnipay\Multicards\Message\VoidRequest
     */

    public function void(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Multicards\Message\VoidRequest', $parameters);
    }
}
