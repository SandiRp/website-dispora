# syntax=docker/dockerfile:1
FROM docker.io/dunglas/frankenphp:1-php8.4-bookworm AS php-base
# ponytail: runner generates a 0640 resolver per RUN; remove chmods after runner permissions are fixed.
RUN chmod 0644 /etc/resolv.conf && install-php-extensions pdo_mysql pdo_sqlite mbstring dom opcache pcntl
WORKDIR /app

FROM php-base AS dependencies
RUN chmod 0644 /etc/resolv.conf && apt-get update && apt-get install -y --no-install-recommends unzip && rm -rf /var/lib/apt/lists/*
COPY --from=docker.io/library/composer:2 /usr/bin/composer /usr/local/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --no-interaction --no-progress

FROM docker.io/library/node:22-bookworm-slim AS assets
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci --ignore-scripts
COPY vite.config.js postcss.config.js tailwind.config.js ./
COPY resources ./resources
COPY --from=dependencies /app/vendor/laravel/framework/src/Illuminate/Pagination/resources/views ./vendor/laravel/framework/src/Illuminate/Pagination/resources/views
RUN npm run build

FROM dependencies AS application
COPY app ./app
COPY bootstrap ./bootstrap
COPY config ./config
COPY database/migrations ./database/migrations
COPY database/seeders ./database/seeders
COPY routes ./routes
COPY artisan ./
RUN mkdir -p bootstrap/cache storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs \
    && composer dump-autoload --no-dev --classmap-authoritative --no-interaction \
    && composer check-platform-reqs --no-dev

FROM php-base AS runtime
COPY --from=application /app /app
COPY resources/views ./resources/views
COPY public/index.php public/favicon.ico public/robots.txt ./public/
COPY public/css ./public/css
COPY public/js ./public/js
COPY public/images ./public/images
COPY --from=assets /app/public/build ./public/build
COPY container/php.ini /usr/local/etc/php/conf.d/99-app.ini
COPY --chmod=755 container/entrypoint.sh /usr/local/bin/app-entrypoint
RUN mkdir -p storage/app/private storage/app/public \
    && cp vendor/laravel/octane/src/Commands/stubs/frankenphp-worker.php public/frankenphp-worker.php \
    && ln -s /app/storage/app/public public/storage \
    && chmod -R a+rX /app \
    && chown -R www-data:www-data storage bootstrap/cache \
    && mkdir -p /tmp/caddy-data /tmp/caddy-config \
    && chown -R www-data:www-data /tmp/caddy-data /tmp/caddy-config
ENV XDG_DATA_HOME=/tmp/caddy-data XDG_CONFIG_HOME=/tmp/caddy-config
USER www-data
RUN php -r 'require "/app/vendor/autoload.php";'
EXPOSE 8000
ENTRYPOINT ["app-entrypoint"]
CMD ["php", "artisan", "octane:frankenphp", "--host=0.0.0.0", "--port=8000", "--workers=2", "--max-requests=500", "--caddyfile=/etc/frankenphp/Caddyfile"]
