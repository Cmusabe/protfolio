#!/bin/bash
set +e

# Generate APP_KEY if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force 2>/dev/null || true
fi

# Run migrations (continue even if they fail)
php artisan migrate --force 2>/dev/null || echo "Migrations skipped or failed"

# Create storage link
php artisan storage:link 2>/dev/null || echo "Storage link skipped"

# Cache configuration (optional, continue if fails)
php artisan config:cache 2>/dev/null || true
php artisan route:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

# Start PHP server
exec php -S 0.0.0.0:$PORT -t public

