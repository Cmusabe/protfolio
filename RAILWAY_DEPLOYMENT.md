# Railway Deployment Guide

This guide will help you deploy your Laravel application to Railway.

## Prerequisites

- A Railway account ([railway.app](https://railway.app))
- GitHub repository connected to Railway
- Railway CLI (optional, for local testing)

## Step 1: Connect Your Repository

1. Log in to [Railway](https://railway.app)
2. Click "New Project"
3. Select "Deploy from GitHub repo"
4. Choose your repository: `Cmusabe/protfolio`
5. Railway will automatically detect it's a Laravel application

## Step 2: Add Database Service

1. In your Railway project, click "New"
2. Select "Database"
3. Choose either:
   - **MySQL** (recommended for this project)
   - **PostgreSQL** (also supported)

Railway will automatically create a `DATABASE_URL` environment variable.

## Step 3: Configure Environment Variables

Go to your service's "Variables" tab and add the following environment variables:

### Required Variables

```bash
APP_NAME=YourAppName
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://your-app-name.up.railway.app

# Database (Railway provides DATABASE_URL automatically)
# If using individual variables instead:
DB_CONNECTION=mysql
# DB_CONNECTION=pgsql  # if using PostgreSQL

# Session (required for admin login)
SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_SECURE_COOKIE=true

# Cache
CACHE_STORE=file

# Queue
QUEUE_CONNECTION=sync
```

### Optional Variables

```bash
# Mail Configuration (if sending emails)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"

# Filesystem
FILESYSTEM_DISK=local

# Redis (if using Redis service on Railway)
REDIS_HOST=your-redis-host
REDIS_PASSWORD=your-redis-password
REDIS_PORT=6379
```

### Generate APP_KEY

If you don't have an `APP_KEY` yet, generate one locally:

```bash
php artisan key:generate --show
```

Copy the output and set it as `APP_KEY` in Railway.

### Update APP_URL

After deployment, Railway will provide a public URL. Update the `APP_URL` variable with your actual Railway domain (e.g., `https://your-app-name.up.railway.app`).

## Step 4: Configure Build and Start Commands

Railway should automatically detect the configuration from `railway.json` and `nixpacks.toml`. If not, manually set:

### Build Command
```bash
composer install --no-dev --optimize-autoloader && npm ci && npm run build
```

### Start Command
```bash
php artisan migrate --force && php artisan storage:link && php artisan config:cache && php artisan route:cache && php artisan view:cache && php -S 0.0.0.0:$PORT -t public
```

## Step 5: Deploy

1. Railway will automatically deploy when you push to your main branch
2. Or click "Deploy" in the Railway dashboard
3. Monitor the deployment logs for any errors

## Step 6: Run Database Migrations

Migrations should run automatically via the start command. If you need to run them manually:

1. Go to your service in Railway
2. Click on the service
3. Open the "Deployments" tab
4. Click on the latest deployment
5. Open the terminal/console
6. Run: `php artisan migrate --force`

## Step 7: Create Storage Link

The storage link is created automatically in the start command. If you need to create it manually:

```bash
php artisan storage:link
```

## Step 8: Verify Deployment

1. Check the deployment logs for any errors
2. Visit your Railway-provided URL
3. Test the application functionality
4. Verify admin login works at `/admin`

## Production Optimizations

The following optimizations are already configured:

- **Config Caching**: `php artisan config:cache`
- **Route Caching**: `php artisan route:cache`
- **View Caching**: `php artisan view:cache`
- **Autoloader Optimization**: `composer install --optimize-autoloader`

These run automatically during deployment.

## Troubleshooting

### Database Connection Issues

- Verify `DATABASE_URL` is set correctly
- Check that the database service is running
- Ensure `DB_CONNECTION` matches your database type (mysql/pgsql)

### Storage Issues

- Ensure `storage:link` command ran successfully
- Check file permissions on storage directories
- Verify `FILESYSTEM_DISK` is set correctly

### Session Issues

- Verify `SESSION_DRIVER` is set (file or database)
- Check `SESSION_SECURE_COOKIE` is `true` for HTTPS
- Ensure storage directory is writable

### Asset Loading Issues

- Verify `npm run build` completed successfully
- Check that `APP_URL` is set correctly
- Ensure Vite build output is in `public/build`

### 500 Errors

- Check deployment logs for specific errors
- Verify `APP_KEY` is set
- Ensure all required environment variables are configured
- Check Laravel logs: `storage/logs/laravel.log`

## Custom Domain (Optional)

1. Go to your service settings
2. Click "Networking"
3. Add your custom domain
4. Update `APP_URL` to match your custom domain

## Monitoring

- View logs in Railway dashboard
- Set up error tracking (e.g., Sentry)
- Monitor database performance
- Check application metrics in Railway dashboard

## Additional Resources

- [Railway Documentation](https://docs.railway.app)
- [Laravel Deployment Documentation](https://laravel.com/docs/deployment)
- [Railway Discord Community](https://discord.gg/railway)

## Notes

- Railway automatically provides the `PORT` environment variable
- The `DATABASE_URL` is automatically set when you add a database service
- All migrations run automatically on each deployment
- Storage link is created automatically
- Production optimizations are applied automatically


