# Use an official PHP runtime as a parent image
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    curl \
    zip \
    unzip \
    git \
    libonig-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory
COPY . .

# Set file permissions for storage and bootstrap/cache (to avoid permission issues)
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Install PHP dependencies (This step is important after copying your code)
RUN composer install --no-dev --no-interaction --prefer-dist

# Expose the port PHP-FPM listens on
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
