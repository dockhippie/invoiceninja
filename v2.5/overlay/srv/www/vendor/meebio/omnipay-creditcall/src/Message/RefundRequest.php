<?php

namespace Omnipay\Creditcall\Message;

use SimpleXMLElement;

class RefundRequest extends AbstractRequest
{
    /**
     * @return string
     */
    public function getAction()
    {
        return 'Refund';
    }

    /**
     * @return SimpleXMLElement
     */
    public function getData()
    {
        $data = $this->getBaseData();

        $transactionDetails = $data->TransactionDetails[0];
        $transactionDetails->addChild('CardEaseReference', $this->getTransactionReference());
        if (!is_null($this->getAmount())) {
            $amount = $transactionDetails->addChild('Amount', $this->getAmount());
            $amount->addAttribute('unit', 'major');
        }

        return $data;
    }
}
