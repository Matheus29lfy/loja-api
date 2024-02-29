FROM php:8.2.12-fpm

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

CMD ["php-fpm"]

EXPOSE 9000
