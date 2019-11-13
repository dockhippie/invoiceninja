#!/bin/bash

case "${INVOICENINJA_DB_TYPE}" in
  "sqlite")
    if [ -z "${INVOICENINJA_DB_DATABASE}" ]
    then
      echo >&2 "Error: You have to provide INVOICENINJA_DB_DATABASE environment variable"
      /bin/s6-svscanctl -t /etc/s6
      exit 1
    fi

    if [ ! -f "${INVOICENINJA_DB_DATABASE}" ]
    then
    	echo "> creating database"
      su-exec \
        caddy \
        /usr/bin/sqlite3 \
        ${INVOICENINJA_DB_DATABASE} \
        ""
    fi
    ;;

  "mysql")
    if [ -z "${INVOICENINJA_DB_USERNAME}" ]
    then
      echo >&2 "Error: You have to provide INVOICENINJA_DB_USERNAME environment variable"
      /bin/s6-svscanctl -t /etc/s6
      exit 1
    fi

    if [ -z "${INVOICENINJA_DB_PASSWORD}" ]
    then
      echo >&2 "Error: You have to provide INVOICENINJA_DB_PASSWORD environment variable"
      /bin/s6-svscanctl -t /etc/s6
      exit 1
    fi
    ;;

  "pgsql")
    if [ -z "${INVOICENINJA_DB_USERNAME}" ]
    then
      echo >&2 "Error: You have to provide INVOICENINJA_DB_USERNAME environment variable"
      /bin/s6-svscanctl -t /etc/s6
      exit 1
    fi

    if [ -z "${INVOICENINJA_DB_PASSWORD}" ]
    then
      echo >&2 "Error: You have to provide INVOICENINJA_DB_PASSWORD environment variable"
      /bin/s6-svscanctl -t /etc/s6
      exit 1
    fi
    ;;
esac
