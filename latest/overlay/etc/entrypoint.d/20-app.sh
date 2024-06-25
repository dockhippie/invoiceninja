#!/usr/bin/env bash

declare -x INVOICENINJA_APP_NAME
[[ -z "${INVOICENINJA_APP_NAME}" ]] && INVOICENINJA_APP_NAME="Invoice Ninja"

declare -x INVOICENINJA_APP_ENV
[[ -z "${INVOICENINJA_APP_ENV}" ]] && INVOICENINJA_APP_ENV="production"

declare -x INVOICENINJA_APP_DEBUG
[[ -z "${INVOICENINJA_APP_DEBUG}" ]] && INVOICENINJA_APP_DEBUG="false"

declare -x INVOICENINJA_APP_URL
[[ -z "${INVOICENINJA_APP_URL}" ]] && INVOICENINJA_APP_URL="http://localhost"

declare -x INVOICENINJA_MIX_ASSET_URL
[[ -z "${INVOICENINJA_MIX_ASSET_URL}" ]] && INVOICENINJA_MIX_ASSET_URL="${INVOICENINJA_APP_URL}"

declare -x INVOICENINJA_APP_TIMEZONE
[[ -z "${INVOICENINJA_APP_TIMEZONE}" ]] && INVOICENINJA_APP_TIMEZONE="UTC"

declare -x INVOICENINJA_APP_LOCALE
[[ -z "${INVOICENINJA_APP_LOCALE}" ]] && INVOICENINJA_APP_LOCALE="en"

declare -x INVOICENINJA_APP_KEY
[[ -z "${INVOICENINJA_APP_KEY}" ]] && INVOICENINJA_APP_KEY=""

true
