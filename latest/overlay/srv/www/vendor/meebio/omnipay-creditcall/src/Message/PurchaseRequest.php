<?php

namespace Omnipay\Creditcall\Message;

use SimpleXMLElement;

class PurchaseRequest extends AuthorizeRequest
{
    /**
     * @return SimpleXMLElement
     */
    public function getData()
    {
        $data = parent::getData();

        $transactionDetails = $data->TransactionDetails[0];
        $messageType        = $transactionDetails->MessageType[0];
        $messageType->addAttribute('autoconfirm', 'true');

        return $data;
    }
}
