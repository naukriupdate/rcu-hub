# Hostinger Shared Hosting Deployment Guide — RCU Student Resource Hub

This guide walks you step-by-step through deploying the **RCU Student Resource Hub** onto Hostinger shared hosting (cPanel / hPanel).

---

## Prerequisites on Hostinger
1. **PHP Version:** Set to **PHP 8.2 or 8.3** in Hostinger hPanel -> Advanced -> PHP Configuration.
2. **PHP Extensions:** Ensure `pdo_mysql`, `curl`, `fileinfo`, `mbstring`, `openssl`, `zip` are enabled.
3. **Database:** Create a MySQL Database in Hostinger hPanel -> Databases -> MySQL Databases. Note down:
   - Database Name (e.g. `u123456789_rcu`)
   - Database Username (e.g. `u123456789_admin`)
   - Database Password

---

## Method A: Standard hPanel / File Manager Deployment

### Step 1: Upload Project Files
1. Compress your project into a `.zip` file (excluding `node_modules`).
2. In Hostinger hPanel -> **File Manager**, upload the zip file into your domain folder:
   - Path: `/home/u123456789/domains/yourdomain.com/`
3. Extract the contents.

### Step 2: Configure Document Root or Use Provided `.htaccess`
- **Option 1 (Recommended in hPanel):** Point your domain's Document Root directly to `/public` in your domain settings.
- **Option 2 (Default public_html):** Keep the root `.htaccess` file provided with this codebase. It automatically routes web traffic into the `public/` folder while securing `.env`, `storage/`, and system files from external web access.

### Step 3: Configure `.env`
1. Rename `.env.hostinger.example` to `.env` (or copy `.env.example`).
2. Update the following parameters:
   ```env
   APP_NAME="RCU Student Resource Hub"
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://yourdomain.com

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=u123456789_rcu
   DB_USERNAME=u123456789_admin
   DB_PASSWORD=YourDatabasePasswordHere

   SESSION_DRIVER=database
   CACHE_STORE=file
   QUEUE_CONNECTION=sync
   FILESYSTEM_DISK=local
   ```
3. Generate an application key if not set:
   ```bash
   php artisan key:generate --force
   ```

### Step 4: Run Migrations & Seeder
Open Hostinger **SSH Terminal** (or use Hostinger Web Terminal):
```bash
cd /home/u123456789/domains/yourdomain.com
php artisan migrate --force --seed
```

> **Note:** The seeder populates the initial faculties, courses (BCA, BBA, BA, B.Sc), semesters, subjects, resource categories, sample study resources, official RCU notices, and the default admin account:
> - **Admin Email:** `admin@rcu.edu`
> - **Admin Password:** `admin123`
> - **Admin Login URL:** `https://yourdomain.com/admin/login`

### Step 5: Storage & Cache Permissions
Ensure web server has write permissions:
```bash
chmod -R 775 storage bootstrap/cache
```

### Step 6: Configure Hostinger Cron Job (Automated RCU Notice Sync)
In Hostinger hPanel -> **Advanced -> Cron Jobs**, add a recurring cron job:
- **Type:** PHP Command
- **Interval:** Every 4 hours (or Every minute for full scheduler)
- **Command:**
  ```bash
  /usr/bin/php /home/u123456789/domains/yourdomain.com/artisan rcu:sync-notices >> /dev/null 2>&1
  ```
  *(Or standard Laravel scheduler:)*
  ```bash
  * * * * * /usr/bin/php /home/u123456789/domains/yourdomain.com/artisan schedule:run >> /dev/null 2>&1
  ```

---

## Security Best Practices
- Keep `APP_DEBUG=false` in production to prevent stack traces from revealing database credentials.
- Do not commit `.env` into version control.
- Change the default administrator password immediately after logging into `/admin/dashboard`.
