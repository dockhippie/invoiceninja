<?php

namespace Omnipay\Creditcall;

use Omnipay\Common\AbstractGateway;

/**
 * Creditcall Gateway
 */
class Gateway extends AbstractGateway
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Creditcall';
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return array(
            'terminalId'     => '',
            'transactionKey' => '',
            'testMode'       => false,
            'verifyCvv'      => true,
            'verifyAddress'  => false,
            'verifyZip'      => false,
        );
    }

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
     * @param bool $value
     * @return $this
     */
    public function setVerifyCvv($value)
    {
        return $this->setParameter('verifyCvv', $value);
    }

    /**
     * @return string
     */
    public function getVerifyAddress()
    {
        return $this->getParameter('verifyAddress');
    }

    /**
     * @param bool $value
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
     * @param bool $value
     * @return $this
     */
    public function setVerifyZip($value)
    {
        return $this->setParameter('verifyZip', $value);
    }

    /**
     * @param array $parameters
     * @return Message\AuthorizeRequest
     */
    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Creditcall\Message\AuthorizeRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return Message\CaptureRequest
     */
    public function capture(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Creditcall\Message\CaptureRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return Message\PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Creditcall\Message\PurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return Message\VoidRequest
     */
    public function void(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Creditcall\Message\VoidRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return Message\RefundRequest
     */
    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Creditcall\Message\RefundRequest', $parameters);
    }
}
