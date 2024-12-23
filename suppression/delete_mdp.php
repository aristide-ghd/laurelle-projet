<?php
    // Inclusion de la connexion à la base de données
    include("../sign_in.php");

    include("../db_connected_verify.php"); // Vérification de la connexion à la base de données

    // Vérification si l'ID du mode de paiement est passé dans l'URL
    if (isset($_GET['id'])) {
        // Récupération de l'ID du mode de paiement
        $idModePaiement = $_GET['id'];

        // Préparation de la requête SQL pour supprimer le mode de paiement
        $requete = $db->prepare('DELETE FROM modepaiement WHERE idModePaiement = :idModePaiement');
        
        // Exécution de la requête avec l'ID du mode de paiement
        $requete->execute(['idModePaiement' => $idModePaiement]);

        // Redirection vers la page des modes de paiement après suppression
        header('Location: ../dashbord/mdp.php');
        exit(); // S'assurer que le script s'arrête après la redirection
    } else {
        // Si aucun ID n'est fourni, rediriger vers la page des modes de paiement
        header('Location: ../dashbord/mdp.php');
        exit();
    }
?>