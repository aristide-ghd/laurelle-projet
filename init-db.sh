
#!/bin/bash

# Attendre que MySQL soit prêt
until mysql -h db_homelaurechips -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" -e "SELECT 1"; do
  echo "En attente de la base de données..."
  sleep 1
done

# Vérifier si le fichier SQL existe avant d'importer
if [ -f /var/www/html/db_homechips_laure.sql ]; then
    # Importer le fichier SQL
    mysql -h db_homelaurechips -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE" < /var/www/html/db_homechips_laure.sql
    echo "Base de données initialisée avec succès!"
else
    echo "Le fichier SQL est introuvable!"
fi
