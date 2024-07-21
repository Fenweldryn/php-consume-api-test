FROM php:8.1-apache

RUN a2enmod rewrite

COPY ./backend /var/www/html

COPY ./backend/000-default.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80