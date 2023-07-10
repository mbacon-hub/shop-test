FROM bitnami/php-fpm:8.2

USER root
WORKDIR /var/www/

RUN groupadd -og 1000 www \
    && useradd -g www -ou 1000 -s /bin/bash www \
    && chown -R www:www /var/www/ \
    && chown -R www:www /opt/bitnami/php/

RUN apt update \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

USER www

EXPOSE 9000



