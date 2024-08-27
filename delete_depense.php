<?php
    // Inclusion de la connexion à la base de données
    include("connexion.php");

    // Vérification si l'ID de la depense est passé dans l'URL
    if (isset($_GET['id'])) {
        // Récupération de l'ID de la depense
        $idDepense = $_GET['id'];

        // Préparation de la requête SQL pour supprimer la depense
        $requete = $bdd->prepare('DELETE FROM depenses WHERE idDepense = :idDepense');
        
        // Exécution de la requête avec l'ID de la depense
        $requete->execute(['idDepense' => $idDepense]);

        // Redirection vers la page des depenses après suppression
        header('Location: depense.php');
        exit(); // S'assurer que le script s'arrête après la redirection
    } else {
        // Si aucun ID n'est fourni, rediriger vers la page des depenses
        header('Location: depense.php');
        exit();
    }
?>
