<?php
    // Inclusion de la connexion à la base de données
    include("connexion.php");

    // Vérification si l'ID du produit est passé dans l'URL
    if (isset($_GET['id'])) {
        // Récupération de l'ID du produit
        $idProduit = $_GET['id'];

        // Préparation de la requête SQL pour supprimer le produit
        $requete = $bdd->prepare('DELETE FROM produits WHERE idProduit = :idProduit');
        
        // Exécution de la requête avec l'ID du produit
        $requete->execute(['idProduit' => $idProduit]);

        // Redirection vers la page des produits après suppression
        header('Location: produit.php');
        exit(); // S'assurer que le script s'arrête après la redirection
    } else {
        // Si aucun ID n'est fourni, rediriger vers la page des produits
        header('Location: produit.php');
        exit();
    }
?>
