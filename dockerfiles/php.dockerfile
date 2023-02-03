FROM php:8.1-fpm

RUN apt-get update  \
    && apt-get install -y \
    bash \
    git \
    curl \
    zip \
    vim \
    unzip \
    libicu-dev

WORKDIR /var/www/html

COPY src .

RUN docker-php-ext-install pdo pdo_mysql

RUN chown -R www-data:www-data /var/www/html

#RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel

#USER laravel