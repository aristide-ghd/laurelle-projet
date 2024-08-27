<?php
    // Inclusion de la connexion à la base de données
    include("connexion.php");

    // Vérification si l'ID du client est passé dans l'URL
    if (isset($_GET['id'])) {
        // Récupération de l'ID du client
        $idClient = $_GET['id'];

        // Préparation de la requête SQL pour supprimer le client
        $requete = $bdd->prepare('DELETE FROM clients WHERE idClient = :idClient');
        
        // Exécution de la requête avec l'ID du client
        $requete->execute(['idClient' => $idClient]);

        // Redirection vers la page des clients après suppression
        header('Location: client.php');
        exit(); // S'assurer que le script s'arrête après la redirection
    } else {
        // Si aucun ID n'est fourni, rediriger vers la page des clients
        header('Location: client.php');
        exit();
    }
?>
