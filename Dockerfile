# Use the official PHP image with Apache
FROM php:8.2-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git zip unzip libpq-dev libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql gd mbstring zip exif pcntl bcmath opcache

# Enable Apache mod_rewrite (important for Laravel)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy composer from official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy existing app files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate key automatically (optional)
RUN php artisan key:generate

# Expose port 80 for web traffic
EXPOSE 80

# Set the entrypoint command
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
