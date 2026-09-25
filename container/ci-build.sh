#!/bin/sh
set -eu

rm -f release.env
: "${CI_COMMIT_TIMESTAMP:?}" "${CI_COMMIT_SHA:?}"
printf '%s\n' "$CI_COMMIT_SHA" | grep -Eq '^[0-9a-f]{40}$'
# Commit time is stable across retries, including timestamps with UTC offsets.
release_date=$(TZ=Asia/Jakarta date --date="$CI_COMMIT_TIMESTAMP" +%Y.%m.%d)
release_tag="$release_date-$(printf '%.8s' "$CI_COMMIT_SHA")"
printf '%s\n' "$release_tag" | grep -Eq '^[0-9]{4}\.(0[1-9]|1[0-2])\.(0[1-9]|[12][0-9]|3[01])-[0-9a-f]{8}$'
image="$CI_REGISTRY_IMAGE:$release_tag"

tmp=$(mktemp -d)
working=
cleanup() {
    status=$?
    trap - EXIT
    if [ -n "$working" ]; then buildah rm "$working" || status=1; fi
    rm -rf "$tmp"
    exit "$status"
}
trap cleanup EXIT
trap 'exit 1' HUP INT TERM

buildah bud --pull --tag "$image" .
working=$(buildah from "$image")
# Tests are excluded from the image context; copy this check only into the disposable container.
buildah copy --contextdir "$PWD" --ignorefile /dev/null --chmod 0644 --chown 33:33 "$working" tests/Deployment/image-check.php /tmp/image-check.php
buildah run --network none --env APP_ENV=testing --env APP_DEBUG=false --env DB_CONNECTION=sqlite --env DB_DATABASE=:memory: --env CACHE_STORE=array --env SESSION_DRIVER=array --env QUEUE_CONNECTION=sync --env LOG_CHANNEL=stderr --env TRUSTED_PROXIES=192.0.2.10 "$working" -- php /tmp/image-check.php
buildah rm "$working"
working=

if [ "$CI_PIPELINE_SOURCE" != merge_request_event ] && [ "${CI_COMMIT_BRANCH:-}" = main ] && [ -z "${CI_COMMIT_TAG:-}" ]; then
    printf '%s' "$CI_REGISTRY_PASSWORD" | buildah login --authfile "$tmp/auth.json" --username "$CI_REGISTRY_USER" --password-stdin "$CI_REGISTRY"
    # Registry immutable-tag policy is authoritative, including concurrent pushes.
    # An existing immutable tag must fail here, never be deleted or overwritten.
    buildah push --authfile "$tmp/auth.json" --digestfile "$tmp/digest" "$image" "docker://$image"
    digest=$(cat "$tmp/digest")
    [ "${#digest}" = 71 ] || exit 1
    printf '%s\n' "$digest" | grep -Eq '^sha256:[0-9a-f]{64}$'
    printf 'APP_IMAGE=%s\nAPP_IMAGE_DIGEST=%s@%s\nSOURCE_COMMIT=%s\n' "$image" "$CI_REGISTRY_IMAGE" "$digest" "$CI_COMMIT_SHA" > release.env
fi
