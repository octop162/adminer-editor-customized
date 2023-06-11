FROM php:7-apache

RUN apt update && apt install -y git

RUN docker-php-ext-install pdo_mysql mysqli
COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN ln -s /adminer/public /var/www/html/adminer 

WORKDIR /adminer
COPY ./adminer/composer.json /adminer/
RUN composer install
