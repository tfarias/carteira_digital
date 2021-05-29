FROM php:7.4-fpm


WORKDIR /var/www

RUN apt-get update && \
    apt-get install -y autoconf pkg-config libssl-dev git libzip-dev zlib1g-dev && \
    pecl install mongodb && docker-php-ext-enable mongodb && \
    pecl install xdebug && \
    echo "xdebug.mode=debug,coverage" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    docker-php-ext-enable xdebug && \
    docker-php-ext-install zip && \
    docker-php-ext-install pdo pdo_mysql bcmath


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN getent group www || groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www || true

COPY . /var/www

COPY --chown=www:www . /var/www

USER www

EXPOSE 9000

