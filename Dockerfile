# ==========================================
# Stage 1: Build Frontend Assets (Vite / Tailwind CSS 4)
# ==========================================
FROM node:20-alpine AS frontend
WORKDIR /app

COPY package*.json vite.config.js ./
RUN npm ci

COPY resources ./resources
COPY public ./public
RUN npm run build

# ==========================================
# Stage 2: Production PHP/Apache Server
# ==========================================
FROM php:8.3-apache

# Install dependencies sistem & ekstensi PHP yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    libicu-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Aktifkan mod_rewrite Apache untuk routing Laravel
RUN a2enmod rewrite

# Atur DocumentRoot Apache ke folder /public Laravel
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy file konfigurasi composer dan install dependencies tanpa dev
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# Copy seluruh file project
COPY . .

# Copy aset build Vite dari stage frontend
COPY --from=frontend /app/public/build ./public/build

# Dump autoloader production
RUN composer dump-autoload --optimize

# Atur permission direktori storage & bootstrap/cache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Copy entrypoint script
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
