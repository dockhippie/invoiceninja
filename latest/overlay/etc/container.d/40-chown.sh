#!/usr/bin/env bash

if [[ "${INVOICENINJA_SKIP_CHOWN}" != "true" ]]; then
    echo "> chown base dir"
    find ${INVOICENINJA_BASE_DIR} \( \! -user apache -o \! -group apache \) -print0 | xargs -0 -r chown apache:apache

    if [[ ! ${INVOICENINJA_BASE_DIR} =~ ^${INVOICENINJA_APP_DIR} ]]; then
        echo "> chown app dir"
        find ${INVOICENINJA_APP_DIR} \( \! -user apache -o \! -group apache \) -print0 | xargs -r -0 chown apache:apache
    fi

    if [[ ! ${INVOICENINJA_BASE_DIR} =~ ^${INVOICENINJA_LOGS_DIR} ]]; then
        echo "> chown logs dir"
        find ${INVOICENINJA_LOGS_DIR} \( \! -user apache -o \! -group apache \) -print0 | xargs -r -0 chown apache:apache
    fi
fi

true
