<?php
session_start();

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
try {
    $db = (new Database())->getConnection(); // Récupérer la connexion après instanciation
} catch (Exception $e) {
    // Gérer l'exception si nécessaire (affichage d'un message d'erreur, etc.)
    echo "Erreur : " . $e->getMessage(); // À éviter en production, mais utile pour le débogage
}

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['logged_in'])) {
    // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: ../index.php");
    exit;
}

// Récupération de la date sélectionnée ou celle du jour par défaut
$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

// Requêtes pour récupérer les montants des ventes, recettes et dépenses pour la date sélectionnée
$queryVentes = "SELECT MontantTotal FROM ventes WHERE DateVente = :date";
$queryDepenses = "SELECT MontantDepense FROM depenses WHERE DateDepense = :date";
$queryRecettes = "SELECT MontantRecette FROM recettes WHERE DateRecette = :date";

try {
    // Préparation et exécution des requêtes
    $slmtVentes = $db->prepare($queryVentes);
    $slmtDepenses = $db->prepare($queryDepenses);
    $slmtRecettes = $db->prepare($queryRecettes);

    $slmtVentes->execute([':date' => $date]);
    $slmtDepenses->execute([':date' => $date]);
    $slmtRecettes->execute([':date' => $date]);
} catch (PDOException $e) {
    echo "Erreur lors de l'exécution des requêtes : " . $e->getMessage();
}

// Initialisation des variables pour les totaux et les devises
$totalVentes = 0;
$totalDepenses = 0;
$totalRecettes = 0;
$deviseVentes = '';
$deviseDepenses = '';
$deviseRecettes = '';

// Fonction pour extraire le montant numérique
function extractMontant($string) {
    // Supprimer les caractères non numériques, y compris les espaces et les lettres 
    $string = preg_replace('/[^\d.,]/', '', $string);

    // Remplacer les virgules par des points pour des décimales 
    $string = str_replace(',', '.', $string);

    return is_numeric($string) ? (float)$string : 0; // Par défaut 0 si aucun montant n'est trouvé
}

// Fonction pour extraire la devise
function extractDevise($string) {
    // Extraire tous les caractères après le dernier chiffre (c'est la devise)
    $devise = preg_replace('/[\d.,\s]/', '', $string);
    return $devise ? $devise : 'CFA'; // Par défaut, CFA si aucune devise n'est trouvée
}

// Calcul des totaux et récupération des devises
while ($row = $slmtVentes->fetch(PDO::FETCH_ASSOC)) {
    $totalVentes += extractMontant($row['MontantTotal']);  // Extraire le montant
    $deviseVentes = extractDevise($row['MontantTotal']);   // Extraire la devise
}

while ($row = $slmtDepenses->fetch(PDO::FETCH_ASSOC)) {
    $totalDepenses += extractMontant($row['MontantDepense']);
    $deviseDepenses = extractDevise($row['MontantDepense']);
}

while ($row = $slmtRecettes->fetch(PDO::FETCH_ASSOC)) {
    $totalRecettes += extractMontant($row['MontantRecette']);
    $deviseRecettes = extractDevise($row['MontantRecette']);
}

ob_end_flush(); // Terminer le tampon de sortie
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Page de gestion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .ajout {
            margin-top: 60px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        footer {
            margin-top: auto;
            bottom: 0;
            width: 100%;
        }
        .refresh-button {
            margin-top: 20px;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../navbar/en_tete.php'; ?>

    <section class="container my-5 flex-grow-1">
        <h1 class=" ajout text-center text-secondary fs-1 mb-4">Visibilité sur vos finances</h1>
        <div class="date-filter text-center">
            <form method="GET" action="gestion.php">
                <div class="input-group">
                    <span class="input-group-text">Date</span>
                    <input type="date" name="date" class="form-control" value="<?= htmlspecialchars($date); ?>" required>
                    <button type="submit" class="btn btn-outline-dark">Filtrer</button>
                </div>
            </form>
        </div><br>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="text-white">
                    <tr>
                        <th>Type</th>
                        <th class="text-end fw-bold">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-light rounded-3 shadow-sm">
                        <td class="fw-bold d-flex align-items-center">
                            <i class="bi bi-cash me-2 fs-4 text-success"></i> Ventes
                        </td>
                        <td class="text-end"><?= number_format($totalVentes, 2, ',', ' ') . ' ' . htmlspecialchars($deviseVentes); ?></td>
                    </tr>
                    <tr class="bg-light rounded-3 shadow-sm">
                        <td class="fw-bold d-flex align-items-center">
                            <i class="bi bi-file-earmark-x me-2 fs-4 text-danger"></i> Dépenses
                        </td>
                        <td class="text-end"><?= number_format($totalDepenses, 2, ',', ' ') . ' ' . htmlspecialchars($deviseDepenses); ?></td>
                    </tr>
                    <tr class="bg-light rounded-3 shadow-sm">
                        <td class="fw-bold d-flex align-items-center">
                            <i class="bi bi-file-earmark-plus me-2 fs-4 text-info"></i> Recettes
                        </td>
                        <td class="text-end"><?= number_format($totalRecettes, 2, ',', ' ') . ' ' . htmlspecialchars($deviseRecettes); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="text-center refresh-button">
            <a href="gestion.php" class="btn btn-outline-secondary">Rafraîchir</a>
        </div>
    </section>

    <?php include '../footer/footer.php'; ?>
</body>
</html>
