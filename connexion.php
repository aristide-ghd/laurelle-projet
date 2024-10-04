<?php
// Afficher les erreurs pour le développement
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ob_start(); // Démarre le tampon de sortie

// Constantes pour la connexion à la base de données
define('DB_HOST', 'db_homelaurechips');  // Nom du service dans docker-compose.yml
define('DB_NAME', getenv('MYSQL_DATABASE') ?: 'nom_defaut'); // Valeur par défaut si non définie
define('DB_USER', getenv('MYSQL_USER') ?: 'utilisateur_defaut'); // Valeur par défaut
define('DB_PASS', getenv('MYSQL_PASSWORD') ?: 'motdepasse_defaut'); // Valeur par défaut

class Database {
    private $connection;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        try {
            // Vérification des variables d'environnement
            if (empty(DB_NAME) || empty(DB_USER) || empty(DB_PASS)) {
                throw new Exception("Les informations de connexion à la base de données ne sont pas définies.");
            }

            // Création de la connexion PDO avec charset utf8mb4
            $this->connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Mode de récupération par défaut

        } catch (PDOException $e) {
            // Gestion des erreurs de connexion
            error_log("Erreur de connexion : " . $e->getMessage(), 0); // Journaliser l'erreur
            throw new Exception("Erreur de connexion à la base de données : " . $e->getMessage()); // Lève une exception
        } catch (Exception $e) {
            // Gestion des autres exceptions
            error_log("Erreur : " . $e->getMessage(), 0); // Journaliser l'erreur
            throw new Exception("Erreur lors de la connexion à la base de données : " . $e->getMessage()); // Lève une exception
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
$db = null; // Initialiser la variable
try {
    $database = new Database(); // Créer une instance de la classe Database
    $db = $database->getConnection(); // Récupérer la connexion
} catch (Exception $e) {
    // Gérer l'exception si nécessaire (affichage d'un message d'erreur, etc.)
    echo "Erreur : " . $e->getMessage(); // À éviter en production, mais utile pour le débogage
}

// N'oubliez pas d'appeler ob_end_flush() à la fin de votre script si vous utilisez ob_start()
ob_end_flush();
?>
