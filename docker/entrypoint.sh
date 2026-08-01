#!/bin/bash
set -e

# Pastikan kepemilikan dan hak akses direktori storage & cache tepat
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Jalankan migrasi database jika variabel RUN_MIGRATIONS diatur ke "true"
if [ "$RUN_MIGRATIONS" = "true" ]; then
    echo "Running database migrations..."
    php artisan migrate --force || true
fi

# Buat symbolic link untuk public storage jika belum ada
if [ ! -L /var/www/html/public/storage ]; then
    echo "Creating storage link..."
    php artisan storage:link || true
fi

# Optimasi konfigurasi dan routing untuk environment production
if [ "$APP_ENV" = "production" ]; then
    echo "Caching Laravel config and routes..."
    php artisan config:cache || true
    php artisan route:cache || true
    php artisan view:cache || true
fi

# Jalankan Apache di foreground
exec apache2-foreground
