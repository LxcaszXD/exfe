FROM php:8.2-apache

# Instalar extensões
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Ativar mod_rewrite
RUN a2enmod rewrite

# Definir document root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Atualizar configs Apache
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
 && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# Permitir .htaccess
RUN printf '<Directory /var/www/html/public>\nAllowOverride All\nRequire all granted\n</Directory>\n' >> /etc/apache2/apache2.conf

# Copiar projeto
COPY . /var/www/html/

# Permissões
RUN chown -R www-data:www-data /var/www/html