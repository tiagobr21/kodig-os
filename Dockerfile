FROM php:8.2-fpm-bullseye

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libcurl4-openssl-dev \
    && docker-php-ext-install zip curl pdo pdo_mysql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .


RUN mkdir -p runtime web/assets && \
    chown -R www-data:www-data /var/www/html

CMD ["php-fpm"]
