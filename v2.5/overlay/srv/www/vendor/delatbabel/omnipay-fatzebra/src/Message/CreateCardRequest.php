<?php
/**
 * Fat Zebra REST Create Card (Tokenize) Request
 */

namespace Omnipay\Fatzebra\Message;

/**
 * Fat Zebra REST Create Card (Tokenize) Request
 *
 * In order to tokenize a credit card you must submit the following details:
 *
 * * Card Holder (string)
 * * Card Number (string, numerical, 13 to 16 digits)
 * * Card Expiry (string, mm/yyyy format)
 * * CVV (numerical, 3 or 4 digits)
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
 *   ));
 *
 *   // Do a tokenize transaction on the gateway
 *   $transaction = $gateway->createCard(array(
 *       'card'                     => $card,
 *   ));
 *   $response = $transaction->send();
 *   if ($response->isSuccessful()) {
 *       echo "createCard transaction was successful!\n";
 *       $card_id = $response->getCardReference();
 *       echo "Card Reference = " . $card_id . "\n";
 *   }
 * </code>
 *
 * @link http://www.paystream.com.au/developer-guides/
 * @see Omnipay\Fatzebra\FatzebraGateway
 */
class CreateCardRequest extends AbstractRestRequest
{
    public function getData()
    {
        $this->validate('card');
        $card = $this->getCard();
        $card->validate();
        $data['card_holder'] = $card->getName();
        $data['card_number'] = $card->getNumber();
        $data['card_expiry'] = $card->getExpiryDate('m/Y');
        $data['cvv'] = $card->getCvv();

        return $data;
    }

    /**
     * Get transaction endpoint.
     *
     * Cards are created using the /credit_cards resource.
     *
     * @return string
     */
    protected function getEndpoint()
    {
        return parent::getEndpoint() . '/credit_cards';
    }
}
