<?php

namespace Omnipay\PagSeguro\Message;

use Omnipay\Common\Message\AbstractResponse;

class FindTransactionResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return isset($this->data['error']) ? false : true;
    }
}
