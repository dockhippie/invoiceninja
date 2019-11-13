<?php
namespace Omnipay\Neteller\Message;

use SimpleXMLElement;

/**
 * Neteller Abstract Request
 *
 * @author Joao Dias <joao.dias@cherrygroup.com>
 * @copyright 2014 Cherry Ltd.
 * @license http://opensource.org/licenses/mit-license.php MIT
 * @version 1.0.0
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $liveEndpoint = 'https://api.neteller.com/';
    protected $testEndpoint = 'https://test.api.neteller.com/';

    /**
     * Get the version for this request.
     *
     * @return string version
     */
    abstract protected function getVersion();

    /**
     * Get the method for this request.
     *
     * @return string method
     */
    abstract protected function getMethod();

    /**
     * Get the Merchant ID you were assigned when your NETELLER merchant account was
     * created.
     *
     * @return string merchant id
     */
    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    /**
     * Set the Merchant ID you were assigned when your NETELLER merchant account was
     * created.
     *
     * @param  string $value merchant id
     * @return self
     */
    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    /**
     * Get the Merchant Key you were assigned when your NETELLER merchant account was
     * created.
     *
     * @return string merchant key
     */
    public function getMerchantKey()
    {
        return $this->getParameter('merchantKey');
    }

    /**
     * Set the Merchant Key you were assigned when your NETELLER merchant account was
     * created.
     *
     * If you have generated a new Merchant Key, the most recent Merchant Key is to be
     * used.
     *
     * @param  string $value merchant key
     * @return self
     */
    public function setMerchantKey($value)
    {
        return $this->setParameter('merchantKey', $value);
    }

    /**
     * Get the data for this request.
     *
     * @return array request data
     */
    public function getData()
    {
        $this->validate(
            'merchantId',
            'merchantKey'
        );

        $data['version'] = $this->getVersion();
        $data['merchant_id'] = $this->getMerchantId();
        $data['merch_key'] = $this->getMerchantKey();

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data)
    {
        $httpResponse = $this->httpClient->post($this->getEndpoint(), null, $data)->send();
        return $this->createResponse($httpResponse->xml());
    }

    /**
     * Get the endpoint for this request.
     *
     * @return string endpoint
     */
    public function getEndpoint()
    {
        $endpoint = $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
        return $endpoint . $this->getMethod();
    }

    /**
     * Create a proper response based on the request.
     *
     * @param  SimpleXMLElement  $xml  xml response
     * @return AbstractResponse            response for this request
     */
    protected function createResponse(SimpleXMLElement $xml)
    {
        $requestClass = get_class($this);
        $responseClass = substr($requestClass, 0, -7) . 'Response';
        return $this->response = new $responseClass($this, $xml);
    }
}
