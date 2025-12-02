#!/usr/bin/env bash
set -e

# go to the Laravel project
cd "$(dirname "$0")/concerts-api"

echo "=== Installing PHP dependencies (composer install) ==="
composer install --no-interaction --prefer-dist

echo "=== Running database migrations ==="
php artisan migrate --force

echo "=== Starting Laravel development server on http://127.0.0.1:8000 ==="
php artisan serve --host=127.0.0.1 --port=8000
