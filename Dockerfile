#FROM php:7.2.2-apache
#RUN docker-php-ext-install mysqli

# Usa una imagen de PHP con Apache
FROM php:7.2.2-apache

# Instala extensiones PHP y herramientas adicionales si es necesario
RUN docker-php-ext-install mysqli

# Copia los archivos de tu aplicación al directorio de trabajo del contenedor
COPY ./app /var/www/html

# Configura Apache para que sirva tu aplicación
RUN a2enmod rewrite
RUN service apache2 restart