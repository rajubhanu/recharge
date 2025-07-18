FROM php:8.2-apache

# Install mysqli extension and enable Apache mod_rewrite
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN a2enmod rewrite
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copy project files
COPY . /var/www/html/
WORKDIR /var/www/html/
EXPOSE 80
