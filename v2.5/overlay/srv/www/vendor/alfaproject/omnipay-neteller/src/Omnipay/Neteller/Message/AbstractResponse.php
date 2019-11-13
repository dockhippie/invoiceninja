<?php
namespace Omnipay\Neteller\Message;

/**
 * Neteller Abstract Response
 *
 * @author Joao Dias <joao.dias@cherrygroup.com>
 * @copyright 2014 Cherry Ltd.
 * @license http://opensource.org/licenses/mit-license.php MIT
 * @version 1.0.0
 */
abstract class AbstractResponse extends \Omnipay\Common\Message\AbstractResponse
{
    /**
     * Is the response successful?
     *
     * @return boolean is successful
     */
    public function isSuccessful()
    {
        return $this->data->approval == 'yes';
    }

    /**
     * Get the echo of original variables.
     *
     * @return array custom values
     */
    public function getCustomValues()
    {
        return array(
            (string) $this->data->custom_1,
            (string) $this->data->custom_2,
            (string) $this->data->custom_3,
        );
    }

    /**
     * Get the error code.
     *
     * @return int error code
     */
    public function getCode()
    {
        return (int) $this->data->error;
    }

    /**
     * Get the error message.
     *
     * @return string error message
     */
    public function getMessage()
    {
        if (!empty($this->data->error_message)) {
            return $this->data->error_message;
        }

        $errors = array(
            0    => 'Approved.',

            // Net Direct
            1004 => 'Invalid \'merchantId\' or \'merchantKey\'.',
            1009 => 'The member\'s NETELLER account has been temporarily suspended.',
            1015 => 'Invalid currency. Your NETELLER Merchant Account does not support this currency.',
            1105 => 'Your request was not authorized. Please verify your account API security settings.',

            // Instant Payout
            3007 => 'Invalid \'merchantId\', \'merchantKey\' or \'merchantPassword\'.',
            3011 => 'Invalid NETELLER member AccountID/Email, or the account cannot accept payouts.',
            3013 => 'Specified amount is too high. You must specify an amount within your transactional limit.',
            3016 => 'Insufficient funds for payout.',
            3105 => 'Your request was not authorized. Please verify your account API security settings.',
        );

        return isset($errors[$this->getCode()])
            ? $errors[$this->getCode()]
            : null;
    }
}
