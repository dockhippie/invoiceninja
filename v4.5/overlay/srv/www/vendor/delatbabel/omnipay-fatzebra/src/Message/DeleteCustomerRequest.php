<?php
/**
 * Fat Zebra REST Delete Customer Request
 */

namespace Omnipay\Fatzebra\Message;

/**
 * Fat Zebra REST Delete Customer Request
 *
 * Example:
 *
 * <code>
 *   // Delete Customer
 *   $transaction = $gateway->deleteCustomer(array(
 *       'transactionReference'  => 'YYY-C-XXXXXXX'
 *   ));
 *   $response = $transaction->send();
 *   $data = $response->getData();
 *   echo "Gateway deleteCustomer response data == " . print_r($data, true) . "\n";
 * </code>
 *
 * @see CreateCustomerRequest
 * @see Omnipay\Fatzebra\FatzebraGateway
 * @link http://www.paystream.com.au/developer-guides/
 */
class DeleteCustomerRequest extends AbstractRestRequest
{
    public function getData()
    {
        $this->validate('transactionReference');
        return array();
    }

    /**
     * Get HTTP Method.
     *
     * The HTTP method for deleteCustomer requests must be DELETE.
     *
     * @return string
     */
    protected function getHttpMethod()
    {
        return 'DELETE';
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . '/customers/' . $this->getTransactionReference();
    }
}
