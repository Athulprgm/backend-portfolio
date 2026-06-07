FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

# Custom PHP limits (upload_max_filesize, post_max_size, etc.)
COPY php.ini /usr/local/etc/php/conf.d/portfolio.ini

RUN chown -R www-data:www-data storage bootstrap/cache

RUN a2enmod rewrite

COPY .render/apache.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80

CMD php artisan config:clear && php artisan optimize:clear && php artisan migrate --force && php artisan storage:link --force && apache2-foreground
