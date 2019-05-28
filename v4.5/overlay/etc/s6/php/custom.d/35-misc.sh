#!/bin/bash

if [ ! -f ${INVOICENINJA_BASE_DIR}/templates/bold.js ]
then
  echo "> download bold template"
  wget \
    -qO ${INVOICENINJA_BASE_DIR}/templates/bold.js \
    https://raw.githubusercontent.com/invoiceninja/invoiceninja/v${INVOICENINJA_VERSION}/storage/templates/bold.js
fi

if [ ! -f ${INVOICENINJA_BASE_DIR}/templates/clean.js ]
then
  echo "> download clean template"
  wget \
    -qO ${INVOICENINJA_BASE_DIR}/templates/clean.js \
    https://raw.githubusercontent.com/invoiceninja/invoiceninja/v${INVOICENINJA_VERSION}/storage/templates/clean.js
fi

if [ ! -f ${INVOICENINJA_BASE_DIR}/templates/modern.js ]
then
  echo "> download modern template"
  wget \
    -qO ${INVOICENINJA_BASE_DIR}/templates/modern.js \
    https://raw.githubusercontent.com/invoiceninja/invoiceninja/v${INVOICENINJA_VERSION}/storage/templates/modern.js
fi

if [ ! -f ${INVOICENINJA_BASE_DIR}/templates/plain.js ]
then
  echo "> download plain template"
  wget \
    -qO ${INVOICENINJA_BASE_DIR}/templates/plain.js \
    https://raw.githubusercontent.com/invoiceninja/invoiceninja/v${INVOICENINJA_VERSION}/storage/templates/plain.js
fi
