FROM php:7-apache

RUN apt-get update && apt-get install --assume-yes --fix-missing libicu-dev git unzip
RUN docker-php-ext-install intl

RUN a2enmod rewrite && service apache2 restart

COPY . /var/www/html/
WORKDIR /var/www/html/

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN php composer.phar install --no-interaction --no-dev --optimize-autoloader

EXPOSE 80
