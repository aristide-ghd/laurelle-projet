#!/bin/bash

# Variables d'environnement (à définir dans ton fichier docker-compose)
MYSQL_HOST="db_homelaurechips"
MYSQL_USER="$MYSQL_USER"        # Utilisateur MySQL défini dans docker-compose
MYSQL_PASSWORD="$MYSQL_PASSWORD"  # Mot de passe MySQL défini dans docker-compose
MYSQL_DATABASE="$MYSQL_DATABASE"  # Base de données cible définie dans docker-compose
SQL_FILE="/var/www/html/db_homechips_laure.sql"  # Chemin du fichier SQL

# Attendre que MySQL soit prêt
echo "En attente que MySQL soit prêt..."
until mysql -h "$MYSQL_HOST" -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" -e "SELECT 1" &> /dev/null; do
  sleep 1
done

# Vérifier si le fichier SQL existe avant d'importer
if [ -f "$SQL_FILE" ]; then
    # Importer le fichier SQL
    if mysql -h "$MYSQL_HOST" -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE" < "$SQL_FILE"; then
        echo "Base de données initialisée avec succès!"
    else
        echo "Erreur lors de l'importation du fichier SQL!"
    fi
else
    echo "Le fichier SQL est introuvable à l'emplacement: $SQL_FILE"
fi
