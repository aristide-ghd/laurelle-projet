docker exec -it laurelle-projet-web_homelaurechips-1 /bin/bash

   mysql -h db_homelaurechips -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE" < /var/www/html/db_homechips_laure.sql

ou bien 

   mysql -h db_homelaurechips -u homechipslaure -p db_homechips_laure < /var/www/html/db_homechips_laure.sql
   

