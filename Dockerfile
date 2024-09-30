FROM php:7.4-apache

# Ajouter l'étiquette Name requise
LABEL Name="HomeLaureChips"

# Installer les extensions PHP nécessaires et les outils pour MySQL
RUN apt-get update && apt-get install -y default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copier les fichiers du projet dans le conteneur
COPY . /var/www/html/

# Copier le fichier de configuration Apache personnalisé
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Configurer Apache
RUN a2enmod rewrite

# Copier le script d'initialisation
COPY init-db.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/init-db.sh

# Démarrer Apache et initialiser la base de données
CMD ["apache2-foreground"]
