#!/bin/bash
set -e

# Generate APP_KEY if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Run migrations (continue even if they fail)
php artisan migrate --force || echo "Migrations failed, continuing..."

# Create storage link
php artisan storage:link || echo "Storage link already exists or failed"

# Cache configuration
php artisan config:cache || echo "Config cache failed, continuing..."
php artisan route:cache || echo "Route cache failed, continuing..."
php artisan view:cache || echo "View cache failed, continuing..."

# Start PHP server
exec php -S 0.0.0.0:$PORT -t public

