#!/usr/bin/env bash
set -e

# Always run from the /code directory
cd "$(dirname "$0")"

echo "=== Stopping any existing containers ==="
docker compose down --remove-orphans || true

echo "=== Building Docker images ==="
docker compose build --no-cache

echo "=== Starting Docker containers ==="
docker compose up
