# Use the official PHP 8.2.0 image with FPM and Alpine Linux for a lightweight PHP setup
FROM php:8.2.0-fpm-alpine

# Install necessary packages
RUN apk add --no-cache \
    curl \
    git \
    build-base \
    zlib-dev \
    oniguruma-dev \
    autoconf \
    bash \
    linux-headers \
    libpq-dev \
    shadow \
    rabbitmq-c-dev \
    supervisor

# Install PHP extensions
RUN pecl install xdebug redis amqp && \
    docker-php-ext-enable xdebug redis amqp && \
    docker-php-ext-install sockets pdo_pgsql

# Copy custom PHP and Xdebug configuration files into the container
COPY php.ini /usr/local/etc/php/conf.d/docker-php-config.ini
COPY xdebug.ini /usr/local/etc/php/conf.d/docker-php-xdebug.ini

# Configure non-root user for better security practices
ARG PUID=1000
ARG PGID=1000
RUN groupmod -o -g ${PGID} www-data && \
    usermod -o -u ${PUID} -g www-data www-data

# Install Node.js and Yarn as root
RUN apk add --no-cache nodejs npm && npm install -g yarn

# Install Composer for PHP dependency management
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory for the application
WORKDIR /var/www

# Create log directory for Supervisor
RUN mkdir -p /var/log/supervisor

# Copy Supervisor configuration
COPY ./supervisor/supervisord.conf /etc/supervisord.conf

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start Supervisor and PHP-FPM
CMD ["supervisord", "-c", "/etc/supervisord.conf"]
