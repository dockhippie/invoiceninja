<?php

namespace Omnipay\Creditcall\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;
use SimpleXMLElement;

/**
 * Abstract Request
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    /**
     * @var string
     */
    protected $liveEndpoint = 'https://live.cardeasexml.com/generic.cex';

    /**
     * @var string
     */
    protected $testEndpoint = 'https://test.cardeasexml.com/generic.cex';

    /**
     * @return string
     */
    abstract public function getAction();

    /**
     * @return string
     */
    public function getTerminalId()
    {
        return $this->getParameter('terminalId');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setTerminalId($value)
    {
        return $this->setParameter('terminalId', $value);
    }

    /**
     * @return string
     */
    public function getTransactionKey()
    {
        return $this->getParameter('transactionKey');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setTransactionKey($value)
    {
        return $this->setParameter('transactionKey', $value);
    }

    /**
     * @return bool
     */
    public function getVerifyCvv()
    {
        return $this->getParameter('verifyCvv');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setVerifyCvv($value)
    {
        return $this->setParameter('verifyCvv', $value);
    }

    /**
     * @return bool
     */
    public function getVerifyAddress()
    {
        return $this->getParameter('verifyAddress');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setVerifyAddress($value)
    {
        return $this->setParameter('verifyAddress', $value);
    }

    /**
     * @return bool
     */
    public function getVerifyZip()
    {
        return $this->getParameter('verifyZip');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setVerifyZip($value)
    {
        return $this->setParameter('verifyZip', $value);
    }

    /**
     * @return SimpleXMLElement
     */
    public function getBaseData()
    {
        $data = new SimpleXMLElement('<?xml version="1.0" standalone="yes"?><Request/>');
        $data->addAttribute('type', 'CardEaseXML');
        $data->addAttribute('version', '1.1.0');

        $transactionDetails = $data->addChild('TransactionDetails');
        $transactionDetails->addChild('MessageType', $this->getAction());

        $terminalDetails = $data->addChild('TerminalDetails');
        $terminalDetails->addChild('TerminalID', $this->getTerminalId());
        $terminalDetails->addChild('TransactionKey', $this->getTransactionKey());

        $software = $terminalDetails->addChild('Software', 'Omnipay/Creditcall');
        $software->addAttribute('version', '0.1');

        return $data;
    }

    /**
     * @param SimpleXMLElement $data
     * @return Response
     */
    public function sendData($data)
    {
        $headers      = array(
            'Content-Type' => 'text/xml',
        );
        $httpResponse = $this->httpClient->post($this->getEndpoint(), $headers, $data->asXML())->send();

        return $this->createResponse($httpResponse->xml());
    }

    /**
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    /**
     * @param string $data
     * @return Response
     */
    protected function createResponse($data)
    {
        return $this->response = new Response($this, $data);
    }
}
