<?php
// Vérification si une session a déjà été démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Démarrer une session si ce n'est pas encore fait
}

// Vérification et affichage des messages flash
if (isset($_SESSION['message'])) {
    $message_type = $_SESSION['message_type']; // success ou error
    $message = $_SESSION['message'];

    // Affichage du message
    echo "<div class='alert alert-$message_type'>$message</div>";

    // Suppression du message après l'affichage
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}

class Fournisseur {
    private $db;

    public function __construct($db) {
        $this->bdd = $db;
    }

    public function ajouterFournisseur($nom, $adresse, $coordonnees) {
        // Préparation de la requête SQL avec des paramètres
        $req = "INSERT INTO fournisseurs (nom, adresse, coordonnees) VALUES (:nom, :adresse, :coordonnees)";
        $stmt = $this->bdd->prepare($req);
        
        // Exécution de la requête avec des paramètres
        if ($stmt->execute([
            ':nom' => $nom,
            ':adresse' => $adresse,
            ':coordonnees' => $coordonnees
        ])) {
            // Message de succès
            $_SESSION['message'] = "Fournisseur ajouté avec succès.";
            $_SESSION['message_type'] = 'success';
        } else {
            // Message d'erreur
            $_SESSION['message'] = "Erreur lors de l'ajout du fournisseur.";
            $_SESSION['message_type'] = 'error';
        }
    }
}
?>
