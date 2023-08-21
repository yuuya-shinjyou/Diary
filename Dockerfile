# Dockerfile
FROM php:8.1-cli

RUN apt-get update -q

RUN apt-get install -y gcc

RUN apt-get install -y make autoconf libc-dev pkg-config libzip-dev

RUN pecl install xdebug && docker-php-ext-enable xdebug