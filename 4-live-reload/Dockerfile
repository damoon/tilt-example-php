FROM php:7.4-fpm

# Default value; will be overridden by build-args, if passed
ARG php_env=production

ENV PHP_ENV $php_env

WORKDIR /app

RUN apt-get update

RUN apt-get install -y libzip-dev zip
RUN docker-php-ext-install zip

RUN apt-get install -y git
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

# adding composer.* invalidates docker's image layer cache
ADD composer.json .
ADD composer.lock .
RUN composer install

ADD . .

# trigger browser live reload
RUN date +%s%N > build.txt
