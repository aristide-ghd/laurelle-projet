<?php

session_start(); // Démarrage de la session pour accéder aux messages flash

if (isset($_SESSION['message'])) {
    // Affichage du message
    $message_type = $_SESSION['message_type']; // success ou error
    $message = $_SESSION['message'];

    echo "<div class='alert alert-$message_type'>$message</div>";

    // Suppression du message après l'affichage pour éviter de le montrer à nouveau
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}

class Produit {
    private $db;

    public function __construct($db) {
        $this->bdd = $db;
    }

    public function ajouterProduit($nom, $description, $prix, $cout, $deviseprixvente, $devisecoutunit) {
        $prixventefinal = $prix . ' ' . $deviseprixvente;
        $coutunitfinal = $cout . ' ' . $devisecoutunit;

        $req = "INSERT INTO produits (nom, description, prix_vente, cout_unitaire) VALUES ('$nom', '$description', '$prixventefinal', '$coutunitfinal')";

        return $this->bdd->query($req);
    }
}
?>
