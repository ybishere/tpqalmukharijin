FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libxml2-dev libzip-dev \
    && docker-php-ext-install gd pdo pdo_mysql mbstring xml zip bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --optimize-autoloader --no-scripts --no-interaction

RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

EXPOSE 8080
CMD php artisan migrate --force && php artisan storage:link && php -S 0.0.0.0:$PORT -t public