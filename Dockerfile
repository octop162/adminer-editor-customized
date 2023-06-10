FROM php:apache

RUN apt update && apt install -y git

RUN docker-php-ext-install pdo_mysql mysqli
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer install

RUN ln -s /adminer/public /var/www/html/adminer 
RUN chown www-data:www-data /adminer/log
