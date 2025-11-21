# Use official PHP image with Apache
FROM php:8.2-apache

# Install Laravel dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git \
    && docker-php-ext-install pdo pdo_mysql zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set workdir
WORKDIR /var/www/html

# Copy all project files
COPY . .

# Install Composer (inside container)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Apache config
EXPOSE 80

CMD ["apache2-foreground"]
