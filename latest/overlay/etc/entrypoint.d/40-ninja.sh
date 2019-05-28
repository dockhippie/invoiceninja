#!/bin/bash

declare -x INVOICENINJA_VIDEOS_URL
[[ -z "${INVOICENINJA_VIDEOS_URL}" ]] && INVOICENINJA_VIDEOS_URL="https://www.youtube.com/channel/UCXAHcBvhW05PDtWYIq7WDFA/videos"

declare -x INVOICENINJA_VIDEOS_CUSTOM_DESIGN_URL
[[ -z "${INVOICENINJA_VIDEOS_CUSTOM_DESIGN_URL}" ]] && INVOICENINJA_VIDEOS_CUSTOM_DESIGN_URL="https://www.youtube.com/watch?v=pXQ6jgiHodc"

declare -x INVOICENINJA_VIDEOS_GETTING_STARTED_URL
[[ -z "${INVOICENINJA_VIDEOS_GETTING_STARTED_URL}" ]] && INVOICENINJA_VIDEOS_GETTING_STARTED_URL="https://www.youtube.com/watch?v=i7fqfi5HWeo"

declare -x INVOICENINJA_LOCK_SENT_INVOICES
[[ -z "${INVOICENINJA_LOCK_SENT_INVOICES}" ]] && INVOICENINJA_LOCK_SENT_INVOICES=""

declare -x INVOICENINJA_TIME_TRACKER_WEB_URL
[[ -z "${INVOICENINJA_TIME_TRACKER_WEB_URL}" ]] && INVOICENINJA_TIME_TRACKER_WEB_URL="https://www.invoiceninja.com/time-tracker"

declare -x INVOICENINJA_KNOWLEDGE_BASE_URL
[[ -z "${INVOICENINJA_KNOWLEDGE_BASE_URL}" ]] && INVOICENINJA_KNOWLEDGE_BASE_URL="https://www.invoiceninja.com/knowledge-base/"

declare -x INVOICENINJA_COUPON_50_OFF
[[ -z "${INVOICENINJA_COUPON_50_OFF}" ]] && INVOICENINJA_COUPON_50_OFF="false"

declare -x INVOICENINJA_COUPON_75_OFF
[[ -z "${INVOICENINJA_COUPON_75_OFF}" ]] && INVOICENINJA_COUPON_75_OFF="false"

declare -x INVOICENINJA_COUPON_FREE_YEAR
[[ -z "${INVOICENINJA_COUPON_FREE_YEAR}" ]] && INVOICENINJA_COUPON_FREE_YEAR="false"

declare -x INVOICENINJA_EXCHANGE_RATES_ENABLED
[[ -z "${INVOICENINJA_EXCHANGE_RATES_ENABLED}" ]] && INVOICENINJA_EXCHANGE_RATES_ENABLED="false"

declare -x INVOICENINJA_EXCHANGE_RATES_URL
[[ -z "${INVOICENINJA_EXCHANGE_RATES_URL}" ]] && INVOICENINJA_EXCHANGE_RATES_URL="https://api.fixer.io/latest"

declare -x INVOICENINJA_EXCHANGE_RATES_BASE
[[ -z "${INVOICENINJA_EXCHANGE_RATES_BASE}" ]] && INVOICENINJA_EXCHANGE_RATES_BASE="EUR"

declare -x INVOICENINJA_TERMS_OF_SERVICE_URL
[[ -z "${INVOICENINJA_TERMS_OF_SERVICE_URL}" ]] && INVOICENINJA_TERMS_OF_SERVICE_URL="https://www.invoiceninja.com/self-hosting-terms-service/"

declare -x INVOICENINJA_PRIVACY_POLICY_URL
[[ -z "${INVOICENINJA_PRIVACY_POLICY_URL}" ]] && INVOICENINJA_PRIVACY_POLICY_URL="https://www.invoiceninja.com/self-hosting-privacy-data-control/"

declare -x INVOICENINJA_GOOGLE_MAPS_ENABLED
[[ -z "${INVOICENINJA_GOOGLE_MAPS_ENABLED}" ]] && INVOICENINJA_GOOGLE_MAPS_ENABLED="true"

declare -x INVOICENINJA_GOOGLE_MAPS_API_KEY
[[ -z "${INVOICENINJA_GOOGLE_MAPS_API_KEY}" ]] && INVOICENINJA_GOOGLE_MAPS_API_KEY=""

declare -x INVOICENINJA_MSBOT_LUIS_APP_ID
[[ -z "${INVOICENINJA_MSBOT_LUIS_APP_ID}" ]] && INVOICENINJA_MSBOT_LUIS_APP_ID="ea1cda29-5994-47c4-8c25-2b58ae7ae7a8"

declare -x INVOICENINJA_MSBOT_LUIS_SUBSCRIPTION_KEY
[[ -z "${INVOICENINJA_MSBOT_LUIS_SUBSCRIPTION_KEY}" ]] && INVOICENINJA_MSBOT_LUIS_SUBSCRIPTION_KEY=""
