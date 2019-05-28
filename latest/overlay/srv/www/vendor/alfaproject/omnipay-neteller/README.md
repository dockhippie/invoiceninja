# Omnipay: Neteller

**Neteller driver for the Omnipay PHP payment processing library**

[![Build Status](https://travis-ci.org/alfaproject/omnipay-neteller.png?branch=master)](https://travis-ci.org/alfaproject/omnipay-neteller)
[![Coverage Status](https://coveralls.io/repos/alfaproject/omnipay-neteller/badge.png?branch=master)](https://coveralls.io/r/alfaproject/omnipay-neteller?branch=master)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/alfaproject/omnipay-neteller/badges/quality-score.png?s=dcf9b443507469bb5f65fb6dbeb2f2d3d39c3eeb)](https://scrutinizer-ci.com/g/alfaproject/omnipay-neteller/)
[![Dependency Status](https://www.versioneye.com/user/projects/52e8db95ec13757beb00000c/badge.png)](https://www.versioneye.com/user/projects/52e8db95ec13757beb00000c)

[![Latest Stable Version](https://poser.pugx.org/alfaproject/omnipay-neteller/v/stable.png)](https://packagist.org/packages/alfaproject/omnipay-neteller)
[![Total Downloads](https://poser.pugx.org/alfaproject/omnipay-neteller/downloads.png)](https://packagist.org/packages/alfaproject/omnipay-neteller)
[![Latest Unstable Version](https://poser.pugx.org/alfaproject/omnipay-neteller/v/unstable.png)](https://packagist.org/packages/alfaproject/omnipay-neteller)
[![License](https://poser.pugx.org/alfaproject/omnipay-neteller/license.png)](https://packagist.org/packages/alfaproject/omnipay-neteller)

[Omnipay](https://github.com/omnipay/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements [NETELLER](http://www.neteller.com) support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "alfaproject/omnipay-neteller": "~1.0"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Basic Usage

The following gateways are provided by this package:

* Neteller

For general usage instructions, please see the main [Omnipay](https://github.com/omnipay/omnipay)
repository.

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/alfaproject/omnipay-neteller/issues),
or better yet, fork the library and submit a pull request.
