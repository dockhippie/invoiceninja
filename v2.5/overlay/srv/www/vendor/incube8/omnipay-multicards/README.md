# omnipay-multicards

**MultiCards driver for the Omnipay PHP payment processing library**

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements PaymentWall support for Omnipay.

[MultiCards Internet Billing](https://www.multicards.com/) is a provider of online
credit card and debit card processing and payment solutions to many retailers worldwide.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "incube8/omnipay-multicards": "dev-master"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Basic Usage

The following transactions are provided by this package via the REST API:

* Create a purchase
* Refunding a purchase
* Voiding a purchase

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.  There are also examples in the class API documentation.

### Quirks

There is no createCard message in this gateway.  Tokens are supported by calling getCardReference()
on a purchase result.

Required fields when making a purchase include:

* amount
* currency
* description
* merId
* merUrlIdx
* password

An Omnipay CreditCard object can be provided containing the card data, or you can pass a cardReference
parameter to make a token purchase after making a previously successful card purchase and getting the
token as a response to that.

## Unit Testing

Tests are in the tests folder.  Basic unit tests are in place for most of the code including
mock message responses.

## API Documentation

You can build the API documentation after running composer update, by using this command
(on Linux/Unix systems):

```
./makedoc.sh
```

The API documentation will be built in documents/main in HTML format.

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.
