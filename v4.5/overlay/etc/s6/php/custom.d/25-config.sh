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
