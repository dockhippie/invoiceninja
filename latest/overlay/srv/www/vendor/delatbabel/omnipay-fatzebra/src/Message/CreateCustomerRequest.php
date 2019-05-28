<?php
/**
 * Fat Zebra REST Create Customer Request
 */

namespace Omnipay\Fatzebra\Message;

/**
 * Fat Zebra REST Create Customer Request
 *
 * To create a new customer the following details are required:
 *
 * * First Name
 * * Last Name
 * * Reference (such as your customer's ID number)
 * * Email address (used to deliver email receipts if requested)
 * * IP Address Optional
 * * Card details
 * * - Card Holder (if different from the customer's name)
 * * - Card Number
 * * - Expiry Date
 * * - CVV
 * * Address Details Optional
 * * - Address
 * * - City
 * * - State
 * * - Postcode
 * * - Country
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
 *       'transactionId'            => 'TestCustomer1234',
 *       'clientIp'                 => $_SERVER['REMOTE_ADDR'],
 *       'card'                     => $card,
 *   ));
 *   $response = $transaction->send();
 *   if ($response->isSuccessful()) {
 *       echo "createCustomer transaction was successful!\n";
 *       $customer_id = $response->getCustomerReference();
 *       echo "Customer Reference = " . $customer_id . "\n";
 *       $card_id = $response->getCardReference();
 *       echo "Card Reference = " . $card_id . "\n";
 *   }
 * </code>
 *
 * @link http://www.paystream.com.au/developer-guides/
 * @see Omnipay\Fatzebra\FatzebraGateway
 */
class CreateCustomerRequest extends AbstractRestRequest
{
    public function getData()
    {
        $this->validate('card');
        $card = $this->getCard();
        $card->validate();

        $data['first_name']             = $card->getFirstName();
        $data['last_name']              = $card->getLastName();
        $data['reference']              = $this->getTransactionId();
        $data['email']                  = $card->getEmail();
        $data['ip_address']             = $this->getClientIp();

        $data['card']['card_holder']    = $card->getName();
        $data['card']['card_number']    = $card->getNumber();
        $data['card']['expiry_date']    = $card->getExpiryDate('m/Y');
        $data['card']['cvv']            = $card->getCvv();

        $data['address']['address']     = $card->getBillingAddress1();
        $data['address']['city']        = $card->getBillingCity();
        $data['address']['state']       = $card->getBillingState();
        $data['address']['postcode']    = $card->getBillingPostcode();
        $data['address']['country']     = $card->getBillingCountry();
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
        return parent::getEndpoint() . '/customers';
    }
}
