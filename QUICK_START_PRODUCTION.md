# Quick Start: Production Deployment Guide

## Prerequisites

- PHP >= 8.2 with extensions: BCMath, Ctype, cURL, DOM, Fileinfo, JSON, Mbstring, OpenSSL, PCRE, PDO, Tokenizer, XML
- Composer
- Node.js >= 18 & npm
- MySQL/PostgreSQL or SQLite
- Web server (Nginx/Apache)
- SSL certificate
- Git

## Step 1: Initial Server Setup

### 1.1 Install Required Software
```bash
# On Ubuntu/Debian
sudo apt update
sudo apt install php8.2 php8.2-cli php8.2-fpm php8.2-mysql php8.2-xml php8.2-mbstring php8.2-curl php8.2-zip
sudo apt install composer nginx mysql-server nodejs npm git
```

### 1.2 Create Database
```sql
CREATE DATABASE your_database_name;
CREATE USER 'your_db_user'@'localhost' IDENTIFIED BY 'strong_password';
GRANT ALL PRIVILEGES ON your_database_name.* TO 'your_db_user'@'localhost';
FLUSH PRIVILEGES;
```

## Step 2: Clone and Setup Application

```bash
# Clone repository
cd /var/www
git clone your-repository-url your-app-name
cd your-app-name

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

## Step 3: Configure Environment Variables

Edit `.env` file:

```env
APP_NAME="Your Store Name"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_db_user
DB_PASSWORD=strong_password

SESSION_DRIVER=database
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=lax

CACHE_STORE=database
QUEUE_CONNECTION=database

MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email@domain.com
MAIL_PASSWORD=your-email-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@yourdomain.com"
MAIL_FROM_NAME="${APP_NAME}"

# Add your payment gateway credentials
STRIPE_KEY=your_stripe_key
STRIPE_SECRET=your_stripe_secret
```

## Step 4: Install Dependencies and Build

```bash
# Install Composer dependencies (production only)
composer install --no-dev --optimize-autoloader

# Install NPM dependencies
npm ci

# Build assets for production
npm run build
```

## Step 5: Database Setup

```bash
# Run migrations
php artisan migrate --force

# (Optional) Seed initial data
php artisan db:seed
```

## Step 6: Configure Storage

```bash
# Create storage symlink
php artisan storage:link

# Set permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## Step 7: Optimize Application

```bash
# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Or use the deployment script
chmod +x deploy.sh
./deploy.sh
```

## Step 8: Configure Web Server

### Nginx Configuration (`/etc/nginx/sites-available/your-app`)

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name yourdomain.com www.yourdomain.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/your-app-name/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    add_header X-XSS-Protection "1; mode=block";

    index index.php;

    charset utf-8;

    # SSL Configuration
    ssl_certificate /path/to/ssl/certificate.crt;
    ssl_certificate_key /path/to/ssl/private.key;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    # Gzip compression
    gzip on;
    gzip_vary on;
    gzip_min_length 1024;
    gzip_types text/plain text/css text/xml text/javascript application/x-javascript application/xml+rss application/json;
}
```

Enable site:
```bash
sudo ln -s /etc/nginx/sites-available/your-app /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

### Apache Configuration

Ensure `mod_rewrite` is enabled and set document root to `/public` directory.

## Step 9: Setup Queue Workers

Create supervisor configuration (`/etc/supervisor/conf.d/laravel-worker.conf`):

```ini
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/your-app-name/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/www/your-app-name/storage/logs/worker.log
stopwaitsecs=3600
```

Start supervisor:
```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start laravel-worker:*
```

## Step 10: Setup SSL Certificate

### Using Let's Encrypt (Certbot)
```bash
sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com
```

## Step 11: Setup Automated Backups

Create backup script (`/usr/local/bin/backup-app.sh`):

```bash
#!/bin/bash
BACKUP_DIR="/backups"
APP_DIR="/var/www/your-app-name"
DATE=$(date +%Y%m%d_%H%M%S)

# Database backup
mysqldump -u your_db_user -p'your_password' your_database_name > $BACKUP_DIR/db_backup_$DATE.sql

# Files backup
tar -czf $BACKUP_DIR/files_backup_$DATE.tar.gz $APP_DIR/storage $APP_DIR/public/storage

# Keep only last 7 days of backups
find $BACKUP_DIR -type f -mtime +7 -delete
```

Add to crontab:
```bash
# Daily backup at 2 AM
0 2 * * * /usr/local/bin/backup-app.sh
```

## Step 12: Post-Deployment Verification

1. ✅ Visit https://yourdomain.com - site loads
2. ✅ Check admin panel access
3. ✅ Test product browsing
4. ✅ Test add to cart
5. ✅ Test checkout process
6. ✅ Verify emails are sending
7. ✅ Check error logs: `tail -f storage/logs/laravel.log`
8. ✅ Verify queue workers: `sudo supervisorctl status`
9. ✅ Test payment gateway (use test mode first)
10. ✅ Check SSL certificate validity

## Step 13: Monitoring Setup

### Setup Log Monitoring
```bash
# Install log viewer (optional)
composer require rap2hpoutre/laravel-log-viewer

# Or use Laravel Telescope for debugging (dev only)
composer require laravel/telescope --dev
php artisan telescope:install
php artisan migrate
```

### Setup Uptime Monitoring
- Use services like UptimeRobot, Pingdom, or StatusCake
- Monitor: https://yourdomain.com
- Set up alerts for downtime

## Common Issues & Solutions

### Issue: 500 Error
```bash
# Check logs
tail -f storage/logs/laravel.log

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Issue: Permission Errors
```bash
sudo chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

### Issue: Assets Not Loading
```bash
# Rebuild assets
npm run build

# Clear view cache
php artisan view:clear
```

### Issue: Queue Not Processing
```bash
# Check supervisor status
sudo supervisorctl status

# Restart workers
sudo supervisorctl restart laravel-worker:*

# Or run manually for testing
php artisan queue:work
```

## Security Checklist

- [ ] `APP_DEBUG=false` in production
- [ ] `APP_ENV=production`
- [ ] HTTPS enabled and forced
- [ ] Strong database passwords
- [ ] `.env` file not accessible via web
- [ ] Remove SQL dump files from public access
- [ ] Regular security updates
- [ ] Firewall configured
- [ ] Rate limiting enabled
- [ ] Admin panel protected

## Performance Tips

1. Enable OpCache in PHP
2. Use Redis for caching and sessions
3. Enable Gzip compression
4. Use CDN for static assets
5. Optimize images before upload
6. Use database query caching
7. Enable HTTP/2
8. Implement lazy loading for images

## Maintenance Commands

```bash
# Update application
git pull origin main
composer install --no-dev --optimize-autoloader
npm ci && npm run build
php artisan migrate --force
php artisan optimize

# Clear all caches
php artisan optimize:clear

# View logs
tail -f storage/logs/laravel.log

# Check queue status
php artisan queue:failed
```

## Need Help?

- Check Laravel logs: `storage/logs/laravel.log`
- Check web server logs: `/var/log/nginx/error.log` or `/var/log/apache2/error.log`
- Check PHP-FPM logs: `/var/log/php8.2-fpm.log`
- Review the full PRODUCTION_READINESS.md checklist


