FROM php:7.4-apache-bullseye

ENV APACHE_RUN_USER=daemon
ENV APACHE_PID_FILE=/tmp/apache2.pid

RUN apt update && apt install -y git wget \
 && apt-get clean \
 && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mysqli

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY --from=public.ecr.aws/awsguru/aws-lambda-adapter:0.7.1 /lambda-adapter /opt/extensions/lambda-adapter

RUN sed -i "s|Listen 80|Listen 8080|" /etc/apache2/ports.conf
RUN sed -i "s|VirtualHost \*:80|VirtualHost *:8080|" /etc/apache2/sites-enabled/000-default.conf

COPY adminer /adminer
RUN rmdir /var/www/html && ln -s /adminer/public /var/www/html

WORKDIR /adminer
RUN composer install

RUN wget https://github.com/vrana/adminer/releases/download/v4.8.1/editor-4.8.1.php -O /adminer/public/editor.php
RUN wget https://raw.githubusercontent.com/arcs-/Adminer-Material-Theme/master/adminer.css -O /adminer/public/adminer.css

COPY bootstrap /opt/bootstrap
ENTRYPOINT /opt/bootstrap