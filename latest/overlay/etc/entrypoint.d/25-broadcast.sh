#!/usr/bin/env bash

declare -x INVOICENINJA_BROADCAST_DRIVER
[[ -z "${INVOICENINJA_BROADCAST_DRIVER}" ]] && INVOICENINJA_BROADCAST_DRIVER="log"

declare -x INVOICENINJA_PUSHER_APP_KEY
[[ -z "${INVOICENINJA_PUSHER_APP_KEY}" ]] && INVOICENINJA_PUSHER_APP_KEY=""

declare -x INVOICENINJA_PUSHER_APP_SECRET
[[ -z "${INVOICENINJA_PUSHER_APP_SECRET}" ]] && INVOICENINJA_PUSHER_APP_SECRET=""

declare -x INVOICENINJA_PUSHER_APP_ID
[[ -z "${INVOICENINJA_PUSHER_APP_ID}" ]] && INVOICENINJA_PUSHER_APP_ID=""

declare -x INVOICENINJA_PUSHER_HOST
[[ -z "${INVOICENINJA_PUSHER_HOST}" ]] && INVOICENINJA_PUSHER_HOST=""

declare -x INVOICENINJA_PUSHER_APP_CLUSTER
[[ -z "${INVOICENINJA_PUSHER_APP_CLUSTER}" ]] && INVOICENINJA_PUSHER_APP_CLUSTER=""

declare -x INVOICENINJA_PUSHER_PORT
[[ -z "${INVOICENINJA_PUSHER_PORT}" ]] && INVOICENINJA_PUSHER_PORT=""

declare -x INVOICENINJA_PUSHER_SCHEME
[[ -z "${INVOICENINJA_PUSHER_SCHEME}" ]] && INVOICENINJA_PUSHER_SCHEME=""

declare -x INVOICENINJA_ABLY_KEY
[[ -z "${INVOICENINJA_ABLY_KEY}" ]] && INVOICENINJA_ABLY_KEY=""

declare -x INVOICENINJA_REDIS_BROADCAST_CONNECTION
[[ -z "${INVOICENINJA_REDIS_BROADCAST_CONNECTION}" ]] && INVOICENINJA_REDIS_BROADCAST_CONNECTION="default"

true
