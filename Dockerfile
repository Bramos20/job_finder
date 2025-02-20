# Use PHP-FPM with Alpine for a smaller image
FROM php:8.2-fpm-alpine

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apk add --no-cache \
    curl \
    zip \
    unzip \
    git \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    autoconf \
    g++ \
    make && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo pdo_mysql mbstring gd
    
# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --no-interaction --prefer-dist

# Ensure correct permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose Railway’s expected port (9000)
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
