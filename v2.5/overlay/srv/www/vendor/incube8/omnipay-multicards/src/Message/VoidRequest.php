<?php
/**
 * MultiCards REST Void Request
 */

namespace Omnipay\Multicards\Message;

/**
 * MultiCards REST Void Request
 *
 * In order to void a purchase you must submit the following details:
 *
 * * transactionReference (The Transaction reference of the original transaction to be refunded)
 *
 * Example -- note this example assumes that the purchase has been successful
 * and that the transaction ID returned from the purchase is held in $sale_id.
 * See PurchaseRequest for the first part of this example transaction:
 *
 * <code>
 * // Do a refund transaction on the gateway
 * $transaction = $gateway->void(array(
 *     'transactionReference'     => $sale_id,
 *     'description'              => 'Product out of stock',
 * ));
 * $response = $transaction->send();
 * if ($response->isSuccessful()) {
 *     echo "Void transaction was successful!\n";
 *     $refund_id = $response->getTransactionReference();
 *     echo "Transaction reference = " . $refund_id . "\n";
 * }
 * </code>
 *
 * @see PurchaseRequest
 * @see Omnipay\Multicards\Gateway
 * @link https://www.multicards.com/en/support/merchant_integration_guide.html#refundapi
 */
class VoidRequest extends AbstractRestRequest
{
    public function getData()
    {
        $this->validate('transactionReference');
        $data = parent::getData();
        $data['trans_id']   = $this->getTransactionReference();
        $data['reason']     = $this->getDescription();
        $data['action'] = 'credit';

        return $data;
    }

    /**
     * Get transaction endpoint.
     *
     * Voids are created using the /purchases resource.
     *
     * @return string
     */
    protected function getEndpoint()
    {
        return parent::getEndpoint() . '/auto/crauto.cgi';
    }
}
