FROM php:8.0.5-fpm-alpine

# CORY php.ini
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

# Composer install
COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

# install Node.js
RUN apk update \
    && apk add \
    git \
	nodejs \
	npm \
    zip \
    unzip \
    vim \
    && docker-php-ext-install pdo_mysql bcmath

WORKDIR /var/www/html