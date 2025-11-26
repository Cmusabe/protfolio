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

# Wait for database to be ready (max 30 seconds)
echo "Waiting for database connection..."
echo "DB_HOST: ${DB_HOST:-not set}"
echo "DB_PORT: ${DB_PORT:-not set}"
echo "DB_DATABASE: ${DB_DATABASE:-not set}"

DB_CONNECTED=false
for i in {1..30}; do
    # Test connection with a simple PDO connection
    if php -r "
    try {
        \$host = getenv('DB_HOST') ?: 'mysql.railway.internal';
        \$port = getenv('DB_PORT') ?: '3306';
        \$db = getenv('DB_DATABASE') ?: 'railway';
        \$user = getenv('DB_USERNAME') ?: 'root';
        \$pass = getenv('DB_PASSWORD') ?: '';
        \$pdo = new PDO(\"mysql:host=\$host;port=\$port;dbname=\$db\", \$user, \$pass, [PDO::ATTR_TIMEOUT => 2]);
        \$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        \$pdo->query('SELECT 1');
        exit(0);
    } catch (Exception \$e) {
        exit(1);
    }
    " 2>/dev/null; then
        echo "Database connection successful!"
        DB_CONNECTED=true
        break
    fi
    echo "Attempt $i/30: Database not ready yet, waiting..."
    sleep 1
done

# Run migrations only if database is connected
if [ "$DB_CONNECTED" = true ]; then
    echo "Running database migrations..."
    php artisan migrate --force 2>/dev/null || echo "Migrations failed but continuing..."
else
    echo "WARNING: Database connection failed. Skipping migrations. App will start but database features may not work."
fi

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

