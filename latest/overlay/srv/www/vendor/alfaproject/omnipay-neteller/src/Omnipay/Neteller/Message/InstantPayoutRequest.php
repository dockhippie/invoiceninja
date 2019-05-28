<?php
namespace Omnipay\Neteller\Message;

/**
 * Neteller Instant Payout Request
 *
 * NETTELER Instant Payouts enable you to make payments to NETELLER members directly from
 * your merchant site or application.
 *
 * The Instant Payouts API can be used in conjunction with NETELLER Mass Payments.
 * Contact Optimal Payment Merchant Support team for more information about how they can
 * be used together.
 *
 * @author Joao Dias <joao.dias@cherrygroup.com>
 * @copyright 2014 Cherry Ltd.
 * @license http://opensource.org/licenses/mit-license.php MIT
 * @version 4.0.8 NETELLER Instant Payouts API Specification
 */
class InstantPayoutRequest extends AbstractRequest
{
    /**
     * {@inheritdoc}
     */
    protected function getVersion()
    {
        return '4.0';
    }

    /**
     * {@inheritdoc}
     */
    protected function getMethod()
    {
        return 'instantpayout';
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
     * Get the value that can be used to include information that will be echoed back to
     * you in the "Account" column of the transfers table in your merchant account.
     *
     * @return string merchant account
     */
    public function getMerchantAccount()
    {
        return $this->getParameter('merchantAccount');
    }

    /**
     * Set the value that can be used to include information that will be echoed back to
     * you in the "Account" column of the transfers table in your merchant account.
     *
     * You can use this to assist in reconciling your transactions (e.g. a member's
     * account identification on your site, your site's transaction ID, etc.).
     * You can send up to 50 characters for this variable.
     *
     * @param  string $value merchant account
     * @return self
     */
    public function setMerchantAccount($value)
    {
        return $this->setParameter('merchantAccount', $value);
    }

    /**
     * Get the member's 12-digit Account ID OR email address that is associated with
     * their NETELLER account.
     *
     * @return string account
     */
    public function getAccount()
    {
        return $this->getParameter('account');
    }

    /**
     * Get the member's 12-digit Account ID OR email address that is associated with
     * their NETELLER account.
     *
     * NOTE: NETELLER Account IDs begin with "45" and NETELLER (1-PAY) Account IDs begin
     * with "88". NETELLER (1-PAY) merchants must supply the account number, email is NOT
     * supported for this transaction system.
     *
     * @param  string $value account
     * @return self
     */
    public function setAccount($value)
    {
        return $this->setParameter('account', $value);
    }

    /**
     * Get the optional parameters that can be sent for any variables you need to add.
     * These variables are echoed back to you.
     *
     * @return array custom values
     */
    public function getCustomValues()
    {
        return $this->getParameter('customValues');
    }

    /**
     * Get the optional parameters that can be sent for any variables you need to add.
     * These variables are echoed back to you.
     *
     * These variables can be up to 50 characters in length.
     *
     * @param  array $value custom values
     * @return self
     */
    public function setCustomValues(array $value)
    {
        return $this->setParameter('customValues', $value);
    }

    /**
     * Get the data for this request.
     *
     * @return array request data
     */
    public function getData()
    {
        $data = parent::getData();

        $this->validate(
            'merchantPassword',
            'account',
            'transactionId',
            'amount',
            'currency'
        );

        $data['amount'] = $this->getAmount();
        $data['currency'] = $this->getCurrency();
        $data['merch_pass'] = $this->getMerchantPassword();
        $data['merch_transid'] = $this->getTransactionId();
        $data['merch_account'] = $this->getMerchantAccount();
        $data['net_account'] = $this->getAccount();

        $customValues = $this->getCustomValues();
        if (is_array($customValues)) {
            for ($i = 1; $i <= count($customValues); $i++) {
                $data['custom_' . $i] = $customValues[$i - 1];
            }
        }

        return $data;
    }
}
