FROM php:8.0.6-fpm-alpine

WORKDIR "/application"

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

#ADD etc/xdebug2/php-xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

RUN apk add --no-cache --virtual build-essentials \
    icu-dev icu-libs zlib-dev g++ make automake autoconf libzip-dev \
    libpng-dev libwebp-dev libjpeg-turbo-dev freetype-dev && \
    docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp && \
    docker-php-ext-install gd && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug
#RUN apk --no-cache add pcre-dev ${PHPIZE_DEPS} \
#  && pecl install xdebug \
#  && docker-php-ext-enable xdebug \
#  && apk del pcre-dev ${PHPIZE_DEPS} \

RUN docker-php-ext-install pdo_mysql bcmath
RUN apk --no-cache add shadow && usermod -u 1000 www-data && groupmod -g 1000 www-data

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#RUN apk add --no-cache bash
# && apt-get -y --no-install-recommends install php7.4-pgsql bcmath php-redis php-xdebug php7.4-intl php7.4-soap php-yaml \