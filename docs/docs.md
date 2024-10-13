docker exec -it laurelle-projet-web_homelaurechips-1 /bin/bash

   mysql -h db_homelaurechips -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE" < /var/www/html/db_homechips_laure.sql

ou bien 

   mysql -h db_homelaurechips -u homechipslaure -p db_homechips_laure < /var/www/html/db_homechips_laure.sql
   
Pour te connecter à la base de données MySQL à partir d'un conteneur Docker et lister les tables, suis ces étapes :

### Étape 1 : Se connecter au conteneur Docker

Utilise la commande suivante pour te connecter au conteneur de ton application web (en supposant que le nom du conteneur est `laurelle-projet-web_homelaurechips-1`) :

```bash
docker exec -it laurelle-projet-web_homelaurechips-1 /bin/bash
```

### Étape 2 : Se connecter à la base de données MySQL

Une fois à l'intérieur du conteneur, exécute la commande suivante pour te connecter à la base de données MySQL :

```bash
mysql -h db_homelaurechips -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE"
```

Assure-toi que les variables d'environnement (`$MYSQL_USER`, `$MYSQL_PASSWORD`, `$MYSQL_DATABASE`) sont correctement définies dans ton conteneur.

### Étape 3 : Lister les tables

Une fois connecté à MySQL, tu peux lister les tables de la base de données avec la commande suivante :

```sql
SHOW TABLES;
```

### Résumé de la séquence de commandes

Voici un résumé de la séquence de commandes à exécuter :

```bash
docker exec -it laurelle-projet-web_homelaurechips-1 /bin/bash
mysql -h db_homelaurechips -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE"
SHOW TABLES;
```

### Remarque
Si tu ne souhaites pas entrer dans le conteneur en premier lieu, tu peux exécuter la commande MySQL directement depuis l'hôte Docker en utilisant :

```bash
docker exec -it laurelle-projet-web_homelaurechips-1 mysql -h db_homelaurechips -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE" -e "SHOW TABLES;"
```

Cela te permettra d'obtenir la liste des tables directement sans entrer dans le conteneur.
