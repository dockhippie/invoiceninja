<?php
/**
 * MultiCards REST Authorize Request
 */

namespace Omnipay\Multicards\Message;

/**
 * MultiCards REST Authorize Request using the Order API
 *
 * Route: https://secure.multicards.com/cgi-bin/order2/poauto3.pl
 *
 * Method: POST
 *
 * ### Examples
 *
 * This is an extension of PurchaseRequest.  For all examples see there.
 *
 * @see Omnipay\Multicards\PurchaseRequest
 * @link https://www.multicards.com/en/support/merchant_integration_guide.html#orderapi
 * @link https://www.multicards.com/en/support/orderpage-card-customer-variables.html
 */
class AuthorizeRequest extends PurchaseRequest
{

    /**
     * getData
     *
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidCreditCardException
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $data = parent::getData();
        $data['auth_only'] = 1;
        return $data;
    }
}
