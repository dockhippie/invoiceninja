<?php
namespace Omnipay\Neteller\Message;

/**
 * Neteller Net Direct Request
 *
 * NETTELER Direct allows you to integrate NETELLER payment services into your merchant
 * site or application. Once you have completed the integration process, you will be able
 * to automatically accept NETELLER payments directly on your site or application.
 *
 * @author Joao Dias <joao.dias@cherrygroup.com>
 * @copyright 2014 Cherry Ltd.
 * @license http://opensource.org/licenses/mit-license.php MIT
 * @version 4.1.9 NETELLER Direct API Specification
 */
class NetDirectRequest extends AbstractRequest
{
    /**
     * {@inheritdoc}
     */
    protected function getVersion()
    {
        return '4.1';
    }

    /**
     * {@inheritdoc}
     */
    protected function getMethod()
    {
        return 'netdirect';
    }

    /**
     * Get the name of the merchant site, where the member is transacting.
     *
     * @return string merchant name
     */
    public function getMerchantName()
    {
        return $this->getParameter('merchantName');
    }

    /**
     * Set the name of the merchant site, where the member is transacting.
     *
     * This optional variable can be up to 50 characters in length and will support
     * language encodings. If provided, this variable will be displayed on the error
     * resolution pages.
     *
     * @param  string $value merchant name
     * @return self
     */
    public function setMerchantName($value)
    {
        return $this->setParameter('merchantName', $value);
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
     * Get the member's 6-digit Secure ID that was assigned when they created their
     * NETELLER account.
     *
     * @return int secure id
     */
    public function getSecureId()
    {
        return $this->getParameter('secureId');
    }

    /**
     * Set the member's 6-digit Secure ID that was assigned when they created their
     * NETELLER account.
     *
     * @param  int $value secure id
     * @return self
     */
    public function setSecureId($value)
    {
        return $this->setParameter('secureId', (int) $value);
    }

    /**
     * Get the 2-letter language code that indicates the member's language preference.
     *
     * @return string language code
     */
    public function getLanguageCode()
    {
        return $this->getParameter('languageCode');
    }

    /**
     * Set the 2-letter language code that indicates the member's language preference.
     *
     * Please note that NETELLER supports English (EN), Simplified Chinese (ZH),
     * Danish (DA), French (FR), German (DE), Italian (IT), Japanese (JA), Spanish (ES),
     * Swedish (SV), and Turkish (TR). If a language is not specified or supported and a
     * transaction results in an error, the error message will be returned in English.
     *
     * @param  string $value language code
     * @return self
     */
    public function setLanguageCode($value)
    {
        return $this->setParameter('languageCode', $value);
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
            'account',
            'secureId',
            'transactionId',
            'amount',
            'currency'
        );

        $data['amount'] = $this->getAmount();
        $data['net_account'] = $this->getAccount();
        $data['secure_id'] = $this->getSecureId();
        $data['merch_transid'] = $this->getTransactionId();
        $data['currency'] = $this->getCurrency();
        $data['language_code'] = $this->getLanguageCode();
        $data['merch_name'] = $this->getMerchantName();
        $data['merch_account'] = $this->getMerchantAccount();

        $customValues = $this->getCustomValues();
        if (is_array($customValues)) {
            for ($i = 1; $i <= count($customValues); $i++) {
                $data['custom_' . $i] = $customValues[$i - 1];
            }
        }

        return $data;
    }
}
