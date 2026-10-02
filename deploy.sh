#!/bin/bash
# ==============================================================================
# CodePortLab Automated cPanel Deployment Script
# Domain: codeportlab.com
# Stack: CloudLinux 7 / MultiPHP 8.1 / Apache / Laravel 10/11 / Filament v3
# ==============================================================================

set -e

echo "----------------------------------------------------"
echo "🚀 Starting CodePortLab cPanel Deployment..."
echo "----------------------------------------------------"

# 1. Put application into maintenance mode
echo "📦 Step 1: Entering maintenance mode..."
php artisan down --retry=60 || true

# 2. Pull latest code from GitHub main branch
echo "🔄 Step 2: Pulling latest changes from Git..."
git pull origin main

# 3. Install/Optimize Composer Dependencies
echo "⚡ Step 3: Installing optimized composer dependencies..."
composer install --no-dev --optimize-autoloader

# 4. Run database migrations
echo "🗄️ Step 4: Running database migrations..."
php artisan migrate --force

# 5. Clear and Cache Application Configuration
echo "⚙️ Step 5: Caching configuration..."
php artisan config:cache

# 6. Cache Application Routes
echo "🗺️ Step 6: Caching routes..."
php artisan route:cache

# 7. Cache Blade Views
echo "🖼️ Step 7: Caching compiled views..."
php artisan view:cache

# 8. Optimize Filament Admin Panel
echo "🎨 Step 8: Optimizing Filament Admin Panel..."
php artisan filament:optimize

# 9. Set strict permissions for storage and cache directories
echo "🔒 Step 9: Setting directory permissions..."
chmod -R 755 storage bootstrap/cache

# 10. Bring application back online
echo "✅ Step 10: Bringing application online..."
php artisan up

echo "----------------------------------------------------"
echo "🎉 CodePortLab Deployment Completed Successfully!"
echo "----------------------------------------------------"
