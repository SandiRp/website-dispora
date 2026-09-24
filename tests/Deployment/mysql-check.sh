#!/bin/sh
set -eu

# Run with sh; only the two image names are configurable, never database settings.
app_image=${APP_TEST_IMAGE:-dispora-build:octane}
mysql_image=${MYSQL_TEST_IMAGE:-mysql:8.4}
token=$(openssl rand -hex 12)
name=dispora-mysql-check-$token
label=dispora.mysql-check=$token
database=fixture_$token

cleanup() {
    status=$?
    trap - EXIT
    containers=$(docker ps -aq --filter "label=$label") || exit 1
    if [ -n "$containers" ]; then
        docker rm -f $containers >/dev/null || status=1
    fi
    networks=$(docker network ls -q --filter "label=$label") || exit 1
    if [ -n "$networks" ]; then
        docker network rm $networks >/dev/null || status=1
    fi
    if [ -n "$(docker ps -aq --filter "label=$label")$(docker network ls -q --filter "label=$label")" ]; then
        printf '%s\n' 'FAIL: test resources remain.' >&2
        exit 1
    fi
    printf 'Cleanup verified: %s (containers/network removed; database was tmpfs).\n' "$name"
    exit "$status"
}
trap cleanup EXIT
trap 'exit 130' INT
trap 'exit 143' TERM

docker image inspect "$app_image" >/dev/null
docker network create --internal --label "$label" "$name" >/dev/null
docker run --rm -d --name "$name-db" --label "$label" \
    --network "$name" --network-alias fixture-mysql \
    --tmpfs /var/lib/mysql:rw,nosuid,size=1g \
    -e MYSQL_RANDOM_ROOT_PASSWORD=yes -e MYSQL_DATABASE="$database" \
    -e MYSQL_USER=fixture -e MYSQL_PASSWORD=synthetic-test-only \
    "$mysql_image" >/dev/null

# TCP avoids accepting the entrypoint's temporary socket-only initialization server.
attempt=0
until docker exec "$name-db" mysqladmin --protocol=tcp --host=127.0.0.1 \
    --connect-timeout=2 ping --silent >/dev/null 2>&1; do
    attempt=$((attempt + 1))
    if [ "$attempt" -ge 60 ]; then
        printf '%s\n' 'FAIL: MySQL did not become ready within 120 seconds (logs withheld to protect generated root password).' >&2
        exit 1
    fi
    sleep 2
done

# env -i discards image defaults too; no host env file, source mount, or cached config.
docker run --rm -i --name "$name-app" --label "$label" --network "$name" \
    --entrypoint /usr/bin/env "$app_image" -i PATH=/usr/local/bin:/usr/bin:/bin HOME=/tmp \
    APP_ENV=testing APP_DEBUG=false APP_URL=http://localhost \
    DB_CONNECTION=mysql DB_HOST=fixture-mysql DB_PORT=3306 DB_DATABASE="$database" \
    DB_USERNAME=fixture DB_PASSWORD=synthetic-test-only \
    CACHE_STORE=database SESSION_DRIVER=database QUEUE_CONNECTION=sync \
    LOG_CHANNEL=stderr MAIL_MAILER=array \
    sh -eu -c '
        test ! -e .env && test ! -e .env.testing && test ! -e bootstrap/cache/config.php
        APP_KEY=$(php -r '\''echo "base64:".base64_encode(random_bytes(32));'\'')
        export APP_KEY
        php artisan migrate --force --no-interaction
        php artisan migrate --force --no-interaction
        php artisan migrate:status --no-interaction
        php /dev/stdin
    ' <<'PHP'
<?php
require '/app/vendor/autoload.php';
$app = require '/app/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
function check(bool $ok, string $message): void {
    if (! $ok) {
        throw new RuntimeException($message);
    }
}
$db = Illuminate\Support\Facades\DB::connection();
$version = $db->selectOne('SELECT VERSION() AS version')->version;
check(str_starts_with($version, '8.4.'), 'Expected MySQL 8.4.');
$expected = array_map(fn ($path) => basename($path, '.php'), glob('/app/database/migrations/*.php'));
$actual = $db->table('migrations')->orderBy('migration')->pluck('migration')->all();
sort($expected);
check($actual === $expected, 'Migration records do not match image migration files.');
check($db->table('migrations')->distinct()->pluck('batch')->all() === [1], 'Second migrate was not a no-op.');
check($db->table('users')->count() === 0, 'Fixture must not be seeded.');
Illuminate\Support\Facades\Cache::put('mysql-check', 'ready', 60);
check(Illuminate\Support\Facades\Cache::get('mysql-check') === 'ready', 'Database cache round-trip failed.');
Illuminate\Support\Facades\Cache::forget('mysql-check');
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
foreach (['/up', '/login2026'] as $path) {
    $request = Illuminate\Http\Request::create($path, 'GET');
    $response = $kernel->handle($request);
    check($response->getStatusCode() === 200, "GET $path failed: ".$response->getStatusCode());
    $kernel->terminate($request, $response);
}
check($db->table('sessions')->count() > 0, 'HTTP check did not persist a database session.');
printf("MySQL %s: %d migrations, second run no-op, database cache/session and kernel GET checks OK. Not UAT.\n", $version, count($actual));
PHP
