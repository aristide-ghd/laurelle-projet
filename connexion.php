<?php
// echo "ffffffffffffffffffff";
// die;
define("HOSTNAME", "localhost"); 
define("DATABASE", "db_homechips_laure");
define("USERNAME", "root"); 
define("PASSWORD", "");

$dsn = 'mysql:dbname=' . DATABASE . ';host=' . HOSTNAME . ';charset=utf8';  

try {
    $bdd = new PDO($dsn, USERNAME, PASSWORD);
    // Pour afficher les erreurs
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Pour récupérer le résultat des requêtes SELECT sous forme de tableaux associatifs 
    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die;
}

?> 