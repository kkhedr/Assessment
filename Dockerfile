FROM php:8.2-apache

# Copy Laravel application to the container
COPY . /var/www/html

# Install dependencies and configure server
RUN docker-php-ext-install pdo_mysql

# Set ServerName globally to avoid warnings
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy the custom Apache config file into the container
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Start Apache in the foreground
CMD ["apache2ctl", "-D", "FOREGROUND"]