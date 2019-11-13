<?php
/**
 * MultiCards REST Purchase Request
 */

namespace Omnipay\Multicards\Message;

/**
 * MultiCards REST Purchase Request using the Order API
 *
 * Route: https://secure.multicards.com/cgi-bin/order2/poauto3.pl
 *
 * Method: POST
 *
 * ### Examples
 *
 * #### Set Up and Initialise Gateway
 *
 * <code>
 * // Create a gateway for the MultiCards REST Gateway
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
 * </code>
 *
 * #### Payment with Card Details
 *
 * <code>
 * // Create a credit card object
 * // This card can be used for testing.
 * $card = new CreditCard(array(
 *     'firstName'             => 'Example',
 *     'lastName'              => 'Customer',
 *     'number'                => '4242424242424242',
 *     'expiryMonth'           => '01',
 *     'expiryYear'            => '2020',
 *     'cvv'                   => '123',
 *     'email'                 => 'customer@example.com',
 *     'billingAddress1'       => '1 Scrubby Creek Road',
 *     'billingCountry'        => 'AU',
 *     'billingCity'           => 'Scrubby Creek',
 *     'billingPostcode'       => '4999',
 *     'billingState'          => 'QLD',
 *     'billingPhone'          => '12341234',
 * ));
 *
 * // Do a purchase transaction on the gateway
 * $transaction = $gateway->purchase(array(
 *     'clientIp'                  => '127.0.0.1',
 *     'amount'                    => '10.00',
 *     'currency'                  => 'AUD',
 *     'description'               => 'Super Deluxe Excellent Discount Package',
 *     'card'                      => $card,
 * ));
 * $response = $transaction->send();
 * if ($response->isSuccessful()) {
 *     echo "Purchase transaction was successful!\n";
 *     $sale_id = $response->getTransactionReference();
 *     echo "Transaction reference = " . $sale_id . "\n";
 * }
 * </code>
 *
 * #### Payment with Card Token
 *
 * To obtain a card reference (the cardReference parameter) a previous purchase
 * call must be completed successfully.  After the successful completion, check
 * the result of getCardReference on the response:
 *
 * <code>
 * // Do a purchase transaction on the gateway
 * $transaction = $gateway->purchase(array(
 *     'clientIp'                  => '127.0.0.1',
 *     'amount'                    => '10.00',
 *     'currency'                  => 'AUD',
 *     'description'               => 'Super Deluxe Excellent Discount Package',
 *     'card'                      => $card,
 * ));
 * $response = $transaction->send();
 * if ($response->isSuccessful()) {
 *     echo "Purchase transaction was successful!\n";
 *     $cardReference = $response->getCardReference();
 *     echo "Card reference = " . $cardReference . "\n";
 * }
 * </code>
 *
 * Once you have the cardReference it can be used in further transactions as
 * follows:
 *
 * <code>
 * // Do a purchase transaction on the gateway
 * $transaction = $gateway->purchase(array(
 *     'clientIp'                  => '127.0.0.1',
 *     'amount'                    => '10.00',
 *     'currency'                  => 'AUD',
 *     'description'               => 'Super Deluxe Excellent Discount Package',
 *     'cardReference'             => $cardReference,
 * ));
 * $response = $transaction->send();
 * if ($response->isSuccessful()) {
 *     echo "Purchase transaction was successful!\n";
 *     $sale_id = $response->getTransactionReference();
 *     echo "Transaction reference = " . $sale_id . "\n";
 * }
 * </code>
 *
 * ### Parameters
 *
 * * clientIp          [required] - ip address of the user making a payment
 * * amount            [required] -
 * * currency          [required] - ISO 4217 to charge in
 * * description       [required] - description of the purchase
 *
 * #### For credit card payments
 *
 * * card              [required] - Credit card details as an Omnipay CreditCard object
 *
 * #### For credit card token payments
 *
 * * cardReference     [required] - Credit card token
 *
 * ### Test Payments
 *
 * Once you are logged in, in the merchant menu go to the desktop screen
 * and click on "Test order page". Enable a test credit card code and
 * follow the instructions to run a test order with a test credit card.
 *
 * Make sure that you post your own IP address in the client_ip variable,
 * and that your IP is white listed in the test code.
 *
 * Test card codes expire 60 minutes after being enabled.
 *
 * @see Omnipay\Multicards\Gateway
 * @link https://www.multicards.com/en/support/merchant_integration_guide.html#orderapi
 * @link https://www.multicards.com/en/support/orderpage-card-customer-variables.html
 */
class PurchaseRequest extends AbstractRestRequest
{

    /**
     * getData
     *
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidCreditCardException
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        // An amount parameter is required, as is a currency.
        $this->validate('amount', 'currency', 'description');
        $data = parent::getData();

        // Some predefined variables that need to be set
        $data['next_phase']         = 'paydata';
        $data['agree2terms']        = '1';

        // Send through the charge amount and description, we will always set
        // the qty to 1
        $data['item1_desc']         = $this->getDescription();
        $data['item1_price']        = $this->getAmount();
        $data['item1_qty']          = 1;
        // $data['rebill_amount']      = $this->getAmount();
        $data['valuta_code']        = $this->getCurrency();
        $data['user1']              = $this->getUser1();
        $data['user2']              = $this->getUser2();
        $data['dyn_desc']           = $this->getDynDesc();

        // MultiCards supports card or token payments
        if ($this->getCardReference()) {
            $data['token_id'] = $this->getCardReference();
        } else {
            $this->validate('card');
            $card = $this->getCard();

            // Test Payments in particular use a card number that does not
            // validate against the Luhn algorithm, so don't validate the card.
            // $card->validate();

            /// Card data passed through
            $data['cust_name']          = $card->getName();
            $data['cust_address1']      = $card->getBillingAddress1();
            $data['cust_city']          = $card->getBillingCity();
            $data['cust_state']         = $card->getBillingState();
            $data['cust_zip']           = $card->getBillingPostcode();
            $data['cust_phone']         = $card->getBillingPhone();
            $data['cust_email']         = $card->getEmail();
            $data['cust_country']       = $card->getBillingCountry();

            $data['card_num']           = $card->getNumber();
            $data['card_name']          = $card->getName();
            $data['card_exp']           = $card->getExpiryDate('m/y');
            $data['card_code']          = $card->getCvv();

            // This requests a token_id to be returned with the response so that
            // the card reference can be used next time.
            $data['req_trans_token']    = '1';
        }

        return $data;
    }

    /**
     * Get the user1 variable -- used in every purchase request
     *
     * The user1 variable is an optional variable we can use to send
     * a value we needed to be returned during callbacks [IPN]
     * For this case, use2pay uses this to send the payment_id as identifier for it's callbacks.
     *
     * https://www.multicards.com/en/support/merchant_integration_guide.html#silentpost_ipn
     * https://www.multicards.com/en/support/merchant_integration_guide.html#morevariables
     *
     * @return string
     */
    public function getUser1()
    {
        return $this->getParameter('user1');
    }

    /**
     * Set the user1 variable -- used in every purchase request
     *
     * The user1 variable is an optional variable we can use to send
     * a value we needed to be returned during callbacks [IPN]
     * For this case, use2pay uses this to send the payment_id as identifier for it's callbacks.
     *
     * https://www.multicards.com/en/support/merchant_integration_guide.html#silentpost_ipn
     * https://www.multicards.com/en/support/merchant_integration_guide.html#morevariables
     *
     * @return PurchaseRequest provides a fluent interface.
     */
    public function setUser1($value)
    {
        return $this->setParameter('user1', $value);
    }

    /**
     * Get the user2 variable -- used in every purchase request
     *
     * The user2 variable is an optional variable we can use to send
     * a value we needed to be returned during callbacks [IPN]
     * For this case, use2pay uses this to send the site_short_code as identifier for it's callbacks.
     *
     * https://www.multicards.com/en/support/merchant_integration_guide.html#silentpost_ipn
     * https://www.multicards.com/en/support/merchant_integration_guide.html#morevariables
     *
     * @return string
     */
    public function getUser2()
    {
        return $this->getParameter('user2');
    }

    /**
     * Set the dyn_desc variable -- used in every purchase request
     *
     * The dyn_desc variable is an optional variable we can use to send during purchase request
     * This should be the uppercase version of the site short code
     * This will be added to the customer's card statement after 2BuySafe.com/
     *
     * https://www.multicards.com/en/support/merchant_integration_guide.html#silentpost_ipn
     * https://www.multicards.com/en/support/merchant_integration_guide.html#morevariables
     *
     * @return PurchaseRequest provides a fluent interface.
     */
    public function setDynDesc($value)
    {
        return $this->setParameter('dyn_desc', $value);
    }

    /**
     * Get the dyn_desc variable -- used in every purchase request
     *
     * The dyn_desc variable is an optional variable we can use to send during purchase request
     * This should be the uppercase version of the site short code
     * This will be added to the customer's card statement after 2BuySafe.com/
     *
     * https://www.multicards.com/en/support/merchant_integration_guide.html#silentpost_ipn
     * https://www.multicards.com/en/support/merchant_integration_guide.html#morevariables
     *
     * @return string
     */
    public function getDynDesc()
    {
        return $this->getParameter('dyn_desc');
    }

    /**
     * Get the user2 variable -- used in every purchase request
     *
     * The user2 variable is an optional variable we can use to send
     * a value we needed to be returned during callbacks [IPN]
     * For this case, use2pay uses this to send the site_short_code as identifier for it's callbacks.
     *
     * https://www.multicards.com/en/support/merchant_integration_guide.html#silentpost_ipn
     * https://www.multicards.com/en/support/merchant_integration_guide.html#morevariables
     *
     * @return PurchaseRequest provides a fluent interface.
     */
    public function setUser2($value)
    {
        return $this->setParameter('user2', $value);
    }

    /**
     * Get transaction endpoint.
     *
     * Purchases are created using the /payments/submit resource.
     *
     * @return string
     */
    protected function getEndpoint()
    {
        return parent::getEndpoint() . 'order2/poauto3.pl';
    }
}
