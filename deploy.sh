#!/bin/bash

# Production Deployment Script for Laravel E-commerce
# Run this script on your production server after initial setup

set -e

echo "🚀 Starting production deployment..."

# Check if we're in production environment
if [ "$APP_ENV" != "production" ]; then
    echo "⚠️  Warning: APP_ENV is not set to 'production'"
    read -p "Continue anyway? (y/n) " -n 1 -r
    echo
    if [[ ! $REPLY =~ ^[Yy]$ ]]; then
        exit 1
    fi
fi

# Install/Update Composer dependencies
echo "📦 Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Install/Update NPM dependencies and build assets
echo "📦 Installing NPM dependencies and building assets..."
npm ci --production
npm run build

# Run database migrations
echo "🗄️  Running database migrations..."
php artisan migrate --force

# Create storage symlink if it doesn't exist
if [ ! -L public/storage ]; then
    echo "🔗 Creating storage symlink..."
    php artisan storage:link
fi

# Clear and cache configuration
echo "⚙️  Optimizing configuration..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear
php artisan cache:clear

# Cache configuration for production
echo "💾 Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Set proper permissions
echo "🔐 Setting permissions..."
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Final optimization
echo "✨ Running final optimization..."
php artisan optimize

echo "✅ Deployment complete!"
echo ""
echo "⚠️  Don't forget to:"
echo "   1. Start/restart queue workers: php artisan queue:work"
echo "   2. Restart web server (nginx/apache)"
echo "   3. Verify application is running"
echo "   4. Check error logs"


