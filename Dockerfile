# Use PHP 8.2 FPM Alpine as base
FROM php:8.2-fpm-alpine

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apk add --no-cache \
    curl zip unzip git \
    libpng-dev libjpeg-turbo-dev freetype-dev \
    oniguruma-dev nginx supervisor

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo pdo_mysql mbstring gd

# Copy composer and install dependencies
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY . /var/www

# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose port 9000
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
