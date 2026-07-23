FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libxml2-dev libzip-dev \
    libonig-dev libicu-dev \
    && docker-php-ext-install gd pdo pdo_mysql mbstring xml zip bcmath intl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --optimize-autoloader --no-scripts --no-interaction

EXPOSE 8080
CMD php artisan migrate --force && php artisan storage:link && php artisan optimize && php -S 0.0.0.0:$PORT -t public/