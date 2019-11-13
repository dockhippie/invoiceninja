#!/bin/bash

pushd /srv/www > /dev/null
  echo "> clear compiled assets"
  su-exec \
    caddy \
    /usr/bin/php \
    artisan \
    clear-compiled -n -q

  echo "> compile new assets"
  su-exec \
    caddy \
    /usr/bin/php \
    artisan \
    optimize -n -q

  echo "> execute migrate install"
  su-exec \
    caddy \
    /usr/bin/php \
    artisan \
    migrate:install -n -q

  echo "> execute db migrations"
  su-exec \
    caddy \
    /usr/bin/php \
    artisan \
    migrate -n -q --force --seed
popd > /dev/null
