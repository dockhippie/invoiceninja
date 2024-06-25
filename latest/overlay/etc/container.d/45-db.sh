#!/usr/bin/env bash

if [ -z "${INVOICENINJA_DB_DATABASE}" ]; then
    echo >&2 "missing INVOICENINJA_DB_DATABASE environment variable"
    exit 1
fi

case "${INVOICENINJA_DB_CONNECTION}" in
    "mysql")
        if [ -z "${INVOICENINJA_DB_HOST}" ]; then
            echo >&2 "missing INVOICENINJA_DB_HOST environment variable"
            exit 1
        fi

        if [ -z "${INVOICENINJA_DB_PORT}" ]; then
            echo >&2 "missing INVOICENINJA_DB_PORT environment variable"
            exit 1
        fi

        echo "> waiting for mysql"
        wait-for-it -t 60 ${INVOICENINJA_DB_HOST}:${INVOICENINJA_DB_PORT}

        if [[ $? -ne 0 && "${INVOICENINJA_DB_WAIT_FOR_FAIL}" == "true" ]]; then
            echo "> database didn't came up"
            exit 1
        fi
        ;;

    "pgsql")
        if [ -z "${INVOICENINJA_DB_HOST}" ]; then
            echo >&2 "missing INVOICENINJA_DB_HOST environment variable"
            exit 1
        fi

        if [ -z "${INVOICENINJA_DB_PORT}" ]; then
            echo >&2 "missing INVOICENINJA_DB_PORT environment variable"
            exit 1
        fi

        echo "> waiting for postgres"
        wait-for-it -t 60 ${INVOICENINJA_DB_HOST}:${INVOICENINJA_DB_PORT}

        if [[ $? -ne 0 && "${INVOICENINJA_DB_WAIT_FOR_FAIL}" == "true" ]]; then
            echo "> database didn't came up"
            exit 1
        fi
        ;;
esac

true
