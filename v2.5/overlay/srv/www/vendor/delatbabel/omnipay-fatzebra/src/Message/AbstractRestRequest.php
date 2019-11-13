<?php
/**
 * Fat Zebra Abstract REST Request
 */

namespace Omnipay\Fatzebra\Message;

use Guzzle\Http\EntityBody;

/**
 * Fat Zebra Abstract REST Request
 *
 * This is the parent class for all Fat Zebra REST requests.
 *
 * Test modes:
 *
 * There are two test modes in the Paystream system - one is a
 * sandbox environment and the other is a test mode flag.
 *
 * The Sandbox Environment is an identical copy of the live environment
 * which is 100% functional except for communicating with the banks.
 *
 * The Test Mode Flag is used to switch the live environment into
 * test mode. If test: true is sent with your request your transactions
 * will be executed in the live environment, but not communicate with
 * the bank backends. This mode is useful for testing changes to your
 * live website.
 *
 * Currently this class makes the assumption that if the testMode
 * flag is set then the Sandbox Environment is being used.
 *
 * @link http://www.paystream.com.au/developer-guides/
 * @see \Omnipay\Fatzebra\FatzebraGateway
 */
abstract class AbstractRestRequest extends \Omnipay\Common\Message\AbstractRequest
{
    const API_VERSION = 'v1.0';

    /**
     * Sandbox Endpoint URL
     *
     * @var string URL
     */
    protected $testEndpoint = 'https://gateway.sandbox.fatzebra.com.au';

    /**
     * Live Endpoint URL
     *
     * @var string URL
     */
    protected $liveEndpoint = 'https://gateway.fatzebra.com.au';

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
     * Get API endpoint URL
     *
     * @return string
     */
    protected function getEndpoint()
    {
        $base = $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
        return $base . '/' . self::API_VERSION;
    }

    /**
     * Get the gateway username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->getParameter('username');
    }

    /**
     * Set the gateway username
     *
     * @return AbstractRestRequest provides a fluent interface.
     */
    public function setUsername($value)
    {
        return $this->setParameter('username', $value);
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

        // Guzzle HTTP Client createRequest does funny things when a GET request
        // has attached data, so don't send the data if the method is GET.
        if ($this->getHttpMethod() == 'GET') {
            $httpRequest = $this->httpClient->createRequest(
                $this->getHttpMethod(),
                $this->getEndpoint(),
                array(
                    'Accept'         => 'application/json',
                )
            )->setAuth($this->getUsername(), $this->getToken());
        } else {
            $httpRequest = $this->httpClient->createRequest(
                $this->getHttpMethod(),
                $this->getEndpoint(),
                array(
                    'Accept'         => 'application/json',
                    'Content-type'   => 'application/json',
                ),
                json_encode($data)
            )->setAuth($this->getUsername(), $this->getToken());
        }
        
        // Might be useful to have some debug code here.  Perhaps hook to whatever
        // logging engine is being used.
        // echo "Data == " . json_encode($data) . "\n";

        $httpResponse = $httpRequest->send();

        return $this->response = new RestResponse($this, $httpResponse->json(), $httpResponse->getStatusCode());
    }
}
