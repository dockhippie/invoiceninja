# Omnipay: Dwolla

**Dwolla off-site gateway support for the Omnipay PHP payment processing library**

[![Build Status](https://travis-ci.org/Dwolla/omnipay-dwolla.svg)](https://travis-ci.org/Dwolla/omnipay-dwolla)

[Omnipay](https://github.com/omnipay/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements Dwolla support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). omnipay-dwolla is currently not a part
of the official Omnipay branch; we are working on this.

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Basic Usage

The following gateways are provided by this package:

* Dwolla (off-site gateway)

For general usage instructions, please see the main [Omnipay](https://github.com/omnipay/omnipay)
repository.

[Dwolla API documentation is available here.](https://developers.dwolla.com/dev/pages/gateway#server-to-server)

----

In order to get started, first [obtain Dwolla API credentials](https://developers.dwolla.com/dev/pages/guides/create_application)

### Initiating a Checkout

Off-site gateway checkouts are initiated by calling the `purchase()` method. 
```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('Dwolla');

$gateway->setKey('An API key!');
$gateway->setSecret('Shh!');
$gateway->setDestinationId('812-111-1234');
$gateway->setReturnUrl('http://your-sweet-app.net/handle_redirect');

// Want sandbox mode?
// $gateway->setSandbox(true);

$response = $gateway->purchase(['amount' => '10.00'])->send();

if ($response->isRedirect()) {
    // Redirect to Dwolla
    $response->redirect();
} else {
    // Something went wrong!
    echo $response->getMessage();
}
```

### Retrieving an already created checkout

If your application would like to retrieve old checkouts, `omnipay-dwolla` allows you to do so via the `capture()` method. This somewhat falls ambiguously under OmniPay convention as we also return checkouts which have failed, i.e, which have not been successfully authorized by the user redirected to the off-site gateway.

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('Dwolla');

$gateway->setKey('An API key!');
$gateway->setSecret('Shh!');

// Want sandbox mode?
// $gateway->setSandbox(true);

$checkout = $gateway->capture(['transactionReference' => 'c271d65c-7b71-421f-a80f-8682bb2ce2c4'])->send();
```

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/Dwolla/omnipay-dwolla/issues),
or better yet, fork the library and submit a pull request.
