# InvoiceNinja

[![](https://badge.imagelayers.io/webhippie/invoiceninja:latest.svg)](https://imagelayers.io/?images=webhippie/invoiceninja:latest 'Get your own badge on imagelayers.io')

These are docker images for InvoiceNinja with Caddy running on an
[PHP container](https://registry.hub.docker.com/u/webhippie/php-caddy/).


## Usage

```bash
docker run -ti \
  --name invoiceninja \
  webhippie/invoiceninja:latest
```


## Versions

* [latest](https://github.com/dockhippie/invoiceninja/tree/master)
  available as ```webhippie/invoiceninja:latest``` at
  [Docker Hub](https://registry.hub.docker.com/u/webhippie/invoiceninja/)
* [2.4.9](https://github.com/dockhippie/invoiceninja/tree/2.4.9)
  available as ```webhippie/invoiceninja:2.4.9``` at
  [Docker Hub](https://registry.hub.docker.com/u/webhippie/invoiceninja/)
* [2.4.8](https://github.com/dockhippie/invoiceninja/tree/2.4.8)
  available as ```webhippie/invoiceninja:2.4.8``` at
  [Docker Hub](https://registry.hub.docker.com/u/webhippie/invoiceninja/)
* [2.4.7](https://github.com/dockhippie/invoiceninja/tree/2.4.7)
  available as ```webhippie/invoiceninja:2.4.7``` at
  [Docker Hub](https://registry.hub.docker.com/u/webhippie/invoiceninja/)
* [2.4.6](https://github.com/dockhippie/invoiceninja/tree/2.4.6)
  available as ```webhippie/invoiceninja:2.4.6``` at
  [Docker Hub](https://registry.hub.docker.com/u/webhippie/invoiceninja/)
* [2.4.5](https://github.com/dockhippie/invoiceninja/tree/2.4.5)
  available as ```webhippie/invoiceninja:2.4.5``` at
  [Docker Hub](https://registry.hub.docker.com/u/webhippie/invoiceninja/)
* [2.4.4](https://github.com/dockhippie/invoiceninja/tree/2.4.4)
  available as ```webhippie/invoiceninja:2.4.4``` at
  [Docker Hub](https://registry.hub.docker.com/u/webhippie/invoiceninja/)
* [2.4.3](https://github.com/dockhippie/invoiceninja/tree/2.4.3)
  available as ```webhippie/invoiceninja:2.4.3``` at
  [Docker Hub](https://registry.hub.docker.com/u/webhippie/invoiceninja/)
* [2.4.2](https://github.com/dockhippie/invoiceninja/tree/2.4.2)
  available as ```webhippie/invoiceninja:2.4.2``` at
  [Docker Hub](https://registry.hub.docker.com/u/webhippie/invoiceninja/)
* [2.4.1](https://github.com/dockhippie/invoiceninja/tree/2.4.1)
  available as ```webhippie/invoiceninja:2.4.1``` at
  [Docker Hub](https://registry.hub.docker.com/u/webhippie/invoiceninja/)
* [2.4.0](https://github.com/dockhippie/invoiceninja/tree/2.4.0)
  available as ```webhippie/invoiceninja:2.4.0``` at
  [Docker Hub](https://registry.hub.docker.com/u/webhippie/invoiceninja/)


## Available environment variables

```bash
ENV INVOICENINJA_APP_ENV production
ENV INVOICENINJA_APP_DEBUG false
ENV INVOICENINJA_APP_URL http://localhost
ENV INVOICENINJA_APP_CIPHER rijndael-128
ENV INVOICENINJA_APP_KEY # gets generated if not provided
ENV INVOICENINJA_DB_TYPE mysql # can also be sqlite or pgsql
ENV INVOICENINJA_DB_HOST mysql # postgres for pgsql
ENV INVOICENINJA_DB_DATABASE ninja # /storage/database.sqlite3 for sqlite
ENV INVOICENINJA_DB_USERNAME root
ENV INVOICENINJA_DB_PASSWORD root
ENV INVOICENINJA_DB_PREFIX
ENV INVOICENINJA_DB_CHARSET utf8
ENV INVOICENINJA_DB_STRICT false # used by mysql
ENV INVOICENINJA_DB_COLLATION utf8_unicode_ci # used by mysql
ENV INVOICENINJA_DB_SCHEMA public # used by pgsql
ENV INVOICENINJA_MAIL_DRIVER smtp
ENV INVOICENINJA_MAIL_PORT 587
ENV INVOICENINJA_MAIL_ENCRYPTION tls
ENV INVOICENINJA_MAIL_HOST
ENV INVOICENINJA_MAIL_USERNAME
ENV INVOICENINJA_MAIL_ADDRESS invoiceninja@localhost
ENV INVOICENINJA_MAIL_NAME Invoiceninja
ENV INVOICENINJA_MAIL_PASSWORD
ENV INVOICENINJA_PHANTOMJS_CLOUD_KEY
ENV INVOICENINJA_LOG single
ENV INVOICENINJA_REQUIRE_HTTPS false
ENV INVOICENINJA_GITHUB_CLIENT_ID
ENV INVOICENINJA_GITHUB_CLIENT_SECRET
ENV INVOICENINJA_GOOGLE_CLIENT_ID
ENV INVOICENINJA_GOOGLE_CLIENT_SECRET
ENV INVOICENINJA_FACEBOOK_CLIENT_ID
ENV INVOICENINJA_FACEBOOK_CLIENT_SECRET
ENV INVOICENINJA_LINKEDIN_CLIENT_ID
ENV INVOICENINJA_LINKEDIN_CLIENT_SECRET
```


## Inherited environment variables

```bash
ENV PHP_MEMORY_LIMIT 512M
ENV PHP_POST_MAX_SIZE 2G
ENV PHP_UPLOAD_MAX_FILESIZE 2G
ENV PHP_MAX_EXECUTION_TIME 3600
ENV PHP_MAX_INPUT_TIME 3600
ENV PHP_DATE_TIMEZONE UTC
```

```bash
ENV LOGSTASH_ENABLED false
ENV LOGSTASH_HOST logstash
ENV LOGSTASH_PORT 5043
ENV LOGSTASH_CA /etc/ssl/logstash/certs/ca.pem # As string or filename
ENV LOGSTASH_CERT /etc/ssl/logstash/certs/cert.pem # As string or filename
ENV LOGSTASH_KEY /etc/ssl/logstash/private/cert.pem # As string or filename
ENV LOGSTASH_TIMEOUT 15
ENV LOGSTASH_OPTS
```


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
