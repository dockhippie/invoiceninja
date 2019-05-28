<?php
/**
 * MultiCards REST Refund Request
 */

namespace Omnipay\Multicards\Message;

/**
 * MultiCards REST Refund Request
 *
 * In order to refund a purchase you must submit the following details:
 *
 * * amount (numerical)
 * * transactionReference (The Transaction reference of the original transaction to be refunded)
 *
 * Example -- note this example assumes that the purchase has been successful
 * and that the transaction ID returned from the purchase is held in $sale_id.
 * See PurchaseRequest for the first part of this example transaction:
 *
 * <code>
 * // Do a refund transaction on the gateway
 * $transaction = $gateway->refund(array(
 *     'amount'                   => '10.00',
 *     'transactionReference'     => $sale_id,
 *     'description'              => 'Product out of stock',
 * ));
 * $response = $transaction->send();
 * if ($response->isSuccessful()) {
 *     echo "Refund transaction was successful!\n";
 *     $refund_id = $response->getTransactionReference();
 *     echo "Transaction reference = " . $refund_id . "\n";
 * }
 * </code>
 *
 * Quirks:
 *
 * * Test transactions cannot be refunded through the API.  They can only be refunded
 *   through the Merchant Desktop.  Test transactions can be voided (full refund).
 *
 * @see PurchaseRequest
 * @see VoidRequest
 * @see Omnipay\Multicards\Gateway
 * @link https://www.multicards.com/en/support/merchant_integration_guide.html#refundapi
 */
class RefundRequest extends AbstractRestRequest
{
    public function getData()
    {
        $this->validate('transactionReference');
        $data = parent::getData();
        $data['trans_id']   = $this->getTransactionReference();
        $data['reason']     = $this->getDescription();

        if ($this->getAmount()) {
            $data['action'] = 'partial.credit';
            $data['amount'] = $this->getAmount();
        } else {
            $data['action'] = 'credit';
        }

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
        return parent::getEndpoint() . '/auto/crauto.cgi';
    }
}
