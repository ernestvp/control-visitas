FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libzip-dev \
    libicu-dev \
    zip \
    unzip \
    curl \
    && docker-php-ext-install pdo pdo_mysql mysqli zip intl

# Activamos solo mpm_prefork y desactivamos mpm_event
RUN a2dismod mpm_event && a2enmod mpm_prefork rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN sed -i 's|/var/www/html|/var/www/html/public|g' \
    /etc/apache2/sites-available/000-default.conf

RUN sed -i 's|AllowOverride None|AllowOverride All|g' \
    /etc/apache2/apache2.conf

WORKDIR /var/www/html