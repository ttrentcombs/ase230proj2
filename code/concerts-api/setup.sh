#!/usr/bin/env bash
set -e

cd "$(dirname "$0")/concerts-api"

echo "=== Copying .env.example to .env (if needed) ==="
if [ ! -f .env ]; then
  cp .env.example .env
  echo "  -> .env created from .env.example"
else
  echo "  -> .env already exists, leaving it as-is"
fi

echo "Generating APP_KEY"
php artisan key:generate --force

echo "Installing dependencies"
composer install --no-interaction --prefer-dist

echo "=== Running fresh database migrations ==="
php artisan migrate:fresh --force

echo "Setup complete."

