FROM php:8.1.10-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpq-dev \
    libonig-dev \
    libzip-dev \
    unzip \
    zip

RUN docker-php-ext-install pdo pdo_pgsql pgsql mbstring zip exif pcntl

COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . /app

COPY composer.json composer.lock ./
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev --no-scripts

COPY . .

RUN composer run-script post-autoload-dump
CMD php artisan serve --host=0.0.0.0 --port=8181

EXPOSE 8181
