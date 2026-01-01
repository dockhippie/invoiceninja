#!/usr/bin/env bash

declare -x INVOICENINJA_REDIS_HOST
: "${INVOICENINJA_REDIS_HOST:="redis"}"

declare -x INVOICENINJA_REDIS_PASSWORD
: "${INVOICENINJA_REDIS_PASSWORD:=""}"

declare -x INVOICENINJA_REDIS_PORT
: "${INVOICENINJA_REDIS_PORT:="6379"}"

declare -x INVOICENINJA_REDIS_DB
: "${INVOICENINJA_REDIS_DB:="0"}"

declare -x INVOICENINJA_REDIS_CACHE_DB
: "${INVOICENINJA_REDIS_CACHE_DB:="1"}"

declare -x INVOICENINJA_REDIS_SENTINEL_SERVICE
: "${INVOICENINJA_REDIS_SENTINEL_SERVICE:="mymaster"}"

declare -x INVOICENINJA_DB_CONNECTION
: "${INVOICENINJA_DB_CONNECTION:="mysql"}"

declare -x INVOICENINJA_DB_WAIT_FOR_FAIL
: "${INVOICENINJA_DB_WAIT_FOR_FAIL:="true"}"

case "${INVOICENINJA_DB_CONNECTION}" in
    "mysql")
        declare -x INVOICENINJA_DB_HOST
        : "${INVOICENINJA_DB_HOST:="mysql"}"

        declare -x INVOICENINJA_DB_PORT
        : "${INVOICENINJA_DB_PORT:="3306"}"

        declare -x INVOICENINJA_DB_DATABASE
        : "${INVOICENINJA_DB_DATABASE:="invoiceninja"}"

        declare -x INVOICENINJA_DB_USERNAME
        : "${INVOICENINJA_DB_USERNAME:="root"}"

        declare -x INVOICENINJA_DB_PASSWORD
        : "${INVOICENINJA_DB_PASSWORD:="root"}"

        declare -x INVOICENINJA_DB_STRICT
        : "${INVOICENINJA_DB_STRICT:="false"}"
        ;;

    "postgres")
        declare -x INVOICENINJA_DB_HOST
        : "${INVOICENINJA_DB_HOST:="postgres"}"

        declare -x INVOICENINJA_DB_PORT
        : "${INVOICENINJA_DB_PORT:="5432"}"

        declare -x INVOICENINJA_DB_NAME
        : "${INVOICENINJA_DB_NAME:="invoiceninja"}"

        declare -x INVOICENINJA_DB_USERNAME
        : "${INVOICENINJA_DB_USERNAME:="postgres"}"

        declare -x INVOICENINJA_DB_PASSWORD
        : "${INVOICENINJA_DB_PASSWORD:="postgres"}"
        ;;
esac
