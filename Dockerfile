FROM php:7.4-apache

# Ajouter l'étiquette Name requise
LABEL Name="HomeLaureChips"

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Copier les fichiers du projet dans le conteneur
COPY . /var/www/html/

# Configurer Apache
RUN a2enmod rewrite


# Démarrer Apache en premier plan
CMD ["apache2-foreground"]