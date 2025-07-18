# Use the official PHP Apache image
FROM php:8.1-apache

# Install required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Enable Apache mod_rewrite (optional, but useful)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy your PHP project files into the container
COPY . /var/www/html

# Set proper permissions (optional but good practice)
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 (default for Apache)
EXPOSE 80
