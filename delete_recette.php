<?php
    // Inclusion de la connexion à la base de données
    include("connexion.php");

    // Vérification si l'ID de la recette est passé dans l'URL
    if (isset($_GET['id'])) {
        // Récupération de l'ID de la recette
        $idRecette = $_GET['id'];

        // Préparation de la requête SQL pour supprimer la recette
        $requete = $bdd->prepare('DELETE FROM recettes WHERE idRecette = :idRecette');
        
        // Exécution de la requête avec l'ID de la recette
        $requete->execute(['idRecette' => $idRecette]);

        // Redirection vers la page des recettes après suppression
        header('Location: recette.php');
        exit(); // S'assurer que le script s'arrête après la redirection
    } else {
        // Si aucun ID n'est fourni, rediriger vers la page des recettes
        header('Location: recette.php');
        exit();
    }
?>