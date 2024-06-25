#!/usr/bin/env bash

echo "> writing env config"
gomplate -V \
    -o ${APACHE_WEBROOT}/.env \
    -f /etc/templates/env.tmpl

if [[ $? -ne 0 ]]; then
    echo "> writing config failed!"
    exit 1
fi

if [ -z "${INVOICENINJA_APP_KEY}" ]; then
    if [ -f ${INVOICENINJA_BASE_DIR}/secret ]; then
        INVOICENINJA_APP_KEY=$(cat ${INVOICENINJA_BASE_DIR}/secret | head -n1)
    else
        INVOICENINJA_APP_KEY=$(date +%s | sha256sum | base64 | head -c 32 ; echo)
        echo "${INVOICENINJA_APP_KEY}" > ${INVOICENINJA_BASE_DIR}/secret
    fi
fi

true
