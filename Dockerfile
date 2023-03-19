FROM php:8.1.0-fpm-alpine

RUN apk --no-cache add postgresql-dev
RUN docker-php-ext-install pdo pdo_pgsql
RUN apk add --no-cache zip libzip-dev libpng-dev
RUN docker-php-ext-install zip
RUN docker-php-ext-install gd
