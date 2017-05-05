FROM php:7.0-fpm
MAINTAINER Andrei <andrei.prozorov@mail.ru>

RUN apt-get update \
      && apt-get install -y \
          git \
          cron \
          libfreetype6-dev \
          libjpeg62-turbo-dev \
          libicu-dev \
          libmcrypt-dev \
          libpng12-dev \
          libxslt1-dev \
          zlib1g-dev \
          --no-install-recommends \
      && docker-php-ext-install gd \
      && docker-php-ext-install intl \
      && docker-php-ext-install pdo_mysql \
      && docker-php-ext-install mbstring \
      && docker-php-ext-install mcrypt \
      && docker-php-ext-install opcache \
      && docker-php-ext-install zip


RUN apt-get install curl\
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin \
    && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer \
    && composer.phar global require --no-progress "fxp/composer-asset-plugin:~1.2.2" \
    && composer.phar global require --no-progress "codeception/codeception=2.0.*" \
    && composer.phar global require --no-progress "codeception/specify=*" \
    && composer.phar global require --no-progress "codeception/verify=*"


# COPY ./php.ini /usr/local/etc/php

# CMD ["php-fpm"]
# RUN php composer update -d /var/www/html
# RUN php yii migrate