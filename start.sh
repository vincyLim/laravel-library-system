#!/bin/bash

# Create required Laravel directories with proper permissions
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Set proper permissions for storage and cache directories
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Remove any existing storage link
rm -f public/storage

# Create the proper storage link
php artisan storage:link

# Clear and cache Laravel configurations
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Cache configurations for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start the application
php -S 0.0.0.0:$PORT -t public