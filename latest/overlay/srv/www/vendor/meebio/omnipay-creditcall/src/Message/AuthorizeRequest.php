<?php

namespace Omnipay\Creditcall\Message;

use Omnipay\Common\Exception\InvalidCreditCardException;
use Omnipay\Common\Exception\InvalidRequestException;
use SimpleXMLElement;

/**
 * Authorize Request
 *
 * @method Response send()
 */
class AuthorizeRequest extends AbstractRequest
{
    /**
     * @return string
     */
    public function getAction()
    {
        return 'Auth';
    }

    /**
     * @return SimpleXMLElement
     * @throws InvalidCreditCardException
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $this->validate('amount');

        $data = $this->getBaseData();

        $transactionDetails = $data->TransactionDetails[0];

        $transactionDetails->addChild('Reference', $this->getTransactionId());

        $amount = $transactionDetails->addChild('Amount', $this->getAmount());
        $amount->addAttribute('unit', 'major');
        $transactionDetails->addChild('CurrencyCode', $this->getCurrencyNumeric());

        $cardDetails = $data->addChild('CardDetails');

        $manual = $cardDetails->addChild('Manual');
        $manual->addAttribute('type', 'cnp');

        //If this is a Token payment, add the Token data item, otherwise its a normal card purchase.
        if ($this->getCardReference()) {
            $manual->addChild('CardReference', $this->getCardReference());
            $manual->addChild('CardHash', $this->getCardHash());
        } else {
            $card = $this->getCard();

            $card->validate();

            $manual->addChild('PAN', $card->getNumber());
            $expiryDate = $manual->addChild('ExpiryDate', $card->getExpiryDate('ym'));
            $expiryDate->addAttribute('format', 'yyMM');

            if ($card->getStartMonth() && $card->getStartYear()) {
                $startDate = $manual->addChild('StartDate', $card->getStartDate('ym'));
                $startDate->addAttribute('format', 'yyMM');
            }

            if ($card->getIssueNumber()) {
                $manual->addChild('IssueNumber', $card->getIssueNumber());
            }

            if ($this->getVerifyCvv() || $this->getVerifyAddress() || $this->getVerifyZip()) {
                $additionalVerification = $cardDetails->addChild('AdditionalVerification');

                if ($this->getVerifyCvv()) {
                    $additionalVerification->addChild('CSC', $card->getCvv());
                }

                if ($this->getVerifyAddress()) {
                    $additionalVerification->addChild('Address', $card->getAddress1());
                }

                if ($this->getVerifyZip()) {
                    $additionalVerification->addChild('Zip', $card->getPostcode());
                }
            }

            $this->setBillingCredentials($transactionDetails);
            $this->setShippingCredentials($transactionDetails);
            $this->setCardHolderCredentials($cardDetails);
        }

        return $data;
    }

    /**
     * @param SimpleXMLElement $data
     */
    protected function setBillingCredentials(SimpleXMLElement $data)
    {
        $card = $this->getCard();

        $invoice = $data->addChild('Invoice');
        $address = $invoice->addChild('Address');
        $address->addAttribute('format', 'standard');

        $line1 = $address->addChild('Line', $card->getBillingAddress1());
        $line1->addAttribute('id', 1);

        $line2 = $address->addChild('Line', $card->getBillingAddress2());
        $line2->addAttribute('id', 2);

        $address->addChild('City', $card->getBillingCity());
        $address->addChild('State', $card->getBillingState());
        $address->addChild('ZipCode', $card->getBillingPostcode());
        $address->addChild('Country', $card->getBillingCountry());

        $contact = $invoice->addChild('Contact');
        $name    = $contact->addChild('Name');

        $name->addChild('FirstName', $card->getBillingFirstName());
        $name->addChild('LastName', $card->getBillingLastName());

        $phoneNumberList = $contact->addChild('PhoneNumberList');
        $phoneNumber1    = $phoneNumberList->addChild('PhoneNumber', $card->getBillingPhone());
        $phoneNumber1->addAttribute('id', 1);
        $phoneNumber1->addAttribute('type', 'unknown');
    }

    /**
     * @param SimpleXMLElement $data
     */
    protected function setShippingCredentials(SimpleXMLElement $data)
    {
        $card = $this->getCard();

        $invoice = $data->addChild('Delivery');
        $address = $invoice->addChild('Address');
        $address->addAttribute('format', 'standard');

        $line1 = $address->addChild('Line', $card->getShippingAddress1());
        $line1->addAttribute('id', 1);

        $line2 = $address->addChild('Line', $card->getShippingAddress2());
        $line2->addAttribute('id', 2);

        $address->addChild('City', $card->getShippingCity());
        $address->addChild('State', $card->getShippingState());
        $address->addChild('ZipCode', $card->getShippingPostcode());
        $address->addChild('Country', $card->getShippingCountry());

        $contact = $invoice->addChild('Contact');
        $name    = $contact->addChild('Name');

        $name->addChild('FirstName', $card->getShippingFirstName());
        $name->addChild('LastName', $card->getShippingLastName());

        $phoneNumberList = $contact->addChild('PhoneNumberList');
        $phoneNumber1    = $phoneNumberList->addChild('PhoneNumber', $card->getShippingPhone());
        $phoneNumber1->addAttribute('id', 1);
        $phoneNumber1->addAttribute('type', 'unknown');
    }

    /**
     * @param SimpleXMLElement $data
     */
    protected function setCardHolderCredentials(SimpleXMLElement $data)
    {
        $card = $this->getCard();

        $address = $data->addChild('Address');
        $address->addAttribute('format', 'standard');

        $line1 = $address->addChild('Line', $card->getAddress1());
        $line1->addAttribute('id', 1);

        $line2 = $address->addChild('Line', $card->getAddress2());
        $line2->addAttribute('id', 2);

        $address->addChild('City', $card->getCity());
        $address->addChild('State', $card->getState());
        $address->addChild('ZipCode', $card->getPostcode());
        $address->addChild('Country', $card->getCountry());

        $contact = $data->addChild('Contact');

        $emailAddressList = $contact->addChild('EmailAddressList');
        $emailAddress1    = $emailAddressList->addChild('EmailAddress', $card->getEmail());
        $emailAddress1->addAttribute('id', 1);
        $emailAddress1->addAttribute('type', 'other');

        $name = $contact->addChild('Name');
        $name->addChild('FirstName', $card->getFirstName());
        $name->addChild('LastName', $card->getLastName());

        $phoneNumberList = $contact->addChild('PhoneNumberList');
        $phoneNumber1    = $phoneNumberList->addChild('PhoneNumber', $card->getPhone());
        $phoneNumber1->addAttribute('id', 1);
        $phoneNumber1->addAttribute('type', 'unknown');
    }

    /**
     * @return string
     */
    public function getCardHash()
    {
        return $this->getParameter('cardHash');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setCardHash($value)
    {
        return $this->setParameter('cardHash', $value);
    }

    /**
     * @param string $data
     * @return Response
     */
    protected function createResponse($data)
    {
        return $this->response = new AuthorizeResponse($this, $data);
    }
}
