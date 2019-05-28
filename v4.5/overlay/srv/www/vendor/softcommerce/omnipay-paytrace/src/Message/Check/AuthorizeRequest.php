<?php

namespace Omnipay\Paytrace\Message\Check;

class AuthorizeRequest extends AbstractRequest
{
    protected $method = 'ProcessCheck';
    protected $type = 'Hold';

    /**
     * @inheritdoc
     */
    public function getData()
    {
        $this->validate('amount', 'check');
        $check = $this->getCheck();
        $check->validate();
        $data = $this->getBaseData();
        $data['DDA'] = $check->getBankAccount();
        $data['TR'] = $check->getRoutingNumber();
        $data['AMOUNT'] = $this->getAmount();
        if ($this->getTestMode()) {
            $data['TEST'] = 'Y';
        }
        return array_merge($data, $this->getBillingData());
    }
}
