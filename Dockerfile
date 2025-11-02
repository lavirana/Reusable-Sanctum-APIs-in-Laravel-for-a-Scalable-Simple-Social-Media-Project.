# Use official PHP image with extensions
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev && \
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

    # Install Composer
    COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

    # Set working directory
    WORKDIR /var/www/html

    # Copy project files
    COPY . .

    # Install dependencies
    RUN composer install

    # Copy existing Laravel environment file
    COPY .env .env

    # Generate app key
    RUN php artisan key:generate

    CMD ["php-fpm"]

