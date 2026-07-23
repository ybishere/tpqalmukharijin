FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libxml2-dev libzip-dev \
    libonig-dev libicu-dev nodejs npm \
    && docker-php-ext-install gd pdo pdo_mysql mbstring xml zip bcmath intl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer install --optimize-autoloader --no-scripts --no-interaction
RUN npm install && npm run build

EXPOSE 8080

CMD ["sh", "-c", "php artisan migrate --force && php artisan storage:link --force && php artisan optimize && php artisan serve --host=0.0.0.0 --port=8080"]