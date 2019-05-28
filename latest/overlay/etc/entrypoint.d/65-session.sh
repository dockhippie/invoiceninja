#!/bin/bash

declare -x INVOICENINJA_SESSION_DRIVER
[[ -z "${INVOICENINJA_SESSION_DRIVER}" ]] && INVOICENINJA_SESSION_DRIVER="file"

declare -x INVOICENINJA_SESSION_LIFETIME
[[ -z "${INVOICENINJA_SESSION_LIFETIME}" ]] && INVOICENINJA_SESSION_LIFETIME="480"

declare -x INVOICENINJA_SESSION_EXPIRE_ON_CLOSE
[[ -z "${INVOICENINJA_SESSION_EXPIRE_ON_CLOSE}" ]] && INVOICENINJA_SESSION_EXPIRE_ON_CLOSE="true"

declare -x INVOICENINJA_SESSION_ENCRYPT
[[ -z "${INVOICENINJA_SESSION_ENCRYPT}" ]] && INVOICENINJA_SESSION_ENCRYPT="false"

declare -x INVOICENINJA_SESSION_CONNECTION
[[ -z "${INVOICENINJA_SESSION_CONNECTION}" ]] && INVOICENINJA_SESSION_CONNECTION="mysql"

declare -x INVOICENINJA_SESSION_COOKIE
[[ -z "${INVOICENINJA_SESSION_COOKIE}" ]] && INVOICENINJA_SESSION_COOKIE="invoiceninja"

declare -x INVOICENINJA_SESSION_DOMAIN
[[ -z "${INVOICENINJA_SESSION_DOMAIN}" ]] && INVOICENINJA_SESSION_DOMAIN=""

declare -x INVOICENINJA_SESSION_SECURE
[[ -z "${INVOICENINJA_SESSION_SECURE}" ]] && INVOICENINJA_SESSION_SECURE="false"
