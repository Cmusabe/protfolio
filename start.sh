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
# Try multiple hostname variations
HOSTS_TO_TRY="${DB_HOST} mysql mysql.railway.internal"

for i in {1..60}; do
    for hostname in $HOSTS_TO_TRY; do
        if [ -z "$hostname" ] || [ "$hostname" = "not set" ]; then
            continue
        fi
        
        # Test connection with a simple PDO connection
        if php -r "
        try {
            \$host = '$hostname';
            \$port = getenv('DB_PORT') ?: '3306';
            \$db = getenv('DB_DATABASE') ?: 'railway';
            \$user = getenv('DB_USERNAME') ?: 'root';
            \$pass = getenv('DB_PASSWORD') ?: '';
            \$pdo = new PDO(\"mysql:host=\$host;port=\$port;dbname=\$db\", \$user, \$pass, [PDO::ATTR_TIMEOUT => 3]);
            \$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            \$pdo->query('SELECT 1');
            exit(0);
        } catch (Exception \$e) {
            exit(1);
        }
        " 2>/dev/null; then
            echo "Database connection successful with host: $hostname!"
            # Update DB_HOST if we found a working hostname
            if [ "$hostname" != "${DB_HOST}" ]; then
                export DB_HOST="$hostname"
                echo "Updated DB_HOST to: $hostname"
            fi
            DB_CONNECTED=true
            break 2
        fi
    done
    
    if [ $i -lt 60 ]; then
        echo "Attempt $i/60: Database not ready yet, waiting..."
        sleep 1
    fi
done

# Run migrations only if database is connected
if [ "$DB_CONNECTED" = true ]; then
    echo "Running database migrations..."
    php artisan migrate --force 2>/dev/null || echo "Migrations failed but continuing..."
    
    # Run seeders (they check for existing data themselves)
    echo "Running database seeders..."
    php artisan db:seed --force 2>/dev/null || echo "Seeders failed but continuing..."
else
    echo "WARNING: Database connection failed. Skipping migrations. App will start but database features may not work."
fi

# Create storage link
php artisan storage:link 2>/dev/null || echo "Storage link skipped"

# Cache configuration for production performance
echo "Caching configuration..."
# Clear caches again before caching to ensure fresh routes
php artisan route:clear 2>/dev/null || true
php artisan config:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true

# Wait a moment for file system to sync
sleep 1

# Now cache everything
php artisan config:cache 2>/dev/null || true
php artisan route:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

# Verify route cache was created successfully
if [ -f "bootstrap/cache/routes-v7.php" ] || [ -f "bootstrap/cache/routes.php" ]; then
    echo "Route cache created successfully"
else
    echo "WARNING: Route cache file not found, routes may not be cached"
fi

# Start PHP server on Railway's PORT (PORT is set by Railway automatically)
echo "Starting PHP server on port ${PORT:-8080}"
exec php -S 0.0.0.0:${PORT:-8080} -t public

