FROM php:8.2-apache

# install necessairy dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip git unzip libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql pdo_pgsql


RUN a2enmod rewrite

#intialiser le working directory
WORKDIR /var/www/html

#copy all the app file 
COPY . .

#  make the start.sh executable in the container
RUN chmod +x start.sh


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


RUN composer install --no-dev --optimize-autoloader


RUN mkdir -p storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache


RUN cp .env.example .env

RUN php artisan key:generate --ansi

RUN chown -R www-data:www-data storage bootstrap/cache


RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf


EXPOSE 80


CMD ["./start.sh"]
