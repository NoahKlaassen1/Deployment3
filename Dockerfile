# ---- Stage 1: Build and install dependencies ----
FROM php:8.3-fpm AS build

# Install system dependencies (incl. sqlite dev)
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev libsqlite3-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip pdo_sqlite \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy composer files for caching
COPY composer.json composer.lock ./

# Install dependencies (including dev for build/CI; we'll optimize later)
RUN composer install --no-interaction --prefer-dist

# Copy app
COPY . .

# Optimize autoloader
RUN composer dump-autoload --optimize

# ---- Stage 2: Production image ----
FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev libzip-dev libsqlite3-dev \
    && docker-php-ext-install pdo_mysql mbstring bcmath gd zip pdo_sqlite \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www

# Copy built app from previous stage
COPY --from=build /var/www /var/www

# Copy entrypoint script
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Set permissions for storage & cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose PHP-FPM port
EXPOSE 9000

# Use entrypoint to run migrations then php-fpm
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]
