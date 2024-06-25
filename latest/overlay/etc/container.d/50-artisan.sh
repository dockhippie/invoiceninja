#!/usr/bin/env bash

pushd ${APACHE_WEBROOT} >/dev/null
  echo "> artisan clear compiled"
  su-exec \
    apache \
    php \
    artisan \
    clear-compiled -n -q

  echo "> artisan optimize assets"
  su-exec \
    apache \
    php \
    artisan \
    optimize -n -q

  echo "> artisan migrate install"
  su-exec \
    apache \
    php \
    artisan \
    migrate:install -n -q

  echo "> artisan migrate execute"
  su-exec \
    apache \
    php \
    artisan \
    migrate -n --force --seed
popd >/dev/null

true
