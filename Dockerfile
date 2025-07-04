# Use official PHP + Apache image
FROM php:8.1-apache

# Enable mod_rewrite for pretty URLs (optional)
RUN a2enmod rewrite

# Copy your project into the container's web root
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html
