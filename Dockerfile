FROM php:8.2-apache

# instalar extensões
RUN docker-php-ext-install mysqli pdo pdo_mysql

# habilitar rewrite
RUN a2enmod rewrite

# garantir que apenas prefork esteja ativo
RUN a2dismod mpm_event || true
RUN a2dismod mpm_worker || true
RUN a2enmod mpm_prefork

# copiar projeto
COPY . /var/www/html/

# definir pasta public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf