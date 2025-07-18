# Use PHP with Apache
FROM php:8.1-apache

# Install pdo_mysql driver
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache Rewrite
RUN a2enmod rewrite

# Copy project files
COPY . /var/www/html/
