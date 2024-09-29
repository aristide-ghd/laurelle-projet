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
    <title>Homechip's Laure</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .footer {
            /* margin-top: 4%; */
            width: 100%;
        }
        .carousel-caption h5 {
            font-size: 2rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        .carousel-caption p {
            font-size: 1.2rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);
        }

    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../navbar/en_tete.php'; ?>

    <section class="container my-5 pt-5 flex-grow-1">
        <div class="row bigbloc mt-5 ">
            <div class="col-md-6 mb-4">
                <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="../image/chips4.jpg" class="d-block w-100" alt="Image 1">
                            <div class="carousel-caption d-none d-sm-block">
                                <h5>Délicieux Chips Faits Maison</h5>
                                <p>Découvrez notre variété de chips croustillantes et savoureuses.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="../image/chips5.jpg" class="d-block w-100" alt="Image 2">
                            <div class="carousel-caption d-none d-sm-block">
                                <h5 class="">Une Explosion de Saveurs</h5>
                                <p class="">Nos chips sont disponibles dans une gamme de saveurs exquises.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="../image/chips6.jpg" class="d-block w-100" alt="Image 3">
                            <div class="carousel-caption d-none d-sm-block">
                                <h5>Parfait pour les Moments de Convivialité</h5>
                                <p>Partagez nos chips avec vos proches pour un moment inoubliable.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Contrôles de navigation -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class=" p-4">
                    <h1 class="display-4">Bienvenue sur Homechip's Laure</h1>
                    <p class="lead">Nous sommes heureux de vous accueillir sur notre application de gestion des ventes, dépenses et recettes.</p>
                    <p>Prenez le contrôle de votre entreprise et gérez vos activités en toute simplicité avec <span class="fw-bold">Homechip's Laure</span>.</p>
                    <a href="../formulaire/formulaire_vente.php" class="begin btn btn-primary btn-lg mt-3">Commencer</a>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white text-center py-4 footer">
        <p class="mb-0 ">Copyright © 2024 Homechip's Laure | Tous droits réservés</p>
        <p class="mb-0 ">Design by: <a href="https://ari-luxury.com" class="text-white text-decoration-none">Ari-Luxury    </a></p>
    </footer>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
</body>
</html>