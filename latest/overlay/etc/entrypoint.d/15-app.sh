#!/bin/bash

declare -x INVOICENINJA_BASE_DIR
[[ -z "${INVOICENINJA_BASE_DIR}" ]] && INVOICENINJA_BASE_DIR="/var/lib/invoiceninja"

declare -x INVOICENINJA_APP_NAME
[[ -z "${INVOICENINJA_APP_NAME}" ]] && INVOICENINJA_APP_NAME="Invoice Ninja"

declare -x INVOICENINJA_APP_DEBUG
[[ -z "${INVOICENINJA_APP_DEBUG}" ]] && INVOICENINJA_APP_DEBUG="false"

declare -x INVOICENINJA_APP_ENV
[[ -z "${INVOICENINJA_APP_ENV}" ]] && INVOICENINJA_APP_ENV="production"

declare -x INVOICENINJA_APP_URL
[[ -z "${INVOICENINJA_APP_URL}" ]] && INVOICENINJA_APP_URL="http://localhost:8080"

declare -x INVOICENINJA_APP_TIMEZONE
[[ -z "${INVOICENINJA_APP_TIMEZONE}" ]] && INVOICENINJA_APP_TIMEZONE="UTC"

declare -x INVOICENINJA_APP_LOCALE
[[ -z "${INVOICENINJA_APP_LOCALE}" ]] && INVOICENINJA_APP_LOCALE="en"

declare -x INVOICENINJA_APP_FALLBACK_LOCALE
[[ -z "${INVOICENINJA_APP_FALLBACK_LOCALE}" ]] && INVOICENINJA_APP_FALLBACK_LOCALE="en"

declare -x INVOICENINJA_APP_KEY
[[ -z "${INVOICENINJA_APP_KEY}" ]] && INVOICENINJA_APP_KEY=""

declare -x INVOICENINJA_APP_CIPHER
[[ -z "${INVOICENINJA_APP_CIPHER}" ]] && INVOICENINJA_APP_CIPHER="rijndael-128"

declare -x INVOICENINJA_APP_LOG
[[ -z "${INVOICENINJA_APP_LOG}" ]] && INVOICENINJA_APP_LOG="single"

if [ -z "${INVOICENINJA_APP_KEY}" ]
then
  if [ -f ${INVOICENINJA_BASE_DIR}/secret ]
  then
    INVOICENINJA_APP_KEY=$(cat ${INVOICENINJA_BASE_DIR}/secret | head -n1)
  else
    INVOICENINJA_APP_KEY=$(date +%s | sha256sum | base64 | head -c 32 ; echo)
    echo "${INVOICENINJA_APP_KEY}" > ${INVOICENINJA_BASE_DIR}/secret
  fi
fi
