#!/usr/bin/env bash

declare -x INVOICENINJA_FILESYSTEM_DISK
[[ -z "${INVOICENINJA_FILESYSTEM_DISK}" ]] && INVOICENINJA_FILESYSTEM_DISK="public"

declare -x INVOICENINJA_FILESYSTEM_CLOUD
[[ -z "${INVOICENINJA_FILESYSTEM_CLOUD}" ]] && INVOICENINJA_FILESYSTEM_CLOUD="s3"

declare -x INVOICENINJA_AWS_BUCKET
[[ -z "${INVOICENINJA_AWS_BUCKET}" ]] && INVOICENINJA_AWS_BUCKET=""

declare -x INVOICENINJA_AWS_URL
[[ -z "${INVOICENINJA_AWS_URL}" ]] && INVOICENINJA_AWS_URL=""

declare -x INVOICENINJA_AWS_ENDPOINT
[[ -z "${INVOICENINJA_AWS_ENDPOINT}" ]] && INVOICENINJA_AWS_ENDPOINT=""

declare -x INVOICENINJA_AWS_USE_PATH_STYLE_ENDPOINT
[[ -z "${INVOICENINJA_AWS_USE_PATH_STYLE_ENDPOINT}" ]] && INVOICENINJA_AWS_USE_PATH_STYLE_ENDPOINT=""

declare -x INVOICENINJA_R2_ACCESS_KEY_ID
[[ -z "${INVOICENINJA_R2_ACCESS_KEY_ID}" ]] && INVOICENINJA_R2_ACCESS_KEY_ID=""

declare -x INVOICENINJA_R2_SECRET_ACCESS_KEY
[[ -z "${INVOICENINJA_R2_SECRET_ACCESS_KEY}" ]] && INVOICENINJA_R2_SECRET_ACCESS_KEY=""

declare -x INVOICENINJA_R2_DEFAULT_REGION
[[ -z "${INVOICENINJA_R2_DEFAULT_REGION}" ]] && INVOICENINJA_R2_DEFAULT_REGION=""

declare -x INVOICENINJA_R2_BUCKET
[[ -z "${INVOICENINJA_R2_BUCKET}" ]] && INVOICENINJA_R2_BUCKET=""

declare -x INVOICENINJA_R2_URL
[[ -z "${INVOICENINJA_R2_URL}" ]] && INVOICENINJA_R2_URL=""

declare -x INVOICENINJA_R2_ENDPOINT
[[ -z "${INVOICENINJA_R2_ENDPOINT}" ]] && INVOICENINJA_R2_ENDPOINT=""

declare -x INVOICENINJA_R2_USE_PATH_STYLE_ENDPOINT
[[ -z "${INVOICENINJA_R2_USE_PATH_STYLE_ENDPOINT}" ]] && INVOICENINJA_R2_USE_PATH_STYLE_ENDPOINT=""

declare -x INVOICENINJA_GOOGLE_CLOUD_PROJECT_ID
[[ -z "${INVOICENINJA_GOOGLE_CLOUD_PROJECT_ID}" ]] && INVOICENINJA_GOOGLE_CLOUD_PROJECT_ID=""

declare -x INVOICENINJA_GOOGLE_CLOUD_KEY_FILE
[[ -z "${INVOICENINJA_GOOGLE_CLOUD_KEY_FILE}" ]] && INVOICENINJA_GOOGLE_CLOUD_KEY_FILE=""

declare -x INVOICENINJA_GOOGLE_CLOUD_STORAGE_BUCKET
[[ -z "${INVOICENINJA_GOOGLE_CLOUD_STORAGE_BUCKET}" ]] && INVOICENINJA_GOOGLE_CLOUD_STORAGE_BUCKET=""

declare -x INVOICENINJA_GOOGLE_CLOUD_STORAGE_PATH_PREFIX
[[ -z "${INVOICENINJA_GOOGLE_CLOUD_STORAGE_PATH_PREFIX}" ]] && INVOICENINJA_GOOGLE_CLOUD_STORAGE_PATH_PREFIX=""

declare -x INVOICENINJA_GOOGLE_CLOUD_STORAGE_API_URI
[[ -z "${INVOICENINJA_GOOGLE_CLOUD_STORAGE_API_URI}" ]] && INVOICENINJA_GOOGLE_CLOUD_STORAGE_API_URI=""

true
