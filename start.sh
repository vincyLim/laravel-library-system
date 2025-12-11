#!/bin/bash

# Remove any existing storage link
rm -f public/storage

# Create the proper storage link
php artisan storage:link

# Start the application
php -S 0.0.0.0:$PORT -t public