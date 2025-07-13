<?php
    // Activer l'affichage des erreurs
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Inclusion de la connexion à la base de données
    include("../includes/sign_in.php");

    include("../includes/db_connected_verify.php"); // Vérification de la connexion à la base de données

    // Vérification si l'ID du fournisseur est passé dans l'URL
    if (isset($_GET['id'])) {
        // Récupération de l'ID du fournisseur
        $idClient = $_GET['id'];

        // Préparation de la requête SQL pour supprimer le fournisseur
        $requete = $bdd->prepare('DELETE FROM clients WHERE idClient = :idClient');
        
        // Exécution de la requête avec l'ID du fournisseur
        $requete->execute(['idClient' => $idClient]);

        // Redirection vers la page des fournisseurs après suppression
        header('Location: ../dashbord/fournisseur.php');
        exit(); // S'assurer que le script s'arrête après la redirection
    } else {
        // Si aucun ID n'est fourni, rediriger vers la page des fournisseurs
        header('Location: ../dashbord/fournisseur.php');
        exit();
    }
?>
