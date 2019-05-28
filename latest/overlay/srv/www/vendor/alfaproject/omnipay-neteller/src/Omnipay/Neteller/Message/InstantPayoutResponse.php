<?php
namespace Omnipay\Neteller\Message;

use DateTime;

/**
 * Neteller Instant Payout Response
 *
 * @author Joao Dias <joao.dias@cherrygroup.com>
 * @copyright 2014 Cherry Ltd.
 * @license http://opensource.org/licenses/mit-license.php MIT
 * @version 4.0.8 NETELLER Instant Payouts API Specification
 */
class InstantPayoutResponse extends AbstractResponse
{
    /**
     * Get the total amount of the transfer as it was requested.
     *
     * The amount will be greater than 1 unit of currency in the supported currency and
     * may have decimal places, but no currency symbols.
     *
     * @return string amount
     */
    public function getAmount()
    {
        return (string) $this->data->amount;
    }

    /**
     * Get the unique ID that identifies the transaction in the NETELLER system.
     *
     * This will be used to validate the transaction.
     *
     * @return string transaction reference
     */
    public function getTransactionReference()
    {
        return (string) $this->data->trans_id;
    }

    /**
     * Get the date and time the transaction took place.
     *
     * @return DateTime transaction time
     */
    public function getTransactionTime()
    {
        $odbcTimestamp = (string) $this->data->time;
        $firstApostrophe = strpos($odbcTimestamp, '\'') + 1;
        return new DateTime(substr($odbcTimestamp, $firstApostrophe, strrpos($odbcTimestamp, '\'') - $firstApostrophe));
    }

    /**
     * Get the fee charged for the transfer.
     *
     * @return string fee
     */
    public function getFee()
    {
        return (string) $this->data->fee;
    }

    /**
     * Get the first name, or given name, of the member who made the transaction.
     *
     * @return string customer first name
     */
    public function getCustomerFirstName()
    {
        return (string) $this->data->firstname;
    }

    /**
     * Get the last name, or family name, of the member who made the transaction.
     *
     * @return string customer last name
     */
    public function getCustomerLastName()
    {
        return (string) $this->data->lastname;
    }

    /**
     * Get the 3-letter currency code associated with the amount moved to the member's
     * NETELLER account.
     *
     * @return string customer currency
     */
    public function getCustomerCurrency()
    {
        return (string) $this->data->client_currency;
    }

    /**
     * Get the amount moved to the member in the currency of their NETELLER account.
     *
     * The amount will be greater than 0, will be within the merchant's transfer limit,
     * and may have decimal places but no currency symbols.
     *
     * @return string customer amount
     */
    public function getCustomerAmount()
    {
        return (string) $this->data->client_amount;
    }

    /**
     * Get the 3-letter currency code associated with the amount moved from the merchant
     * account.
     *
     * @return string merchant currency
     */
    public function getMerchantCurrency()
    {
        return (string) $this->data->merchant_currency;
    }

    /**
     * Get the amount transferred from the merchant in the currency of the merchant's
     * account.
     *
     * The amount will be greater than 0, will be within the merchant's transfer limit,
     * and may have decimal places but no currency symbols.
     *
     * @return string merchant amount
     */
    public function getMerchantAmount()
    {
        return (string) $this->data->merchant_amount;
    }

    /**
     * Get the foreign exchange rate applied to the transaction.
     *
     * @return string foreign exchange rate
     */
    public function getForeignExchangeRate()
    {
        return (string) $this->data->fxrate;
    }
}
