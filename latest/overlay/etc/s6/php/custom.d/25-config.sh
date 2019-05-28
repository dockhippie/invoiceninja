#!/bin/bash

if [ -z "${INVOICENINJA_APP_KEY}" ]
then
  echo >&2 "Error: You have to provide INVOICENINJA_APP_KEY environment variable"
  /bin/s6-svscanctl -t /etc/s6
  exit 1
fi

if [ -z "${INVOICENINJA_APP_URL}" ]
then
  echo >&2 "Error: You have to provide INVOICENINJA_APP_URL environment variable"
  /bin/s6-svscanctl -t /etc/s6
  exit 1
fi

echo "> writing env config"
/usr/bin/gomplate -V \
  -o /srv/www/.env \
  -f /etc/templates/env.tmpl

if [[ $? -ne 0 ]]
then
  echo "> writing config failed!"
  /bin/s6-svscanctl -t /etc/s6
  exit 1
fi
