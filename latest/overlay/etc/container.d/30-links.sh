#!/usr/bin/env bash

echo "> link app dir"
rm -rf ${APACHE_WEBROOT}/storage/app
ln -sf ${INVOICENINJA_APP_DIR} ${APACHE_WEBROOT}/storage/app

echo "> link logs dir"
rm -rf ${APACHE_WEBROOT}/storage/logs
ln -sf ${INVOICENINJA_LOGS_DIR} ${APACHE_WEBROOT}/storage/logs

true
