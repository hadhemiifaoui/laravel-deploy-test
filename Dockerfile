FROM php:8.2-apache

# Install dependencies including PostgreSQL PDO driver
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip git unzip libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql pdo_pgsql

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy app files
COPY . .

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Ensure storage & cache are writable
RUN mkdir -p storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Copy .env.example as .env
RUN cp .env.example .env

# Generate Laravel key
RUN php artisan key:generate --ansi

# Set correct permissions for www-data
RUN chown -R www-data:www-data storage bootstrap/cache

# Set Apache DocumentRoot to public folder
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Expose port 80
EXPOSE 80

# Use start.sh to run migrations and start Apache
CMD ["./start.sh"]
