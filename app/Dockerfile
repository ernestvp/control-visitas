FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libzip-dev \
    libicu-dev \
    zip \
    unzip \
    curl \
    nginx \
    && docker-php-ext-install pdo pdo_mysql mysqli zip intl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiamos todos los archivos de la app
COPY . .

# Instalamos dependencias
RUN composer install --no-interaction --optimize-autoloader

# Permisos
RUN chmod -R 777 writable

# Configuración nginx
RUN echo 'server { \
    listen 80; \
    root /var/www/html/public; \
    index index.php; \
    location / { try_files $uri $uri/ /index.php?$query_string; } \
    location ~ \.php$ { \
        fastcgi_pass 127.0.0.1:9000; \
        fastcgi_index index.php; \
        include fastcgi_params; \
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name; \
    } \
}' > /etc/nginx/sites-available/default

EXPOSE 80
CMD service nginx start && php-fpm -F