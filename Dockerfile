
FROM php:8.2-fpm

RUN docker-php-ext-install mysqli

WORKDIR /var/www/html

COPY . .

EXPOSE 9000

CMD ["php-fpm"]
