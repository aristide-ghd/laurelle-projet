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
    <title>Politique de confidentialité</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

    <?php include '../mode.php'; ?>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include('../navbar/en_tete.php'); ?>

    <section class="container mb-5 flex-grow-1">
        <h1 class="text-center mb-4">Politique de confidentialité</h1>

        <p>Chez <strong>Homechip's Laure</strong>, la protection de votre vie privée est notre priorité. Cette politique décrit comment nous collectons, utilisons et protégeons vos informations.</p>

        <h2 class="mt-4">1. Informations que nous collectons</h2>
        <p>Nous collectons des informations lorsque vous vous inscrivez sur notre site, passez une commande, ou interagissez avec nous d'une autre manière. Cela peut inclure votre nom, adresse e-mail, et informations de paiement.</p>

        <h2 class="mt-4">2. Utilisation des informations</h2>
        <p>Nous utilisons vos informations pour :</p>
        <ul class="list-group mb-4">
            <li class="list-group-item">Traiter vos commandes</li>
            <li class="list-group-item">Améliorer notre service client</li>
            <li class="list-group-item">Vous envoyer des informations sur vos commandes et notre entreprise</li>
        </ul>

        <h2 class="mt-4">3. Protection des informations</h2>
        <p>Nous mettons en œuvre diverses mesures de sécurité pour protéger vos informations personnelles. Cependant, aucune méthode de transmission sur Internet ou de stockage électronique n'est 100% sécurisée.</p>

        <h2 class="mt-4">4. Partage des informations</h2>
        <p>Nous ne vendons, n'échangeons, ni ne transférons vos informations personnelles à des tiers sans votre consentement, sauf si la loi l'exige.</p>

        <h2 class="mt-4">5. Vos droits</h2>
        <p>Vous avez le droit d'accéder à vos informations personnelles, de demander leur correction ou leur suppression, et de vous opposer à leur traitement.</p>

        <h2 class="mt-4">6. Modifications de la politique</h2>
        <p>Nous nous réservons le droit de modifier cette politique de confidentialité à tout moment. Les changements seront publiés sur cette page.</p>

        <p>Pour toute question concernant cette politique, veuillez nous contacter à <a href="mailto:info@homelaurechips.com">info@homelaurechips.com</a>.</p>
    </section>

    <?php
        include('../footer/pied_de_page.php');
    ?>
</body>
</html>