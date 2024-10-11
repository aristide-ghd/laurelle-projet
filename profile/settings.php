<?php
    session_start();

    // Vérification si l'utilisateur est connecté
    if(!isset($_SESSION['logged_in'])) {
        // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
        header("Location: ../index.php");
        exit;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page des Paramètres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .footer {
            /* margin-top: 4%; */
            width: 100%;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../navbar/en_tete.php'; ?>

    <section class="container my-5 pt-5 flex-grow-1">
        
    </section>

    <footer class="bg-dark text-white text-center py-4 footer">
        <p class="mb-0 ">Copyright © 2024 Homechip's Laure | Tous droits réservés</p>
        <p class="mb-0 ">Design by: <a href="https://ari-luxury.com" class="text-white text-decoration-none">Ari-Luxury    </a></p>
    </footer>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
</body>
</html>