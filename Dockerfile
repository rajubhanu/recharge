FROM php:8.1-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip libpng-dev \
    && docker-php-ext-install mysqli pdo pdo_mysql

RUN docker-php-ext-install pdo pdo_mysql

# Copy project files to web root
COPY . /var/www/html/

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html

# Enable Apache modules
RUN a2enmod rewrite
