<?php
ob_start(); // Démarre le tampon de sortie

// Constantes pour la connexion à la base de données
define('DB_HOST', 'db_homelaurechips');  // Nom du service dans docker-compose.yml
define('DB_NAME', getenv('MYSQL_DATABASE'));
define('DB_USER', getenv('MYSQL_USER'));
define('DB_PASS', getenv('MYSQL_PASSWORD'));

class Database {
    private $connection;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        try {
            // Vérification des variables d'environnement
            if (!DB_NAME || !DB_USER || !DB_PASS) {
                throw new Exception("Les informations de connexion à la base de données ne sont pas définies.");
            }

            // Création de la connexion PDO avec charset utf8mb4
            $this->connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Mode de récupération par défaut
            
            // Pas d'affichage ici
            // error_log("Connexion réussie à la base de données !", 0); // Si nécessaire, journalise la réussite de la connexion
        } catch (PDOException $e) {
            // Gestion des erreurs de connexion
            error_log("Erreur de connexion : " . $e->getMessage(), 0); // Journaliser l'erreur
        } catch (Exception $e) {
            // Gestion des autres exceptions
            error_log("Erreur : " . $e->getMessage(), 0); // Journaliser l'erreur
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    public function __destruct() {
        $this->connection = null; // Fermeture explicite de la connexion
    }
}

// Instancier la classe Database pour établir la connexion
$db = new Database();

// N'oublie pas d'appeler ob_end_flush() à la fin de ton script si tu utilises ob_start()
ob_end_flush();
