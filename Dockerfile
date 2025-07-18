FROM php:8.1-apache

# Install required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Enable Apache rewrite (optional)
RUN a2enmod rewrite

# Copy your PHP project
COPY . /var/www/html/

# Set permissions (optional)
RUN chown -R www-data:www-data /var/www/html
