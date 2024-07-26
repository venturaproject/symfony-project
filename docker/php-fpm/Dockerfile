# Use the official PHP 8.2.0 image with FPM and Alpine Linux for a lightweight PHP setup
FROM php:8.2.0-fpm-alpine

# Install necessary packages
RUN apk add --no-cache curl git build-base zlib-dev oniguruma-dev autoconf bash

# Install Linux headers required for some extensions and tools
RUN apk add --update linux-headers

# Optionally install Xdebug for debugging PHP code
# If INSTALL_XDEBUG is set to true, Xdebug will be installed and enabled
ARG INSTALL_XDEBUG=false
RUN if [ ${INSTALL_XDEBUG} = true ]; then \
    pecl install xdebug && docker-php-ext-enable xdebug; \
fi;

# Copy custom PHP and Xdebug configuration files into the container
COPY php.ini /usr/local/etc/php/conf.d/docker-php-config.ini
COPY xdebug.ini /usr/local/etc/php/conf.d/docker-php-xdebug.ini

# Install PostgreSQL support for PDO
RUN apk add --no-cache libpq-dev && docker-php-ext-install pdo_pgsql

# Configure non-root user for better security practices
# Create a non-root user with specified UID and GID for file ownership and permissions
ARG PUID=1000
ARG PGID=1000
RUN apk --no-cache add shadow && \
    groupmod -o -g ${PGID} www-data && \
    usermod -o -u ${PUID} -g www-data www-data

# Install Node.js and Yarn as root
USER root
RUN apk add --no-cache nodejs npm && npm install -g yarn

# Switch to the non-root user for security
USER www-data

# Install Composer for PHP dependency management
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory for the application
WORKDIR /var/www

# Start PHP-FPM service when the container runs
CMD php-fpm

# Expose port 9000 for PHP-FPM
EXPOSE 9000
