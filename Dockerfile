FROM php:8.2-apache

RUN apt-get update && \
    apt-get install -y \
        libpng-dev \
        zlib1g-dev \
        libzip-dev \
        default-mysql-client \
        mariadb-client && \
    docker-php-ext-install mysqli pdo pdo_mysql zip gd && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

COPY ecommerce /var/www/html/ecommerce

WORKDIR /var/www/html/ecommerce

RUN chown -R www-data:www-data /var/www/html/ecommerce && \
    chmod -R 755 /var/www/html/ecommerce

RUN a2enmod rewrite

EXPOSE 80
