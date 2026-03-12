FROM php:8.2-apache

# Instalar extensões necessárias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Garantir que apenas um MPM esteja ativo
RUN a2dismod mpm_event mpm_worker || true
RUN a2enmod mpm_prefork

# Ativar rewrite para rotas MVC
RUN a2enmod rewrite

# Copiar projeto
COPY . /var/www/html/

# Definir pasta pública
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf