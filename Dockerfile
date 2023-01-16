FROM php:8.1-fpm-alpine3.15 as local

RUN apk add --no-cache \
    nginx icu-dev \
    autoconf automake libtool nasm \
    pcre-dev g++ gcc make sudo \
    libpng-dev \
    freetype-dev libjpeg-turbo-dev \
    openrc supervisor rsyslog \
    nodejs npm \
    shadow \
    tzdata \
    libzip-dev \
    git

# replace iconv
RUN apk add --no-cache --repository http://dl-3.alpinelinux.org/alpine/latest-stable/community gnu-libiconv
ENV LD_PRELOAD /usr/lib/preloadable_libiconv.so php

RUN export TZ=Asia/Tokyo

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install intl pdo_mysql exif gd zip

# install phpredis
RUN pecl install redis \
    && docker-php-ext-enable redis

# useradd
RUN groupadd -g 1000 www && \
    useradd -s /bin/bash -u 1000 -N -g www -K MAIL_DIR=/dev/null -d /var/www www

WORKDIR /var/www
ADD ./.docker/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf
ADD ./.docker/nginx/nginx.conf /etc/nginx/nginx.conf

ADD ./.docker/php/8.1/php-fpm.d/www.conf /usr/local/etc/php-fpm.d/zzz-www.conf
ADD ./.docker/php/8.1/php.ini /usr/local/etc/php/conf.d/my-app.ini

ADD ./.docker/supervisor/supervisord.conf /etc/supervisord.conf
ADD ./.docker/supervisor/supervisor.d/ /etc/supervisor.d/

RUN mkdir /run/php-fpm8.1

RUN chown www:www -R /run/php-fpm8.1 && \
    chown www:www -R /var/www && \
    chown www:www -R /var/lib/nginx && \
    ln -sf /dev/stdout /var/log/messages && \
    ln -sf /dev/stdout /var/log/nginx/access.log && \
    ln -sf /dev/stderr /var/log/nginx/error.log

ADD ./.docker/setup.sh /var/www/.docker/setup.sh
RUN chmod 755 /var/www/.docker/setup.sh

COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

COPY --from=php:8.1-cli-alpine3.15 /usr/local/bin/phpdbg /usr/local/bin/

CMD ["/usr/bin/supervisord"]

FROM local as deploy

ARG APP_ENV

ADD . /var/www
RUN chown www:www -R /var/www
RUN sh /var/www/.docker/setup.sh

CMD ["/usr/bin/supervisord"]
