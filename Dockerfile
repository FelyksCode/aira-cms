# ---------- base system & PHP ----------
FROM php:8.3-fpm-alpine AS base

# Install system dependencies
RUN apk add --no-cache \
        nginx \
        supervisor \
        bash \
        git \
        curl \
        libpng-dev \
        libzip-dev \
        oniguruma-dev \
        acl

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql zip mbstring

WORKDIR /var/www/html

# Copy app files
COPY . .

# Copy config files (adjust paths as needed)
COPY --chmod=755 ./docker/nginx.conf /etc/nginx/nginx.conf
COPY --chmod=755 ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Composer install (production)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer \
    && composer install --optimize-autoloader --no-dev --no-interaction

# Permissions
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type f -exec chmod 644 {} \; \
    && find /var/www/html -type d -exec chmod 755 {} \;

# ---------- final runtime config ----------
EXPOSE 80

CMD ["/usr/bin/supervisord", "-n"]
