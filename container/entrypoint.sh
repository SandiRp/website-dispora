#!/bin/sh
set -eu

if [ "${1:-}" = php ] && [ "${2:-}" = artisan ] && [ "${3:-}" = octane:frankenphp ]; then
    # Cache only runtime configuration; never migrate, seed, or rotate APP_KEY here.
    php artisan config:cache
    php artisan view:cache
fi

exec "$@"
