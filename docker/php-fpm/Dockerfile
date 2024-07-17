FROM php:8.2.0-fpm-alpine

# Instalar paquetes necesarios
RUN apk add --no-cache curl git build-base zlib-dev oniguruma-dev autoconf bash

# Instalar headers de Linux
RUN apk add --update linux-headers

# Instalar Xdebug si está habilitado
ARG INSTALL_XDEBUG=false
RUN if [ ${INSTALL_XDEBUG} = true ]; then \
    pecl install xdebug && docker-php-ext-enable xdebug; \
fi;

# Copiar la configuración de PHP y Xdebug a archivos separados
COPY php.ini /usr/local/etc/php/conf.d/docker-php-config.ini
COPY xdebug.ini /usr/local/etc/php/conf.d/docker-php-xdebug.ini

# Instalar soporte para PostgreSQL
RUN apk add --no-cache libpq-dev && docker-php-ext-install pdo_pgsql

# Configurar usuario no root
ARG PUID=1000
ARG PGID=1000
RUN apk --no-cache add shadow && \
    groupmod -o -g ${PGID} www-data && \
    usermod -o -u ${PUID} -g www-data www-data

USER www-data

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /var/www

CMD php-fpm

EXPOSE 9000
