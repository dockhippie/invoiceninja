#!/bin/bash

echo "> chown app directory"
find ${INVOICENINJA_BASE_DIR} \( \! -user caddy -o \! -group caddy \) -print0 | xargs -0 -r chown caddy:caddy
