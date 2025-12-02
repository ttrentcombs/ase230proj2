#!/usr/bin/env bash
set -e

# go to the folder where docker-compose.yml lives
cd "$(dirname "$0")"

echo "=== Building and starting Docker containers ==="
docker compose up --build
