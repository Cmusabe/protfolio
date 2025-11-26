#!/bin/bash
set +e

# Clear all caches first to ensure fresh database connection
echo "Clearing Laravel caches..."
php artisan config:clear 2>/dev/null || true
php artisan route:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true

# Generate APP_KEY if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force 2>/dev/null || true
fi

# Wait for database to be ready (max 60 seconds)
echo "Waiting for database connection..."
for i in {1..60}; do
    if php artisan migrate:status 2>/dev/null; then
        echo "Database connection successful!"
        break
    fi
    echo "Attempt $i/60: Database not ready yet, waiting..."
    sleep 1
done

# Run migrations (continue even if they fail)
echo "Running database migrations..."
php artisan migrate --force 2>/dev/null || echo "Migrations skipped or failed"

# Create storage link
php artisan storage:link 2>/dev/null || echo "Storage link skipped"

# Cache configuration for production performance
echo "Caching configuration..."
php artisan config:cache 2>/dev/null || true
php artisan route:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

# Start PHP server on Railway's PORT (PORT is set by Railway automatically)
echo "Starting PHP server on port ${PORT:-8080}"
exec php -S 0.0.0.0:${PORT:-8080} -t public

