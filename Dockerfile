FROM php:8.2-apache

# Instalar extensões PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Ativar mod_rewrite
RUN a2enmod rewrite

# Definir pasta public como raiz
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Atualizar configuração do Apache
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
 && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# Permitir .htaccess
RUN echo '<Directory /var/www/html/public> AllowOverride All Require all granted </Directory>' >> /etc/apache2/apache2.conf

# Copiar projeto
COPY . /var/www/html/

# Permissões
RUN chown -R www-data:www-data /var/www/html