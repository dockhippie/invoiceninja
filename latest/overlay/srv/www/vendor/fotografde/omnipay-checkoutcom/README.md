# Omnipay: Checkout.com

**Checkout.com driver for the Omnipay PHP payment processing library**

[![Build Status](https://travis-ci.org/fotografde/omnipay-checkoutcom.png?branch=master)](https://travis-ci.org/fotografde/omnipay-checkoutcom)
[![Latest Stable Version](https://poser.pugx.org/fotografde/omnipay-checkoutcom/v/stable)](https://packagist.org/packages/fotografde/omnipay-checkoutcom)
[![Total Downloads](https://poser.pugx.org/fotografde/omnipay-checkoutcom/downloads)](https://packagist.org/packages/fotografde/omnipay-checkoutcom)
[![License](https://poser.pugx.org/fotografde/omnipay-checkoutcom/license)](https://packagist.org/packages/fotografde/omnipay-checkoutcom)

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements Checkout.com support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "fotografde/omnipay-checkoutcom": "~2.0"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Basic Usage

The following gateways are provided by this package:

* [Checkout.com](https://checkout.com/)

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

### Checkout.js

Currently this package provides implementation of 2 workflows:

#### 1. Authorize payment and then capture

The Checkout.com integration is fairly straight forward.
Essentially you just pass the order data and receive a payment token, which you
can use in the checkout.js payment form. After your customer has entered his data, you'll receive
another token, which you can use to capture the payment.

Start by following the standard Checkout.com JS guide here:
[http://sandbox.checkout.com/js/v1/docs/Checkout.js_Manual_Sandbox.pdf](http://sandbox.checkout.com/js/v1/docs/Checkout.js_Manual_Sandbox.pdf)

Full documentation of the API can be found here:
[https://www.checkout.com/docs/sandbox/api/integration-guide/introduction](https://www.checkout.com/docs/sandbox/api/integration-guide/introduction)

First Authorize:
```php
$response = $gateway->purchase(['amount' => $amount, 'currency' => $currency])->send();
if ($response->isRedirect()) {
    $token = $response->getTransactionReference();
}
```

Then Capture:
```php
$response = $gateway->completePurchase(['amount' => $amount, 'transactionReference' => $token])->send();
if ($response->isSuccessful()) {
    // approve Order
}
```

#### 2. Payment with card token (card token purchase)

- In this method we first validate card data via form and js provided from Checkout.com, see [https://docs.checkout.com/getting-started/checkoutkit-js](https://docs.checkout.com/getting-started/checkoutkit-js)
- After card is validated, we receive card token ([https://docs.checkout.com/getting-started/checkoutkit-js#example](https://docs.checkout.com/getting-started/checkoutkit-js#example))
- in the final step we complete payment providing order data and a card token:
```php
$response = $gateway->cardTokenPurchase([
    'amount' => $amount, 
    'currency' => $currency, 
    'email' => 'customer@email.com', 
    'cardToken' => 'some_token', 
    'description' => 'some nice description'
]);
```

Note that `amount`, `currency`, `email` and `cardToken` are required fields here.

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/fotografde/omnipay-checkoutcom/issues),
or better yet, fork the library and submit a pull request.
