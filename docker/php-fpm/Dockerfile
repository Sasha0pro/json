FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    wget \
    libmcrypt-dev \
    zlib1g-dev \
    libzip-dev \
    unzip

RUN docker-php-ext-install zip

RUN docker-php-ext-install pdo pdo_mysql

RUN pecl install xdebug && docker-php-ext-enable xdebug

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /symfony