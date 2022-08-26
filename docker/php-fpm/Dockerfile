FROM hermsi/alpine-fpm-php:7.4.14

RUN mv /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini
RUN sed -i 's/;opcache.enable=1/opcache.enable=0/g' /usr/local/etc/php/php.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

#RUN apk add --no-cache $PHPIZE_DEPS \
#    && pecl install xdebug \
#    && docker-php-ext-enable xdebug

EXPOSE 9000
CMD ["php-fpm", "-F"]
