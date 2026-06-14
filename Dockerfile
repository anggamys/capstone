# ============================================
# Laras Banyuwangi — Dockerfile (single container)
# Nginx + PHP-FPM + Supervisor
# ============================================

# ---- Vendor stage ----
FROM composer:2.8 AS vendor-stage
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install \
    --no-interaction \
    --no-dev \
    --no-scripts \
    --prefer-dist \
    --optimize-autoloader

# ---- Frontend stage ----
FROM node:22-alpine AS frontend-stage
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci --ignore-scripts && npm rebuild --ignore-scripts
COPY postcss.config.js tailwind.config.js vite.config.js ./
COPY resources/ resources/
RUN npx vite build

# ---- Final stage: Nginx + PHP + Supervisor ----
FROM php:8.4-fpm-alpine

# Install system dependencies + Nginx + Supervisor
RUN set -eux; \
    apk add --no-cache \
        nginx \
        supervisor \
        postgresql-dev \
        libzip-dev \
        zip \
        unzip \
        git \
        curl \
        oniguruma-dev \
        libpng-dev \
        libjpeg-turbo-dev \
        freetype-dev \
    ; \
    docker-php-ext-configure gd --with-freetype --with-jpeg; \
    docker-php-ext-install -j$(nproc) \
        pdo_pgsql \
        pgsql \
        pcntl \
        bcmath \
        gd \
        zip \
        mbstring \
        exif \
    ; \
    # Cleanup
    docker-php-source delete; \
    rm -rf /var/cache/apk/* /tmp/*

# Install Composer
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy app source
COPY . .

# Copy built vendor
COPY --from=vendor-stage /app/vendor ./vendor

# Generate optimized autoloader
RUN composer dump-autoload --optimize --no-dev --ansi

# Copy built frontend assets
COPY --from=frontend-stage /app/public/build ./public/build

# Laravel: package discovery + storage permissions
# NOTE: config:cache/route:cache not run at build time —
# they run at container start via entrypoint.sh to respect
# runtime environment variables.
RUN set -eux; \
    php artisan package:discover --ansi; \
    mkdir -p storage/framework/cache/data \
             storage/framework/sessions \
             storage/framework/views \
             storage/logs \
             /var/log/supervisord; \
    chmod -R 775 storage bootstrap/cache; \
    chown -R www-data:www-data storage bootstrap/cache

# Nginx config
COPY docker/nginx/conf.d/default.conf /etc/nginx/http.d/default.conf

# Supervisor config
COPY docker/supervisord.conf /etc/supervisor/supervisord.conf

# PHP config
COPY docker/php/php.ini /usr/local/etc/php/conf.d/app.ini

# Remove default nginx site
RUN rm -f /etc/nginx/http.d/default.conf

# Entrypoint
COPY docker/entrypoint/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 8000

ENTRYPOINT ["/entrypoint.sh"]
