#!/bin/bash

declare -x INVOICENINJA_QUEUE_DRIVER
[[ -z "${INVOICENINJA_QUEUE_DRIVER}" ]] && INVOICENINJA_QUEUE_DRIVER="sync"

declare -x INVOICENINJA_QUEUE_DATABASE_CONNECTION
[[ -z "${INVOICENINJA_QUEUE_DATABASE_CONNECTION}" ]] && INVOICENINJA_QUEUE_DATABASE_CONNECTION="${INVOICENINJA_DB_TYPE}"

declare -x INVOICENINJA_QUEUE_BEANSTALKD_HOST
[[ -z "${INVOICENINJA_QUEUE_BEANSTALKD_HOST}" ]] && INVOICENINJA_QUEUE_BEANSTALKD_HOST="localhost"

declare -x INVOICENINJA_QUEUE_BEANSTALKD_NAME
[[ -z "${INVOICENINJA_QUEUE_BEANSTALKD_NAME}" ]] && INVOICENINJA_QUEUE_BEANSTALKD_NAME="default"

declare -x INVOICENINJA_QUEUE_SQS_KEY
[[ -z "${INVOICENINJA_QUEUE_SQS_KEY}" ]] && INVOICENINJA_QUEUE_SQS_KEY=""

declare -x INVOICENINJA_QUEUE_SQS_SECRET
[[ -z "${INVOICENINJA_QUEUE_SQS_SECRET}" ]] && INVOICENINJA_QUEUE_SQS_SECRET=""

declare -x INVOICENINJA_QUEUE_SQS_NAME
[[ -z "${INVOICENINJA_QUEUE_SQS_NAME}" ]] && INVOICENINJA_QUEUE_SQS_NAME=""

declare -x INVOICENINJA_QUEUE_SQS_REGION
[[ -z "${INVOICENINJA_QUEUE_SQS_REGION}" ]] && INVOICENINJA_QUEUE_SQS_REGION="us-east-1"

declare -x INVOICENINJA_QUEUE_IRON_HOST
[[ -z "${INVOICENINJA_QUEUE_IRON_HOST}" ]] && INVOICENINJA_QUEUE_IRON_HOST=""

declare -x INVOICENINJA_QUEUE_IRON_TOKEN
[[ -z "${INVOICENINJA_QUEUE_IRON_TOKEN}" ]] && INVOICENINJA_QUEUE_IRON_TOKEN=""

declare -x INVOICENINJA_QUEUE_IRON_PROJECT
[[ -z "${INVOICENINJA_QUEUE_IRON_PROJECT}" ]] && INVOICENINJA_QUEUE_IRON_PROJECT=""

declare -x INVOICENINJA_QUEUE_IRON_NAME
[[ -z "${INVOICENINJA_QUEUE_IRON_NAME}" ]] && INVOICENINJA_QUEUE_IRON_NAME=""

declare -x INVOICENINJA_QUEUE_IRON_ENCRYPT
[[ -z "${INVOICENINJA_QUEUE_IRON_ENCRYPT}" ]] && INVOICENINJA_QUEUE_IRON_ENCRYPT="true"

declare -x INVOICENINJA_QUEUE_DATABASE_CONNECTION
[[ -z "${INVOICENINJA_QUEUE_DATABASE_CONNECTION}" ]] && INVOICENINJA_QUEUE_DATABASE_CONNECTION="${INVOICENINJA_DB_TYPE}"
