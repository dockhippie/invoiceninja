#!/bin/bash

for DIR in app logs templates
do
  if [ ! -d ${INVOICENINJA_BASE_DIR}/${DIR} ]
  then
    echo "> creating ${DIR} directory"
    mkdir -p \
      ${INVOICENINJA_BASE_DIR}/${DIR}
  fi

  echo "> remove original ${DIR}"
  rm -rf \
    /srv/www/storage/${DIR}

  echo "> symlink ${DIR} original"
  ln -sf \
    ${INVOICENINJA_BASE_DIR}/${DIR} \
    /srv/www/storage/${DIR}
done
