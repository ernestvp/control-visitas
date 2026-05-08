# Imagen base PHP 8.2 con Apache
FROM php:8.2-apache

# Instalamos extensiones necesarias para MySQL y CodeIgniter
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libicu-dev \
    zip \
    unzip \
    curl \
    && docker-php-ext-install pdo pdo_mysql mysqli zip intl

# Activamos mod_rewrite de Apache (necesario para las rutas de CodeIgniter)
RUN a2enmod rewrite

# Instalamos Composer (gestor de paquetes de PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configuramos Apache para que apunte a la carpeta public de CodeIgniter
RUN sed -i 's|/var/www/html|/var/www/html/public|g' \
    /etc/apache2/sites-available/000-default.conf

# Permitimos que .htaccess funcione correctamente
RUN sed -i 's|AllowOverride None|AllowOverride All|g' \
    /etc/apache2/apache2.conf

WORKDIR /var/www/html