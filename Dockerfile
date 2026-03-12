FROM php:8.2-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

COPY . /var/www/html/

COPY apache.conf /etc/apache2/conf-available/custom.conf
RUN a2enconf custom

RUN chown -R www-data:www-data /var/www/html