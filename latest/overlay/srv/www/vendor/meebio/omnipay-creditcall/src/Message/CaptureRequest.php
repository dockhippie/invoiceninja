<?php

namespace Omnipay\Creditcall\Message;

use SimpleXMLElement;

class CaptureRequest extends AbstractRequest
{
    /**
     * @return string
     */
    public function getAction()
    {
        return 'Conf';
    }

    /**
     * @return SimpleXMLElement
     */
    public function getData()
    {
        $data = $this->getBaseData();

        $transactionDetails = $data->TransactionDetails[0];
        $transactionDetails->addChild('CardEaseReference', $this->getTransactionReference());

        return $data;
    }
}
