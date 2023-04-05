#!/bin/bash
set -e

echo "Deployment started ..."

# Enter maintenance mode or return true
# if already is in maintenance mode
(sudo php artisan down) || true

# Pull the latest version of the app
git pull origin

# Install composer dependencies
sudo composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Clear the old cache
sudo php artisan clear-compiled

# Recreate cache
sudo php artisan optimize

# Compile npm assets
npm run prod

# Run database migrations
sudo php artisan migrate --force

# Exit maintenance mode
sudo php artisan up

echo "Deployment finished!"
