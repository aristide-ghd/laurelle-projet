<?php
    // Activer l'affichage des erreurs pour le developpement
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include("../session_start_verify.php"); // Fichier pour verifier la connexion_user avec la session
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Politique de confidentialité</title>

    <!-- Inclusion de la bibliothèque Bootstrap pour le style -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        @media only screen and (max-width: 576px) {

        }
        section{
            margin-top: 8%;
        }
        p a{
            text-decoration: none;
        }
    </style>

    <?php include '../mode.php'; // Inclusion du mode d'affichage (clair/sombre) ?>

</head>

<body class="d-flex flex-column min-vh-100">
    <?php include('../navbar/en_tete.php'); ?>

    <section class="container mb-5 flex-grow-1">

        <h1 class="text-center mb-4">Conditions d'utilisation</h1>

        <p>Bienvenue sur le site de <strong>Homechip's Laure</strong>. En utilisant notre site, vous acceptez les conditions suivantes :</p>

        <h2 class="mt-4">1. Acceptation des conditions</h2>
        <p>En accédant à notre site, vous confirmez que vous avez lu, compris et accepté ces conditions d'utilisation.</p>

        <h2 class="mt-4">2. Modifications des conditions</h2>
        <p>Nous nous réservons le droit de modifier ces conditions à tout moment. Nous vous informerons des modifications en mettant à jour cette page.</p>

        <h2 class="mt-4">3. Propriété intellectuelle</h2>
        <p>Tout le contenu présent sur ce site, y compris les textes, images et logos, est protégé par les droits d'auteur et autres droits de propriété intellectuelle.</p>

        <h2 class="mt-4">4. Utilisation du site</h2>
        <p>Vous vous engagez à utiliser ce site uniquement à des fins légales et de manière à ne pas porter atteinte aux droits de tiers.</p>

        <h2 class="mt-4">5. Limitation de responsabilité</h2>
        <p>HomeLaure Chips ne saurait être tenu responsable des dommages directs ou indirects résultant de l'utilisation de ce site.</p>

        <h2 class="mt-4">6. Droit applicable</h2>
        <p>Ces conditions d'utilisation sont régies par le droit en vigueur dans [votre pays].</p>

        <p>Pour toute question concernant ces conditions, veuillez nous contacter à <a href="mailto:info@homelaurechips.com">info@homelaurechips.com</a>.</p>
        
    </section>

    <?php
        include('../footer/pied_de_page.php');
    ?>

</body>

</html>
