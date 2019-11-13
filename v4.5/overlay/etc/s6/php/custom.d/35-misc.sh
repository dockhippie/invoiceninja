#!/bin/bash

for TEMPLATE in bold business clean creative elegant hipster modern photo plain playful
do
  if [ ! -f ${INVOICENINJA_BASE_DIR}/templates/${TEMPLATE}.js ]
  then
    echo "> download ${TEMPLATE} template"
    wget \
      -qO ${INVOICENINJA_BASE_DIR}/templates/${TEMPLATE}.js \
      https://raw.githubusercontent.com/invoiceninja/invoiceninja/v${INVOICENINJA_VERSION}/storage/templates/${TEMPLATE}.js
  fi
done
