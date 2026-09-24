#!/bin/sh
set -eu

# Optional local YAML check uses a disposable parser, not a host dependency.
if [ "${1:-}" = --config ]; then
    docker run --rm -i -v "$PWD/.gitlab-ci.yml:/ci.yml:ro" ruby:3.4-alpine ruby -ryaml - /ci.yml <<'RUBY'
config = YAML.safe_load_file(ARGV.fetch(0))
raise 'stages' unless config['stages'] == %w[validate image]
validate = config.fetch('validate-composer')
raise 'composer job' unless validate == {'stage' => 'validate', 'image' => 'composer:2', 'script' => ['composer validate --no-check-publish']}
image = config.fetch('build-image')
raise 'image job' unless image['stage'] == 'image' && image['image'] == 'quay.io/buildah/stable'
raise 'Buildah settings' unless image['variables'] == {'STORAGE_DRIVER' => 'vfs', 'BUILDAH_FORMAT' => 'docker', 'BUILDAH_ISOLATION' => 'chroot'}
raise 'image script' unless image['script'] == ['sh tests/Deployment/ci-check.sh', 'sh container/ci-build.sh']
raise 'release artifact' unless image.dig('artifacts', 'paths') == ['release.env']
raise 'unexpected CI keys' unless config.keys.sort == %w[build-image stages validate-composer workflow]
[validate, image].each { |job| raise 'runner tags/services/rules' if %w[tags services rules].any? { |key| job.key?(key) } }
rules = config.fetch('workflow').fetch('rules')
expected = [
  {'if' => '$CI_COMMIT_TAG', 'when' => 'never'},
  {'if' => '$CI_PIPELINE_SOURCE == "merge_request_event" && $CI_MERGE_REQUEST_TARGET_BRANCH_NAME == "main"'},
  {'if' => '$CI_COMMIT_BRANCH == "main"'}
]
raise 'workflow rules' unless rules == expected
[
  ['push', 'main', nil, nil, true],
  ['push', 'feature', nil, nil, false],
  ['merge_request_event', nil, 'main', nil, true],
  ['merge_request_event', nil, 'other', nil, false],
  ['push', nil, nil, 'v1', false],
  ['push', 'main', nil, 'v1', false]
].each do |source, branch, target, tag, allowed|
  env = {'CI_PIPELINE_SOURCE' => source, 'CI_COMMIT_BRANCH' => branch, 'CI_MERGE_REQUEST_TARGET_BRANCH_NAME' => target, 'CI_COMMIT_TAG' => tag}
  rule = rules.find { |r| eval(r.fetch('if').gsub(/\$(\w+)/) { env[$1].inspect }) }
  raise 'pipeline scope' unless (!!rule && rule['when'] != 'never') == allowed
end
puts 'CI YAML syntax, jobs and pipeline scope: OK.'
RUBY
    exit $?
fi

# Re-execute this file as Buildah; validate arguments as well as fail-stop order.
if [ "${0##*/}" = buildah ]; then
    step=$1
    shift
    printf '%s\n' "$step" >> "$CALLS"
    [ "$step" != "${FAIL_STEP:-}" ] || exit 1
    image="$CI_REGISTRY_IMAGE:$EXPECTED_TAG"
    case "$step" in
        bud) [ "$*" = "--pull --tag $image ." ] ;;
        from) [ "$*" = "$image" ]; printf '%s\n' smoke-owned ;;
        copy) [ "$*" = 'smoke-owned tests/Deployment/image-check.php /tmp/image-check.php' ] ;;
        run)
            [ "$*" = '--network none --env APP_ENV=testing --env APP_DEBUG=false --env DB_CONNECTION=sqlite --env DB_DATABASE=:memory: --env CACHE_STORE=array --env SESSION_DRIVER=array --env QUEUE_CONNECTION=sync --env LOG_CHANNEL=stderr --env TRUSTED_PROXIES=192.0.2.10 smoke-owned -- php /tmp/image-check.php' ] ;;
        rm) [ "$*" = smoke-owned ] ;;
        login)
            [ "$1" = --authfile ]
            auth=$2
            shift 2
            [ "$*" = "--username $CI_REGISTRY_USER --password-stdin $CI_REGISTRY" ]
            [ "$(cat)" = "$CI_REGISTRY_PASSWORD" ]
            printf '%s\n' "$auth" > "$AUTH_PATH"
            printf '%s\n' mock-auth > "$auth" ;;
        push)
            [ "$1" = --authfile ] && [ -f "$2" ] && [ "$3" = --digestfile ]
            digestfile=$4
            shift 4
            [ "$*" = "$image docker://$image" ]
            case "${DIGEST_MODE:-valid}" in
                valid) printf 'sha256:%064d\n' 0 > "$digestfile" ;;
                missing) : ;;
                short) printf 'sha256:1234\n' > "$digestfile" ;;
                invalid) printf 'sha256:%064d\n' 0 | tr 0 g > "$digestfile" ;;
                multiline) printf 'sha256:%064d\nextra\n' 0 > "$digestfile" ;;
            esac ;;
        *) exit 1 ;;
    esac
    exit 0
fi

root=$(pwd)
sh -n container/ci-build.sh
sh -n tests/Deployment/ci-check.sh
tmp=$(mktemp -d)
trap 'rm -rf "$tmp"' EXIT
mkdir -p "$tmp/tests/Deployment" "$tmp/scratch"
cp tests/Deployment/image-check.php "$tmp/tests/Deployment/"
cp tests/Deployment/ci-check.sh "$tmp/buildah"
chmod +x "$tmp/buildah"
export PATH="$tmp:$PATH" CALLS="$tmp/calls" AUTH_PATH="$tmp/auth-path" TMPDIR="$tmp/scratch"
export CI_REGISTRY_IMAGE=registry.invalid/team/app CI_REGISTRY=registry.invalid
export CI_REGISTRY_USER=fixture CI_REGISTRY_PASSWORD=fixture-secret
export CI_COMMIT_SHA=1234abcd1234abcd1234abcd1234abcd1234abcd
export CI_COMMIT_TIMESTAMP=2026-09-24T17:00:00Z EXPECTED_TAG=2026.09.25-1234abcd
unset CI_COMMIT_TAG FAIL_STEP DIGEST_MODE
cd "$tmp"
check() {
    expected=$1 sequence=$2 status=0
    : > "$CALLS"
    rm -f "$AUTH_PATH"
    # A failed retry must not leave an earlier release artifact behind.
    printf '%s\n' stale > release.env
    sh "$root/container/ci-build.sh" > "$tmp/output" 2>&1 || status=$?
    if [ "$status" != "$expected" ] || [ "$(paste -sd, "$CALLS")" != "$sequence" ]; then
        cat "$tmp/output" "$CALLS" >&2
        printf 'Unexpected status/order: %s, expected %s / %s\n' "$status" "$expected" "$sequence" >&2
        exit 1
    fi
    ! grep -q "$CI_REGISTRY_PASSWORD" "$tmp/output"
    if [ -f "$AUTH_PATH" ]; then [ ! -e "$(cat "$AUTH_PATH")" ]; fi
    [ -z "$(ls -A "$TMPDIR")" ]
    if [ "$expected" != 0 ]; then [ ! -e release.env ]; fi
}
export CI_PIPELINE_SOURCE=push CI_COMMIT_BRANCH=main CI_OPEN_MERGE_REQUESTS=1
check 0 bud,from,copy,run,rm,login,push
grep -qx "APP_IMAGE=$CI_REGISTRY_IMAGE:$EXPECTED_TAG" release.env
grep -qx "SOURCE_COMMIT=$CI_COMMIT_SHA" release.env
grep -qx "APP_IMAGE_DIGEST=$CI_REGISTRY_IMAGE@$(printf 'sha256:%064d' 0)" release.env
[ "$(wc -l < release.env)" -eq 3 ]
export CI_COMMIT_TIMESTAMP=2026-09-25T00:00:00+07:00
check 0 bud,from,copy,run,rm,login,push
grep -qx "APP_IMAGE=$CI_REGISTRY_IMAGE:$EXPECTED_TAG" release.env
export CI_COMMIT_TIMESTAMP=2026-09-24T16:59:59Z EXPECTED_TAG=2026.09.24-1234abcd
check 0 bud,from,copy,run,rm,login,push
grep -qx "APP_IMAGE=$CI_REGISTRY_IMAGE:$EXPECTED_TAG" release.env
export CI_PIPELINE_SOURCE=merge_request_event CI_MERGE_REQUEST_TARGET_BRANCH_NAME=main
check 0 bud,from,copy,run,rm
[ ! -e release.env ]
export CI_PIPELINE_SOURCE=push CI_COMMIT_BRANCH=feature
check 0 bud,from,copy,run,rm
[ ! -e release.env ]
export CI_COMMIT_BRANCH=main CI_COMMIT_TAG=v1
check 0 bud,from,copy,run,rm
[ ! -e release.env ]
unset CI_COMMIT_TAG
for step in bud from copy run rm login push; do
    export FAIL_STEP=$step
    case "$step" in
        bud) calls=bud ;;
        from) calls=bud,from ;;
        copy) calls=bud,from,copy,rm ;;
        run) calls=bud,from,copy,run,rm ;;
        rm) calls=bud,from,copy,run,rm,rm ;;
        login) calls=bud,from,copy,run,rm,login ;;
        push) calls=bud,from,copy,run,rm,login,push ;;
    esac
    check 1 "$calls"
done
unset FAIL_STEP
for mode in missing short invalid multiline; do
    export DIGEST_MODE=$mode
    check 1 bud,from,copy,run,rm,login,push
done
unset DIGEST_MODE
export CI_COMMIT_TIMESTAMP=invalid
check 1 ''
export CI_COMMIT_TIMESTAMP=2026-09-24T17:00:00Z CI_COMMIT_SHA=not-a-sha
check 1 ''
printf '%s\n' 'CI checks OK: Buildah arguments, Jakarta commit dates, publish isolation, digest validation, fail-stop and owned cleanup. Registry policy not verified.'
