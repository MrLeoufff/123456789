FROM php:8.3-apache

# Installe les extensions PHP nécessaires (ajuste selon tes besoins)
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    git \
    zip \
    libicu-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    && docker-php-ext-install intl pdo pdo_mysql zip gd

# Installe Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Supprime la config active AVANT de copier la nouvelle
RUN rm -f /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-enabled/000-default.conf

# Copie ta nouvelle config
COPY apache/vhost.conf /etc/apache2/sites-available/000-default.conf

# Active la config (en recréant le lien proprement)
RUN ln -s /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-enabled/000-default.conf

# Active mod_rewrite
RUN a2enmod rewrite

# Commande à exécuter au DÉMARRAGE pour forcer un reload d'Apache (solution définitive)
CMD ["apache2-foreground"]

# Copie le code Symfony dans le conteneur
WORKDIR /var/www/html

# Par défaut, le projet sera monté en volume, donc pas besoin de copier ici
