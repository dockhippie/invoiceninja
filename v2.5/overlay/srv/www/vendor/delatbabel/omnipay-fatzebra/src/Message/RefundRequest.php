<?php
/**
 * Fat Zebra REST Refund Request
 */

namespace Omnipay\Fatzebra\Message;

/**
 * Fat Zebra REST Refund Request
 *
 * In order to refund a purchase you must submit the following details:
 *
 * * Amount (numerical)
 * * Reference (The Transaction ID of the original transaction to be refunded (XXX-P-YYYYYY)) 
 * * Reference (String) - (The merchants reference for the refund -- in this class we
 *   create it by appending '-REFUND' to the original transaction reference.)  
 *
 * Example -- note this example assumes that the purchase has been successful
 * and that the transaction ID returned from the purchase is held in $sale_id.
 * See PurchaseRequest for the first part of this example transaction:
 *
 * <code>
 *   // Do a refund transaction on the gateway
 *   $transaction = $gateway->refund(array(
 *       'amount'                   => '10.00',
 *       'transactionReference'     => $sale_id,
 *   ));
 *   $response = $transaction->send();
 *   if ($response->isSuccessful()) {
 *       echo "Refund transaction was successful!\n";
 *       $refund_id = $response->getTransactionReference();
 *       echo "Transaction reference = " . $refund_id . "\n";
 *   }
 * </code>
 *
 * @see PurchaseRequest
 * @see Omnipay\Fatzebra\FatzebraGateway
 * @link http://www.paystream.com.au/developer-guides/
 */
class RefundRequest extends AbstractRestRequest
{
    public function getData()
    {
        // An amount parameter is required.  All amounts are in
        // Australian dollars.
        $this->validate('amount', 'transactionReference');
        $data = array(
            'amount'         => $this->getAmount(),
            'transaction_id' => $this->getTransactionReference(),
            'reference'      => $this->getTransactionReference() . '-REFUND',
        );

        return $data;
    }

    /**
     * Get transaction endpoint.
     *
     * Refunds are created using the /purchases resource.
     *
     * @return string
     */
    protected function getEndpoint()
    {
        return parent::getEndpoint() . '/refunds';
    }
}
