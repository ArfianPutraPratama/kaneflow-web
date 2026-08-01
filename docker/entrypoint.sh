#!/bin/bash
set -e

# Pastikan semua direktori penting yang dibutuhkan Laravel tersedia
mkdir -p /var/www/html/storage/framework/{sessions,views,cache}
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/bootstrap/cache

# Pastikan kepemilikan dan hak akses direktori storage & cache tepat
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Tunggu sampai database siap jika DB_HOST terdefinisi
if [ -n "$DB_HOST" ] && [ "$DB_CONNECTION" = "mysql" ]; then
    echo "Waiting for MySQL/MariaDB database connection..."
    max_tries=30
    count=0
    until php -r "try { new PDO('mysql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT') . ';dbname=' . getenv('DB_DATABASE'), getenv('DB_USERNAME'), getenv('DB_PASSWORD')); } catch (Exception \$e) { exit(1); }" 2>/dev/null; do
        count=$((count+1))
        if [ $count -ge $max_tries ]; then
            echo "Warning: Database connection timeout. Continuing anyway..."
            break
        fi
        echo "Database not ready yet... waiting 2 seconds ($count/$max_tries)"
        sleep 2
    done
    echo "Database connection is ready!"
fi

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

# Optimasi konfigurasi dan routing untuk environment production jika bukan debug mode
if [ "$APP_ENV" = "production" ] && [ "$APP_DEBUG" = "false" ]; then
    echo "Caching Laravel config and routes..."
    php artisan config:cache || true
    php artisan route:cache || true
    php artisan view:cache || true
else
    echo "Clearing Laravel caches for debug/development..."
    php artisan optimize:clear || true
fi

# Jalankan Apache di foreground
exec apache2-foreground
