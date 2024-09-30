<?php
// Constantes pour la connexion à la base de données
define('DB_HOST', 'db_homelaurechips');  // Nom du service dans docker-compose.yml
define('DB_NAME', getenv('MYSQL_DATABASE'));
define('DB_USER', getenv('MYSQL_USER'));
define('DB_PASS', getenv('MYSQL_PASSWORD'));

try {
    // Vérification des variables d'environnement
    if (DB_NAME === false || DB_USER === false || DB_PASS === false) {
        throw new Exception("Les informations de connexion à la base de données ne sont pas définies.");
    }

    // Création de la connexion PDO avec charset utf8mb4
    $bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Mode de récupération par défaut

    // Test de la connexion
    echo "Connexion réussie à la base de données !";
} catch (PDOException $e) {
    // Gestion des erreurs de connexion
    error_log("Erreur de connexion : " . $e->getMessage(), 0); // Journaliser l'erreur
    echo "Erreur de connexion à la base de données. Veuillez réessayer plus tard.";
} catch (Exception $e) {
    // Gestion des autres exceptions
    error_log("Erreur : " . $e->getMessage(), 0); // Journaliser l'erreur
    echo "Une erreur est survenue. Veuillez réessayer plus tard.";
}
?>
