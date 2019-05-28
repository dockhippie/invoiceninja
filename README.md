# InvoiceNinja

[![Build Status](https://cloud.drone.io/api/badges/dockhippie/invoiceninja/status.svg)](https://cloud.drone.io/dockhippie/invoiceninja)
[![](https://images.microbadger.com/badges/image/webhippie/invoiceninja.svg)](https://microbadger.com/images/webhippie/invoiceninja "Get your own image badge on microbadger.com")

These are docker images for [InvoiceNinja](https://www.invoiceninja.com/) running on an [PHP Caddy container](https://registry.hub.docker.com/u/webhippie/php-caddy/).


## Versions

* [latest](./latest) available as `webhippie/invoiceninja:latest`


## Volumes

* /var/lib/invoiceninja


## Ports

* 8080


## Available environment variables

```bash
INVOICENINJA_APP_CIPHER = rijndael-128
INVOICENINJA_APP_DEBUG = false
INVOICENINJA_APP_ENV = production
INVOICENINJA_APP_KEY =
INVOICENINJA_APP_KEY = UTC
INVOICENINJA_APP_LOCALE = en
INVOICENINJA_APP_TIMEZONE = UTC
INVOICENINJA_APP_URL = http://localhost
INVOICENINJA_BASE_DIR = /var/lib/invoiceninja
INVOICENINJA_DB_CHARSET = utf8
INVOICENINJA_DB_COLLATION = utf8_general_ci
INVOICENINJA_DB_DATABASE =
INVOICENINJA_DB_DATABASE = ${INVOICENINJA_BASE_DIR}/database.sqlite3
INVOICENINJA_DB_DATABASE = ninja
INVOICENINJA_DB_HOST =
INVOICENINJA_DB_HOST = mysql
INVOICENINJA_DB_HOST = postgres
INVOICENINJA_DB_PASSWORD =
INVOICENINJA_DB_PASSWORD = root
INVOICENINJA_DB_PREFIX =
INVOICENINJA_DB_PREFIX = utf8
INVOICENINJA_DB_SCHEMA = public
INVOICENINJA_DB_STRICT =
INVOICENINJA_DB_STRICT = false
INVOICENINJA_DB_TYPE = mysql
INVOICENINJA_DB_USERNAME =
INVOICENINJA_DB_USERNAME = root
INVOICENINJA_FACEBOOK_CLIENT_ID =
INVOICENINJA_FACEBOOK_CLIENT_SECRET =
INVOICENINJA_GITHUB_CLIENT_ID =
INVOICENINJA_GITHUB_CLIENT_SECRET =
INVOICENINJA_GOOGLE_CLIENT_ID =
INVOICENINJA_GOOGLE_CLIENT_SECRET =
INVOICENINJA_LINKEDIN_CLIENT_ID =
INVOICENINJA_LINKEDIN_CLIENT_SECRET =
INVOICENINJA_LOG = single
INVOICENINJA_MAIL_ADDRESS = invoiceninja@localhost
INVOICENINJA_MAIL_DRIVER = smtp
INVOICENINJA_MAIL_ENCRYPTION = tls
INVOICENINJA_MAIL_HOST = localhosr
INVOICENINJA_MAIL_NAME = Invoiceninja
INVOICENINJA_MAIL_PASSWORD =
INVOICENINJA_MAIL_PORT = 587
INVOICENINJA_MAIL_USERNAME =
INVOICENINJA_PHANTOMJS_CLOUD_KEY =
INVOICENINJA_REQUIRE_HTTPS = false
```


## Inherited environment variables

* [webhippie/php-caddy](https://github.com/dockhippie/php/tree/master/caddy#available-environment-variables)
* [webhippie/caddy](https://github.com/dockhippie/caddy#available-environment-variables)
* [webhippie/alpine](https://github.com/dockhippie/alpine#available-environment-variables)


## Contributing

Fork -> Patch -> Push -> Pull Request


## Authors

* [Thomas Boerger](https://github.com/tboerger)


## License

MIT


## Copyright

```
Copyright (c) 2015 Thomas Boerger <http://www.webhippie.de>
```
