#!/bin/bash

if [[ -d "/storage" ]]
then
  echo "> linking old storage"
  ln -sf \
    /storage \
    ${INVOICENINJA_BASE_DIR}
else
  echo "> creating app directory"
  mkdir -p \
    ${INVOICENINJA_BASE_DIR}
fi
