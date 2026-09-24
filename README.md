<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Deployment Dispora Jatim

Repo ini memiliki kode, dependency lock, Dockerfile production, `.dockerignore`,
dan GitLab CI untuk build/test/push. Compose, Caddyfile runtime, secret template,
skrip deploy dan rollback ada di repo `../deployment`, bukan disalin ke image.
Konfigurasi `docker/` lokal dan Compose development bukan stack production.

```sh
docker build --pull -t dispora-build:octane .
docker run --rm -i --network none --env APP_ENV=testing --env APP_DEBUG=false --env DB_CONNECTION=sqlite --env DB_DATABASE=:memory: --env CACHE_STORE=array --env SESSION_DRIVER=array --env QUEUE_CONNECTION=sync --env LOG_CHANNEL=stderr --env TRUSTED_PROXIES=192.0.2.10 dispora-build:octane php /dev/stdin < tests/Deployment/image-check.php
sh tests/Deployment/mysql-check.sh
```

- PHP 8.4 / Laravel 13, FrankenPHP + Octane 2.20, dua worker, recycle 500 request.
  Image berjalan sebagai UID/GID 33 dan membutuhkan mount Caddyfile dari repo
  deployment di `/etc/frankenphp/Caddyfile`. Listener internal HTTP `:8000`.
  CMD: `php artisan octane:frankenphp --host=0.0.0.0 --port=8000 --workers=2 --max-requests=500 --caddyfile=/etc/frankenphp/Caddyfile`.
  Admin Caddy hanya localhost:2019 dalam container untuk lifecycle Octane.
  Target database MySQL (`pdo_mysql`); SQLite tetap tersedia untuk test terisolasi.
  Composer platform 8.3.0 menjaga kompatibilitas minimum source/development;
  build tetap memeriksa extension dan platform PHP runtime sebenarnya.
- Build memakai `composer.lock` dan `package-lock.json`; Node hanya di build stage.
  Allowlist context tidak membawa environment, vendor/node_modules lokal, upload,
  SQLite/dump, log, cache generated atau `public/hot`.
- Asset build tanpa environment target menghasilkan URL relatif `/build`.
  Jika menambahkan `VITE_*` atau `ASSET_URL` saat build, tinjau ulang kemampuan
  promosi image antar-environment; jangan tanam secret di frontend.
- Startup hanya melakukan config/view cache. Tidak ada migration, seeding, atau
  key generation otomatis. Upload private dan public ada di `/app/storage/app`;
  hanya `storage/app/public` yang ditautkan ke public web root.
  Octane memakai lifecycle cleanup standar dan reset permission Spatie antar-request.
  State Octane di storage/logs bersifat ephemeral; recreate saat image/env berubah.
- `TRUSTED_PROXIES` dibaca melalui config cache; isi IP/CIDR proxy yang terverifikasi.
  Hanya forwarded IP dan scheme dipercaya; upstream harus mempertahankan Host
  publik serta menimpa header client palsu. Jangan gunakan wildcard.
- CI memiliki stage `validate` (`composer:2`, `composer validate --no-check-publish`)
  dan `image` (`quay.io/buildah/stable`). Buildah memakai `STORAGE_DRIVER=vfs`,
  `BUILDAH_FORMAT=docker`, `BUILDAH_ISOLATION=chroot`; tanpa Docker daemon/service
  atau tebakan tag runner. Operator harus menyediakan runner dengan izin namespace
  yang sesuai; konfigurasi ini tidak otomatis memberi privileged permission.
  Pipeline hanya untuk MR menuju `main` atau branch `main`, bukan tag/branch lain.
  MR hanya build/check; publish hanya dari `main` non-MR. Proteksi branch `main`.
  Tag pada `CI_REGISTRY_IMAGE` berbentuk `YYYY.MM.DD-<8hex>` dari delapan karakter
  pertama `CI_COMMIT_SHA`, memakai `TZ=Asia/Jakarta date --date="$CI_COMMIT_TIMESTAMP"
  +%Y.%m.%d`, bukan waktu pipeline/retry. Smoke tetap menjalankan PHP terisolasi
  dengan SQLite in-memory dan network none: `buildah from`, `copy`, lalu `run`.
  Working container disposable dihapus sebelum push, juga melalui trap saat gagal;
  image yang dipush tidak berisi perubahan smoke. Kegagalan sebelum push menghentikan job.
  GitLab Registry WAJIB mengaktifkan immutable-tag rule untuk pola rilis ini
  sebelum pipeline release dijalankan. Ini persyaratan eksternal yang belum
  diverifikasi oleh skrip/mock; dukungan fitur saja tidak cukup.
  Protected tag membatasi penulis tetapi bukan pengganti immutable-tag rule.
  Push ke tag existing harus ditolak registry; job gagal tanpa menghapus atau
  menimpa tag. Retry setelah push berhasil dapat ditolak juga; gunakan artefak
  rilis sukses atau verifikasi digest registry, jangan menonaktifkan policy.
  Setelah push berhasil, artefak `release.env` mencatat `APP_IMAGE` bertag,
  `APP_IMAGE_DIGEST=repo@sha256:...` dari `buildah push --digestfile`, dan
  `SOURCE_COMMIT`. Login memakai password stdin dan authfile sementara yang dihapus.
  Deployment di branch `production`
  memakai referensi tersebut; disarankan mengisi `APP_IMAGE` operator dengan
  nilai `APP_IMAGE_DIGEST`. Tidak ada SSH/deploy target dari pipeline source.
  `sh tests/Deployment/ci-check.sh` menguji alur dengan Buildah mock, tanpa push.
  Opsi `--config` memvalidasi YAML/job/rules memakai container Ruby disposable
  (Docker lokal hanya untuk check ini, bukan dependency pipeline Buildah).
- Check image menguji migration SQLite in-memory dan smoke aplikasi, bukan seluruh
  suite Breeze, TLS, login browser, atau UAT. Tidak menjalankan seed.
  `mysql-check.sh` memakai MySQL 8.4 disposable, network internal, tanpa published
  port/volume host: migration, idempotensi, cache/session database dan request kernel.
  Test HTTP Octane satu worker, session A/B/guest, CSRF dan restart ada di runbook
  repo deployment; bukan pengganti audit authorization atau uji beban.
  Build lokal Docker berhasil. Buildah nyata pada host pengujian terhalang
  `unshare(CLONE_NEWUSER): Operation not permitted`; mock/rules CI lulus,
  tetapi job Buildah nyata tetap harus diuji pada runner GitLab yang sesuai.
- Jangan public go-live sebelum blocker akses admin/registrasi dan dokumen private
  dalam runbook deployment diperbaiki dan diuji. Seeder bawaan tidak boleh dijalankan
  otomatis: ada akun privileged dengan password hard-coded.

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
