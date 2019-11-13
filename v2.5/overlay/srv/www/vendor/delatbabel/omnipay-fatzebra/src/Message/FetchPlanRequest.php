<?php
/**
 * Fat Zebra REST Fetch Plan Request
 */

namespace Omnipay\Fatzebra\Message;

/**
 * Fat Zebra REST Fetch Plan Request
 *
 * Example:
 *
 * <code>
 *   // Fetch all plans
 *   $transaction = $gateway->fetchPlan(array(
 *       'transactionReference'  => 'XXX-PL-YYYYYYY'
 *   ));
 *   $response = $transaction->send();
 *   $data = $response->getData();
 *   echo "Gateway fetchPlan response data == " . print_r($data, true) . "\n";
 * </code>
 *
 * @see CreatePlanRequest
 * @see Omnipay\Fatzebra\FatzebraGateway
 * @link http://www.paystream.com.au/developer-guides/
 */
class FetchPlanRequest extends AbstractRestRequest
{
    public function getData()
    {
        $this->validate('transactionReference');
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
        return parent::getEndpoint() . '/plans/' . $this->getTransactionReference();
    }
}
