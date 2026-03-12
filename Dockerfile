FROM php:8.2-apache

# Instalar extensões PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Ativar rewrite para MVC
RUN a2enmod rewrite

# Copiar projeto
COPY . /var/www/html/

# Definir pasta pública
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
 && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf