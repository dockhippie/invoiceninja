#!/usr/bin/env bash

declare -x INVOICENINJA_POSTMARK_SECRET
[[ -z "${INVOICENINJA_POSTMARK_SECRET}" ]] && INVOICENINJA_POSTMARK_SECRET=""

true
