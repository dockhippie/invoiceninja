<?php
/**
 * Fat Zebra REST Fetch Subscription Request
 */

namespace Omnipay\Fatzebra\Message;

/**
 * Fat Zebra REST Fetch Subscription Request
 *
 * Example:
 *
 * <code>
 *   // Fetch subscription
 *   $transaction = $gateway->fetchSubscription(array(
 *       'transactionReference'  => 'XXX-S-YYYYYYY'
 *   ));
 *   $response = $transaction->send();
 *   $data = $response->getData();
 *   echo "Gateway fetchSubscription response data == " . print_r($data, true) . "\n";
 * </code>
 *
 * @see CreateSubscriptionRequest
 * @see Omnipay\Fatzebra\FatzebraGateway
 * @link http://www.paystream.com.au/developer-guides/
 */
class FetchSubscriptionRequest extends AbstractRestRequest
{
    public function getData()
    {
        $this->validate('transactionReference');
        return array();
    }

    /**
     * Get HTTP Method.
     *
     * The HTTP method for fetchAll Subscriptions requests must be GET.
     *
     * @return string
     */
    protected function getHttpMethod()
    {
        return 'GET';
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . '/subscriptions/' . $this->getTransactionReference();
    }
}
