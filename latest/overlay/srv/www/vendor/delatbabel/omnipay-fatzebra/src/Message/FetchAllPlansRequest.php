<?php
/**
 * Fat Zebra REST Fetch All Plans Request
 */

namespace Omnipay\Fatzebra\Message;

/**
 * Fat Zebra REST Fetch All Plans Request
 *
 * Example:
 *
 * <code>
 *   // Fetch all plans
 *   $transaction = $gateway->fetchAllPlans();
 *   $response = $transaction->send();
 *   $data = $response->getData();
 *   echo "Gateway fetchAllPlans response data == " . print_r($data, true) . "\n";
 * </code>
 *
 * @see PurchaseRequest
 * @see Omnipay\Fatzebra\FatzebraGateway
 * @link http://www.paystream.com.au/developer-guides/
 */
class FetchAllPlansRequest extends AbstractRestRequest
{
    public function getData()
    {
        return array();
    }

    /**
     * Get HTTP Method.
     *
     * The HTTP method for fetchAll Plans requests must be GET.
     *
     * @return string
     */
    protected function getHttpMethod()
    {
        return 'GET';
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . '/plans.json';
    }
}
