<?php
    session_start(); //Initialiser la connexion
    session_destroy(); // Détruire la session
    header("location: index.php"); // Rediriger vers la page de connexion
    exit();
?>
