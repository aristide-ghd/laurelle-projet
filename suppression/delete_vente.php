<?php
    // Inclusion de la connexion à la base de données
    include("../connexion.php");

    include("../db_connected_verify.php"); // Vérification de la connexion à la base de données

    // Vérification si l'ID de la vente est passé dans l'URL
    if (isset($_GET['id'])) {
        // Récupération de l'ID de la vente
        $idVente = $_GET['id'];

        // Préparation de la requête SQL pour supprimer la vente
        $requete = $db->prepare('DELETE FROM ventes WHERE idVente = :idVente');
        
        // Exécution de la requête avec l'ID de la vente
        $requete->execute(['idVente' => $idVente]);

        // Redirection vers la page des ventes après suppression
        header('Location: ../dashbord/vente.php');
        exit(); // S'assurer que le script s'arrête après la redirection
    } else {
        // Si aucun ID n'est fourni, rediriger vers la page des ventes
        header('Location: ../dashbord/vente.php');
        exit();
    }
?>
