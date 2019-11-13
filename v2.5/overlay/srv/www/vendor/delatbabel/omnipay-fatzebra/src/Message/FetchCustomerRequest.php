<?php
/**
 * Fat Zebra REST Fetch Customer Request
 */

namespace Omnipay\Fatzebra\Message;

/**
 * Fat Zebra REST Fetch Customer Request
 *
 * Example:
 *
 * <code>
 *   // Fetch Customer
 *   $transaction = $gateway->fetchCustomer(array(
 *       'transactionReference'  => 'YYY-C-XXXXXXX'
 *   ));
 *   $response = $transaction->send();
 *   $data = $response->getData();
 *   echo "Gateway fetchCustomer response data == " . print_r($data, true) . "\n";
 * </code>
 *
 * @see CreateCustomerRequest
 * @see Omnipay\Fatzebra\FatzebraGateway
 * @link http://www.paystream.com.au/developer-guides/
 */
class FetchCustomerRequest extends AbstractRestRequest
{
    public function getData()
    {
        $this->validate('transactionReference');
        return array();
    }

    /**
     * Get HTTP Method.
     *
     * The HTTP method for fetchCustomer requests must be GET.
     *
     * @return string
     */
    protected function getHttpMethod()
    {
        return 'GET';
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . '/customers/' . $this->getTransactionReference();
    }
}
