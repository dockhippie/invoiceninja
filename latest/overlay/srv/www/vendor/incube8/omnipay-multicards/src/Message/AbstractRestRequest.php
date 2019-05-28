<?php
/**
 * Multicards Abstract REST Request
 */

namespace Omnipay\Multicards\Message;

/**
 * Multicards Abstract REST Request
 *
 * This is the parent class for all Multicards REST requests.
 *
 * ### Parameters Required for All Requests
 *
 * * merId             [required] - Merchant ID
 * * password          [required] - Merchant password
 * * merlUrlIdx        [required] - Page id in the MultiCards database.
 *
 * @see \Omnipay\Multicards\Gateway
 * @link https://www.multicards.com/
 * @link https://www.multicards.com/en/support/merchant_integration_guide.html
 */
abstract class AbstractRestRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /**
     * Endpoint URL
     *
     * @var string URL
     */
    protected $endpoint = 'https://secure.multicards.com/cgi-bin/';

    /**
     * Get HTTP Method.
     *
     * This is nearly always POST but can be over-ridden in sub classes.
     *
     * @return string
     */
    protected function getHttpMethod()
    {
        return 'POST';
    }

    /**
     * Get Merchant ID
     *
     * Calls to the Multicards Payments API are secured with a merchant ID and
     * password.  Merchant ID should be a 6 digit number.
     *
     * @return string
     */
    public function getMerId()
    {
        return $this->getParameter('merId');
    }

    /**
     * Set Merchant ID
     *
     * Calls to the Multicards Payments API are secured with a merchant ID and
     * password.  Merchant ID should be a 6 digit number.
     *
     * @param string $value
     * @return AbstractRequest implements a fluent interface
     */
    public function setMerId($value)
    {
        return $this->setParameter('merId', $value);
    }

    /**
     * Get Password
     *
     * Calls to the Multicards Payments API are secured with a merchant ID and
     * password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->getParameter('password');
    }

    /**
     * Set Password
     *
     * Calls to the Multicards Payments API are secured with a merchant ID and
     * password
     *
     * @param string $value
     * @return AbstractRequest implements a fluent interface
     */
    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    /**
     * Get Merchant URL Index
     *
     * Refers to the page ID (page properties) in the MultiCards database.
     * Every order page should have its own idx number. You can create new
     * page IDs in the Merchant Menu.
     *
     * @return string
     */
    public function getMerUrlIdx()
    {
        return $this->getParameter('merUrlIdx');
    }

    /**
     * Set Merchant URL Index
     *
     * Refers to the page ID (page properties) in the MultiCards database.
     * Every order page should have its own idx number. You can create new
     * page IDs in the Merchant Menu.
     *
     * @param string $value
     * @return AbstractRequest implements a fluent interface
     */
    public function setMerUrlIdx($value)
    {
        return $this->setParameter('merUrlIdx', $value);
    }

    /**
     * Get the client IP -- used in every request
     *
     * @return string
     */
    public function getClientIp()
    {
        return $this->getParameter('clientIp');
    }

    /**
     * Set the client IP -- used in every request
     *
     * @return Gateway provides a fluent interface.
     */
    public function setClientIp($value)
    {
        return $this->setParameter('clientIp', $value);
    }

    /**
     * Get API endpoint URL
     *
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * Set the data used in every request.
     *
     * In this gateway a certain amount of data needs to be sent
     * in every request.  This function sets those data into the
     * array and can be extended by child classes.
     *
     * @return array
     */
    public function getData()
    {
        $this->validate('merId', 'password', 'merUrlIdx');
        $data = array(
            'mer_id'            => $this->getMerId(),
            'password'          => $this->getPassword(),
            'mer_url_idx'       => $this->getMerUrlIdx(),
            'client_ip'         => $this->getClientIp(),
        );
        return $data;
    }

    public function sendData($data)
    {
        // don't throw exceptions for 4xx errors
        $this->httpClient->getEventDispatcher()->addListener(
            'request.error',
            function ($event) {
                if ($event['response']->isClientError()) {
                    $event->stopPropagation();
                }
            }
        );

        // Headers
        $headers = [];
        // $headers = ['Accept' => 'application/json'];

        // Send the data as a GET or POST request with parameters.
        if ($this->getHttpMethod() == 'GET') {
            $httpRequest = $this->httpClient->createRequest(
                $this->getHttpMethod(),
                $this->getEndpoint() . '?' . http_build_query($data),
                $headers
            );
        } else {
            $httpRequest = $this->httpClient->createRequest(
                $this->getHttpMethod(),
                $this->getEndpoint(),
                $headers,
                $data
            );
        }

        // Get the HTTP response and the body, and parse the body text into the data array
        $httpResponse = $httpRequest->send();
        $body_text = $httpResponse->getBody(true);
        $body_data = [];
        parse_str($body_text, $body_data);

        /*
        // Might be useful to have some debug code here.  Perhaps hook to whatever
        // logging engine is being used.
        $handle = fopen('debug.txt', 'a');
        fwrite($handle, "Data == " . print_r($data, true) . "\n");
        # fwrite($handle, "Response == " . print_r($httpResponse, true) . "\n\n");
        fwrite($handle, "Response Body Text:\n\n" . $body_text . "\n");
        fwrite($handle, "Response Body Data:\n\n" . print_r($body_data, true) . "\n");
        fclose($handle);
        */

        return $this->response = new RestResponse($this, $body_data, $httpResponse->getStatusCode());
    }
}
