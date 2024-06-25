#!/usr/bin/env bash

declare -x INVOICENINJA_CACHE_DRIVER
[[ -z "${INVOICENINJA_CACHE_DRIVER}" ]] && INVOICENINJA_CACHE_DRIVER="file"

declare -x INVOICENINJA_LIMITER_DRIVER
[[ -z "${INVOICENINJA_LIMITER_DRIVER}" ]] && INVOICENINJA_LIMITER_DRIVER=""

declare -x INVOICENINJA_MEMCACHED_PERSISTENT_ID
[[ -z "${INVOICENINJA_MEMCACHED_PERSISTENT_ID}" ]] && INVOICENINJA_MEMCACHED_PERSISTENT_ID=""

declare -x INVOICENINJA_MEMCACHED_USERNAME
[[ -z "${INVOICENINJA_MEMCACHED_USERNAME}" ]] && INVOICENINJA_MEMCACHED_USERNAME=""

declare -x INVOICENINJA_MEMCACHED_PASSWORD
[[ -z "${INVOICENINJA_MEMCACHED_PASSWORD}" ]] && INVOICENINJA_MEMCACHED_PASSWORD=""

declare -x INVOICENINJA_MEMCACHED_HOST
[[ -z "${INVOICENINJA_MEMCACHED_HOST}" ]] && INVOICENINJA_MEMCACHED_HOST="memcached"

declare -x INVOICENINJA_MEMCACHED_PORT
[[ -z "${INVOICENINJA_MEMCACHED_PORT}" ]] && INVOICENINJA_MEMCACHED_PORT="11211"

declare -x INVOICENINJA_REDIS_CACHE_CONNECTION
[[ -z "${INVOICENINJA_REDIS_CACHE_CONNECTION}" ]] && INVOICENINJA_REDIS_CACHE_CONNECTION="cache"

declare -x INVOICENINJA_AWS_ACCESS_KEY_ID
[[ -z "${INVOICENINJA_AWS_ACCESS_KEY_ID}" ]] && INVOICENINJA_AWS_ACCESS_KEY_ID=""

declare -x INVOICENINJA_AWS_SECRET_ACCESS_KEY
[[ -z "${INVOICENINJA_AWS_SECRET_ACCESS_KEY}" ]] && INVOICENINJA_AWS_SECRET_ACCESS_KEY=""

declare -x INVOICENINJA_AWS_DEFAULT_REGION
[[ -z "${INVOICENINJA_AWS_DEFAULT_REGION}" ]] && INVOICENINJA_AWS_DEFAULT_REGION=""

declare -x INVOICENINJA_DYNAMODB_CACHE_TABLE
[[ -z "${INVOICENINJA_DYNAMODB_CACHE_TABLE}" ]] && INVOICENINJA_DYNAMODB_CACHE_TABLE=""

declare -x INVOICENINJA_DYNAMODB_ENDPOINT
[[ -z "${INVOICENINJA_DYNAMODB_ENDPOINT}" ]] && INVOICENINJA_DYNAMODB_ENDPOINT=""

declare -x INVOICENINJA_CACHE_PREFIX
[[ -z "${INVOICENINJA_CACHE_PREFIX}" ]] && INVOICENINJA_CACHE_PREFIX=""

true
