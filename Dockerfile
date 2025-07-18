# Use official PHP image with Apache
FROM php:8.1-apache

# Install MySQLi and PDO MySQL extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy all project files into container
COPY . /var/www/html/

# Optional: Set file permissions
RUN chown -R www-data:www-data /var/www/html
