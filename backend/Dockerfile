FROM php:8.1-apache

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

COPY ./backend /var/www/html

RUN composer install --no-dev --working-dir=/var/www/html

COPY ./backend/000-default.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80