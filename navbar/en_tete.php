<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homechip's Laure</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="">
    <style>
        @media only screen and (max-width: 576px) {
            .sous_menu {
                margin-left: 39px;
            }
        }
        header{
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }
    </style>
</head>
<body>
<header class="bg-dark py-2">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark container-fluid">
        <a class="navbar-brand ms-5 fw-bold" href="home.php">Homechip's Laure</a>
        <button class="navbar-toggler me-5 border border-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="sous_menu navbar-nav ms-lg-auto ms-sm-5 ms-xs-5 me-5">
                <li class="nav-item">
                    <a class="nav-link text-white" href="home.php">Accueil</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdownTransactions" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Transactions
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownTransactions">
                        <li><a class="dropdown-item" href="formulaire_produit.php">Formulaire Produits</a></li>
                        <li><a class="dropdown-item" href="formulaire_client.php">Formulaire Clients</a></li>
                        <li><a class="dropdown-item" href="formulaire_vente.php">Formulaire Ventes</a></li>
                        <li><a class="dropdown-item" href="formulaire_recette.php">Formulaire Recettes</a></li>
                        <li><a class="dropdown-item" href="formulaire_depense.php">Formulaire Dépenses</a></li>
                        <li><a class="dropdown-item" href="formulaire_mdp.php">Formulaire Mode de Paiement</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdownEvents" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Evènements financiers
                    </a>
                    <ul class="dropdown-menu ms-lg-2" aria-labelledby="navbarDropdownEvents">
                        <li><a class="dropdown-item" href="produit.php">Produits</a></li>
                        <li><a class="dropdown-item" href="client.php">Clients</a></li>
                        <li><a class="dropdown-item" href="vente.php">Ventes</a></li>
                        <li><a class="dropdown-item" href="recette.php">Recettes</a></li>
                        <li><a class="dropdown-item" href="depense.php">Dépenses</a></li>
                        <li><a class="dropdown-item" href="mdp.php">Mode de Paiement</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="gestion.php">Gestion financière</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<!-- <header>
        <nav class="container-fluid">
            <div class="title">
                <a href="home.php">Homechip's Laure</a>
            </div>
            <div class="block_navigation border">
                <ul class="navigation border mt-3 nav align-items-center">
                    <li ><a href="home.php" class="accueil nav-kink">Accueil</a></li>
                    <li >
                        <a href="#" class="trans nav-link text-white">Transactions<span class="arrow-down"></span></a>
                        <ul class="liste_transaction">
                            <li id="form_prod"><a href="formulaire_produit.php">Formulaire Produits</a></li><br>
                            <li id="form_cli"><a href="formulaire_client.php">Formulaire Clients</a></li><br>
                            <li id="form_ven"><a href="formulaire_vente.php">Formulaire Ventes</a></li><br>
                            <li id="form_rec"><a href="formulaire_recette.php">Formulaire Recettes</a></li><br>
                            <li id="form_dep"><a href="formulaire_depense.php">Formulaire Dépenses</a></li><br>
                            <li id="form_mdp"><a href="formulaire_mdp.php">Formulaire Mode de Paiement</a></li><br>
                        </ul>
                    </li>   
                    <li >
                        <a href="#" class="evene nav-link text-white">Evènements financiers</a><span id="arrow-down"></span>
                        <ul class="liste_evenement">
                            <li id="tab_prod"><a href="produit.php">Produits</a></li><br>
                            <li id="tab_cli"><a href="client.php">Clients</a></li><br>
                            <li id="tab_ven"><a href="vente.php">Ventes</a></li><br>
                            <li id="tab_rec"><a href="recette.php">Recettes</a></li><br>
                            <li id="tab_dep"><a href="depense.php">Dépenses</a></li><br>
                            <li id="tab_mdp"><a href="mdp.php">Mode de Paiement</a></li><br>
                        </ul>
                    </li>
                    <li ><a href="gestion.php" class="gestion nav-link text-white">Gestion financière</a></li>
                </ul>
            </div> 
        </nav>
</header> -->