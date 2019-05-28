<?php
namespace Omnipay\Neteller\Message;

use DateTime;

/**
 * Neteller Net Direct Response
 *
 * @author Joao Dias <joao.dias@cherrygroup.com>
 * @copyright 2014 Cherry Ltd.
 * @license http://opensource.org/licenses/mit-license.php MIT
 * @version 4.1.9 NETELLER Direct API Specification
 */
class NetDirectResponse extends AbstractResponse
{
    /**
     * Get the total amount of the transfer as it was requested.
     *
     * The amount will be greater than 0.01 units of currency in the supported currency
     * and may have decimal places, but no currency symbols.
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
     * Coordinated Universal Time (UTC) is the time standard by which NETELLER processes
     * all transactions.
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
     * Get the total fee charged for the transfer.
     *
     * @deprecated 4.1.9 Use getFee() instead.
     * @return string total fee
     */
    public function getTotalFee()
    {
        return (string) $this->data->total_fee;
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
     * Get the email address of the member who made the transaction.
     *
     * @return string customer email
     */
    public function getCustomerEmail()
    {
        return (string) $this->data->email;
    }

    /**
     * Get the 3-letter currency code associated with the amount taken from the member's
     * NETELLER account.
     *
     * @return string customer currency
     */
    public function getCustomerCurrency()
    {
        return (string) $this->data->client_currency;
    }

    /**
     * Get the amount taken from the member in the currency of their NETELLER account.
     *
     * The amount will be at least 0.01 units of currency for all the supported
     * currencies and may have decimal places, except Hungarian Forint (HUF) and Japanese
     * Yen (JPY), but no currency symbols. NOTE: if a decimal is submitted for HUF or JPY
     * transactions, a 1003 error will result.
     *
     * @return string customer amount
     */
    public function getCustomerAmount()
    {
        return (string) $this->data->client_amount;
    }

    /**
     * Get the 3-letter currency code associated with the amount moved to the merchant
     * account.
     *
     * @return string merchant currency
     */
    public function getMerchantCurrency()
    {
        return (string) $this->data->merchant_currency;
    }

    /**
     * Get the amount moved to the merchant account in the currency of the merchant
     * account.
     *
     * The amount will be at least 0.01 units of currency or equivalent and may have
     * decimal places but not currency symbols.
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
