# ============================================
# Laras Banyuwangi — Dockerfile (multi-stage)
# ============================================

# ---- Base stage ----
FROM php:8.4-fpm-alpine AS base

RUN set -eux; \
    apk add --no-cache \
        postgresql-dev \
        libzip-dev \
        zip \
        unzip \
        git \
        curl \
        oniguruntime \
        libpng-dev \
        libjpeg-turbo-dev \
        freetype-dev \
        linux-headers \
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
    apk del linux-headers

# Install Composer
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# ---- Vendor stage ----
FROM base AS vendor-stage
COPY composer.json composer.lock ./
RUN composer install \
    --no-interaction \
    --no-dev \
    --no-scripts \
    --no-autoloader \
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

# ---- App stage ----
FROM base AS app
WORKDIR /app

# Copy app source
COPY --chown=www-data:www-data . .

# Copy built vendor
COPY --chown=www-data:www-data --from=vendor-stage /app/vendor ./vendor

# Copy built frontend assets
COPY --chown=www-data:www-data --from=frontend-stage /app/public/build ./public/build

# Copy compiled cache from bootstrap if exists
RUN if [ -f bootstrap/cache/packages.php ]; then \
        php artisan package:discover --ansi; \
        php artisan config:cache --ansi; \
        php artisan route:cache --ansi; \
        php artisan view:cache --ansi; \
    else \
        php artisan package:discover --ansi; \
    fi

# Storage permissions
RUN mkdir -p storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=10s --retries=3 \
    CMD php -r "echo 'ok';" || exit 1

EXPOSE 9000

USER www-data

CMD ["php-fpm"]
