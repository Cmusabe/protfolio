# Railway Database Setup Guide

## Setting Database Variables

Railway automatically provides database connection variables when you add a MySQL service. However, you may need to reference them in your application service.

### Option 1: Use Railway Service References (Recommended)

In the Railway dashboard:
1. Go to your **protfolio** service
2. Click on **Variables**
3. Add these variables using Railway's service reference syntax:

```
DB_DATABASE=${{MySQL.MYSQLDATABASE}}
DB_USERNAME=${{MySQL.MYSQLUSER}}
DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}
```

Or if using root:
```
DB_DATABASE=${{MySQL.MYSQLDATABASE}}
DB_USERNAME=root
DB_PASSWORD=${{MySQL.MYSQLROOTPASSWORD}}
```

### Option 2: Get Values from MySQL Service

1. Go to your **MySQL** service in Railway dashboard
2. Click on **Variables** tab
3. Find these variables:
   - `MYSQLDATABASE` - Database name
   - `MYSQLUSER` - Database user
   - `MYSQLPASSWORD` - Database password
   - `MYSQLROOTPASSWORD` - Root password (if needed)

4. Set them in your **protfolio** service:
   ```bash
   railway variables --set "DB_DATABASE=your_database_name"
   railway variables --set "DB_USERNAME=your_username"
   railway variables --set "DB_PASSWORD=your_password"
   ```

### Option 3: Use DATABASE_URL (Automatic)

Railway may automatically set `DATABASE_URL`. Check if it exists:
```bash
railway variables
```

If `DATABASE_URL` is set, Laravel will use it automatically (already configured in `config/database.php`).

## Current Database Configuration

Your Laravel app is configured to use:
- **Connection**: MySQL
- **Host**: `mysql.railway.internal` (private network)
- **Port**: `3306`

## Verify Connection

After setting the variables, test the connection:
1. Deploy your application
2. Check the logs for any database connection errors
3. The migrations should run automatically via `start.sh`

## Troubleshooting

If you see connection errors:
1. Verify all database variables are set correctly
2. Check that MySQL service is running
3. Ensure both services are in the same Railway project
4. Verify the host is `mysql.railway.internal` (private network)


