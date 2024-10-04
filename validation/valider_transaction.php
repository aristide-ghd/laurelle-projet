<?php
// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure la connexion et les classes
include('../connexion.php'); // Assurez-vous que connexion.php définit la variable $db
include('Produit.php');
include('Fournisseur.php');

// Initialisation des objets en passant la variable $db
$produit = new Produit($db);
$fournisseur = new Fournisseur($db);

// Vérification des données POST pour ajouter un produit
if (!empty($_POST['s_nomproduit']) && !empty($_POST['s_descriptionproduit'])) {
    $produit->ajouterProduit(
        $_POST['s_nomproduit'],
        $_POST['s_descriptionproduit'],
        $_POST['s_prixvente'],
        $_POST['s_coutunit'],
        $_POST['s_deviseprixvente'],
        $_POST['s_devisecoutunit']
    );
    // Redirection vers la page produit
    header('Location: ../dashbord/produit.php');
    exit;
}

// Vérification des données POST pour ajouter un fournisseur
if (!empty($_POST['s_nomfournisseur']) && !empty($_POST['s_adressefournisseur'])) {
    $fournisseur->ajouterFournisseur(
        $_POST['s_nomfournisseur'],
        $_POST['s_adressefournisseur'],
        $_POST['s_coordonneesfournisseur']
    );
    // Redirection vers la page fournisseur
    header('Location: ../dashbord/fournisseur.php');
    exit;
}

// Si les en-têtes ont été envoyés avant la redirection, afficher un message
if (headers_sent()) {
    echo "Les headers ont déjà été envoyés. La redirection ne fonctionnera pas.";
}
