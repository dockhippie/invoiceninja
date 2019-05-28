<?php

namespace Omnipay\Creditcall\Message;

use SimpleXMLElement;

class VoidRequest extends AbstractRequest
{
    /**
     * @return string
     */
    public function getAction()
    {
        return 'Void';
    }

    /**
     * @return SimpleXMLElement
     */
    public function getData()
    {
        $data = $this->getBaseData();

        $transactionDetails = $data->TransactionDetails[0];
        $transactionDetails->addChild('CardEaseReference', $this->getTransactionReference());
        $transactionDetails->addChild('Reference', $this->getTransactionId());
        $transactionDetails->addChild('VoidReason', $this->getVoidReason());

        return $data;
    }

    /**
     * @return string
     */
    public function getVoidReason()
    {
        return $this->getParameter('voidReason');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setVoidReason($value)
    {
        return $this->setParameter('voidReason', $value);
    }
}
