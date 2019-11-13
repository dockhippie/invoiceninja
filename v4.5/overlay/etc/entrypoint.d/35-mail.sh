#!/bin/bash

declare -x INVOICENINJA_MAIL_DRIVER
[[ -z "${INVOICENINJA_MAIL_DRIVER}" ]] && INVOICENINJA_MAIL_DRIVER="smtp"

declare -x INVOICENINJA_MAIL_HOST
[[ -z "${INVOICENINJA_MAIL_HOST}" ]] && INVOICENINJA_MAIL_HOST="localhost"

declare -x INVOICENINJA_MAIL_PORT
[[ -z "${INVOICENINJA_MAIL_PORT}" ]] && INVOICENINJA_MAIL_PORT="587"

declare -x INVOICENINJA_MAIL_FROM_ADDRESS
[[ -z "${INVOICENINJA_MAIL_FROM_ADDRESS}" ]] && INVOICENINJA_MAIL_FROM_ADDRESS="invoiceninja@localhost"

declare -x INVOICENINJA_MAIL_FROM_NAME
[[ -z "${INVOICENINJA_MAIL_FROM_NAME}" ]] && INVOICENINJA_MAIL_FROM_NAME="Invoiceninja"

declare -x INVOICENINJA_MAIL_ENCRYPTION
[[ -z "${INVOICENINJA_MAIL_ENCRYPTION}" ]] && INVOICENINJA_MAIL_ENCRYPTION="tls"

declare -x INVOICENINJA_MAIL_USERNAME
[[ -z "${INVOICENINJA_MAIL_USERNAME}" ]] && INVOICENINJA_MAIL_USERNAME=""

declare -x INVOICENINJA_MAIL_PASSWORD
[[ -z "${INVOICENINJA_MAIL_PASSWORD}" ]] && INVOICENINJA_MAIL_PASSWORD=""