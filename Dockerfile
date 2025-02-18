# Use an official PHP runtime as a parent image
FROM php:8.2-cli

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

# Copy the application directory
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --no-interaction --prefer-dist

# Set permissions for storage and bootstrap/cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Run the Laravel application using the built-in PHP server (no need for PHP-FPM)
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
