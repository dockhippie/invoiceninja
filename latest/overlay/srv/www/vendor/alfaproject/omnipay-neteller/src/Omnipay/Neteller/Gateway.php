<?php
namespace Omnipay\Neteller;

use Omnipay\Common\AbstractGateway;

/**
 * Neteller Gateway
 *
 * @author Joao Dias <joao.dias@cherrygroup.com>
 * @copyright 2014 Cherry Ltd.
 * @license http://opensource.org/licenses/mit-license.php MIT
 * @version 1.0.0
 */
class Gateway extends AbstractGateway
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Neteller';
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultParameters()
    {
        return array(
            'merchantId' => 0,
            'merchantKey' => '',
            'testMode'  => false,
        );
    }

    /**
     * Get the Merchant ID you were assigned when your NETELLER merchant account was
     * created.
     *
     * @return string merchant id
     */
    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    /**
     * Set the Merchant ID you were assigned when your NETELLER merchant account was
     * created.
     *
     * @param  string $value merchant id
     * @return self
     */
    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    /**
     * Get the Merchant Key you were assigned when your NETELLER merchant account was
     * created.
     *
     * @return string merchant key
     */
    public function getMerchantKey()
    {
        return $this->getParameter('merchantKey');
    }

    /**
     * Set the Merchant Key you were assigned when your NETELLER merchant account was
     * created.
     *
     * If you have generated a new Merchant Key, the most recent Merchant Key is to be
     * used.
     *
     * @param  string $value merchant key
     * @return self
     */
    public function setMerchantKey($value)
    {
        return $this->setParameter('merchantKey', $value);
    }

    /**
     * Get the password you use to enter your NETELLER merchant account.
     *
     * @return string merchant password
     */
    public function getMerchantPassword()
    {
        return $this->getParameter('merchantPassword');
    }

    /**
     * Set the password you use to enter your NETELLER merchant account.
     *
     * This variable is case-sensitive.
     *
     * @param  string $value merchant password
     * @return self
     */
    public function setMerchantPassword($value)
    {
        return $this->setParameter('merchantPassword', $value);
    }

    /**
     * Create a new charge.
     *
     * @param  array                      $parameters  request parameters
     * @return Message\NetDirectResponse               response
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('Omnipay\Neteller\Message\NetDirectRequest', $parameters);
    }

    /**
     * Make a payment to a member.
     *
     * @param  array                          $parameters  request parameters
     * @return Message\InstantPayoutResponse               response
     */
    public function payout(array $parameters = array())
    {
        return $this->createRequest('Omnipay\Neteller\Message\InstantPayoutRequest', $parameters);
    }
}
