# Railway Deployment Troubleshooting

## Check Build Logs

The build logs are available at:
- Railway Dashboard: https://railway.app/project/6b090475-483e-49a5-acec-9c994c0b9303
- Or use: `railway logs` (requires interactive mode)

## Common Build Failures

### 1. Missing Environment Variables

**Error**: `APP_KEY` is not set

**Solution**: 
1. Go to Railway Dashboard → Your Service → Variables
2. Add `APP_KEY` (generate with: `php artisan key:generate --show`)
3. Redeploy

### 2. npm ci Fails

**Error**: Package lock file issues

**Solution**:
- Ensure `package-lock.json` is committed to git
- Try: `npm install` locally, then commit `package-lock.json`
- Or change build command to use `npm install` instead of `npm ci`

### 3. npm run build Fails

**Error**: Vite build errors

**Solution**:
- Check if `resources/css/app.css` and `resources/js/app.js` exist
- Verify `vite.config.js` is correct
- Check build logs for specific Vite errors

### 4. Composer Install Fails

**Error**: Missing dependencies or memory issues

**Solution**:
- Check `composer.json` for valid dependencies
- Railway should handle this automatically
- Check build logs for specific Composer errors

### 5. Database Connection Issues

**Error**: Migrations fail during start

**Solution**:
- Ensure database service is added in Railway
- Verify `DATABASE_URL` is set automatically
- Check database is running before migrations

## Quick Fixes

### Update Build Command

If `npm ci` fails, update `railway.json`:

```json
{
  "build": {
    "buildCommand": "composer install --no-dev --optimize-autoloader && npm install && npm run build"
  }
}
```

### Skip Migrations During Start

If migrations are causing issues, update `start.sh` to skip them initially:

```bash
# Comment out migrations temporarily
# php artisan migrate --force || echo "Migrations failed, continuing..."
```

### Check Required Files

Ensure these files exist:
- `package.json` ✓
- `package-lock.json` ✓
- `composer.json` ✓
- `composer.lock` ✓
- `vite.config.js` ✓
- `resources/css/app.css` (check if exists)
- `resources/js/app.js` (check if exists)

## Next Steps

1. **Check Railway Dashboard** for detailed build logs
2. **Verify Environment Variables** are set correctly
3. **Test Build Locally**:
   ```bash
   composer install --no-dev --optimize-autoloader
   npm ci
   npm run build
   ```
4. **Redeploy** after fixing issues


