<?php

// Run in the built image with --network none; never use an operator database.
require '/app/vendor/autoload.php';

function check(bool $condition, string $message): void
{
    if (! $condition) {
        throw new RuntimeException($message);
    }
}

check(getenv('APP_ENV') === 'testing' && getenv('DB_CONNECTION') === 'sqlite' && getenv('DB_DATABASE') === ':memory:', 'An isolated in-memory database is required.');
check(! getenv('DB_URL') && ! getenv('APP_CONFIG_CACHE') && ! file_exists('/app/bootstrap/cache/config.php'), 'Database overrides or cached runtime config are not allowed.');
putenv('APP_KEY=base64:'.base64_encode(random_bytes(32)));
check(! file_exists('/app/.env') && ! file_exists('/app/public/hot'), 'Local runtime files leaked into image.');
check(is_file('/app/public/build/manifest.json'), 'Built assets missing.');
check(realpath('/app/public/storage') === '/app/storage/app/public', 'Only public uploads may be linked.');
check(is_writable('/app/storage/app/private') && is_writable('/app/bootstrap/cache'), 'Runtime paths are not writable.');
check(extension_loaded('pdo_mysql') && extension_loaded('pdo_sqlite') && extension_loaded('pcntl') && ! extension_loaded('pdo_pgsql'), 'Runtime PHP extensions do not match the MySQL/Octane contract.');
check(is_file('/app/public/frankenphp-worker.php'), 'Octane worker stub missing.');

$app = require '/app/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
check(config('octane.server') === 'frankenphp' && config('permission.register_octane_reset_listener') === true, 'Octane runtime configuration missing.');
check(is_writable(dirname(config('octane.state_file'))), 'Octane server state directory is not writable.');
check($app->make('events')->hasListeners(Laravel\Octane\Contracts\OperationTerminated::class), 'Octane cleanup listeners missing.');
check(Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]) === 0, 'Isolated migrations failed.');
Illuminate\Support\Facades\Route::get('/__deployment_check', fn (Illuminate\Http\Request $request) => [
    'ip' => $request->ip(), 'secure' => $request->isSecure(),
]);
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
foreach (['192.0.2.10' => ['ip' => '198.51.100.7', 'secure' => true], '192.0.2.11' => ['ip' => '192.0.2.11', 'secure' => false]] as $peer => $expected) {
    $request = Illuminate\Http\Request::create('/__deployment_check', 'GET', server: [
        'REMOTE_ADDR' => $peer, 'HTTP_X_FORWARDED_FOR' => '198.51.100.7', 'HTTP_X_FORWARDED_PROTO' => 'https',
    ]);
    $response = $kernel->handle($request);
    check(json_decode($response->getContent(), true) === $expected, 'Forwarded headers trust boundary failed.');
    $kernel->terminate($request, $response);
}
foreach (['/up', '/login2026'] as $path) {
    $request = Illuminate\Http\Request::create($path, 'GET', server: ['HTTP_ACCEPT' => 'application/json']);
    $response = $kernel->handle($request);
    check($response->getStatusCode() === 200, "Smoke failed: $path");
    $kernel->terminate($request, $response);
}
fwrite(STDOUT, "Image, isolated migrations, proxy trust and application smoke: OK. Not UAT.\n");
