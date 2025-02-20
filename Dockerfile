# Use PHP with Alpine as base image
FROM php:8.2-fpm-alpine

# Set working directory
WORKDIR /var/www

# Install system dependencies
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
    make

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring gd

# Expose the port Railway uses
EXPOSE 9000

# Start the PHP process (only if necessary)
CMD ["php-fpm"]
