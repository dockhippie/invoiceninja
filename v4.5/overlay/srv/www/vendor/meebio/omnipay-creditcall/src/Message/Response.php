<?php

namespace Omnipay\Creditcall\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Response
 */
class Response extends AbstractResponse
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return isset($this->data->Result->LocalResult) && ((string)$this->data->Result->LocalResult) === '0';
    }

    /**
     * @return bool
     */
    public function isRedirect()
    {
        return false;
    }

    /**
     * @return null|string
     */
    public function getTransactionReference()
    {
        return isset($this->data->TransactionDetails->CardEaseReference) ?
            (string)$this->data->TransactionDetails->CardEaseReference : null;
    }

    /**
     * @return null|string
     */
    public function getMessage()
    {
        if (!isset($this->data->Result->Errors)) {
            return null;
        }

        $errors = array();
        foreach ((array)$this->data->Result->Errors as $error) {
            $error = (string)$error;
            if ($error !== '') {
                $errors[] = $error;
            }
        }

        return count($errors) > 0 ? implode(' ', $errors) : null;
    }

    /**
     * @return null|string
     */
    public function getCardReference()
    {
        return isset($this->data->CardDetails->CardReference) ? (string)$this->data->CardDetails->CardReference : null;
    }

    /**
     * @return null|string
     */
    public function getCardHash()
    {
        return isset($this->data->CardDetails->CardHash) ? (string)$this->data->CardDetails->CardHash : null;
    }
}
