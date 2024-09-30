<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homechip's Laure</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @media only screen and (max-width: 576px) {
            .sous_menu {
                margin-left: 39px;
            }
            .logout{
                margin-top: 15px;
            }
        
        }
        header{
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }
        /* .offcanvas-end {
            width: 250px;
        } */
        .offcanvas-header {
            border-bottom: 1px solid #dee2e6;
        }
        .offcanvas-body {
            padding: 1rem;
        }
    </style>
</head>
<body>
<header class="bg-dark py-2">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark container-fluid">
        <a class="navbar-brand ms-5 fw-bold" href="../dashbord/home.php">Homechip's Laure</a>
        <button class="navbar-toggler me-5 border border-secondary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasMenuLabel"><a class="navbar-brand fw-bold text-dark" href="../dashbord/home.php">Homechip's Laure</a></h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body bg-dark">
                <ul class="navbar-nav flex-column-md ms-lg-auto me-lg-5">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../dashbord/home.php">Accueil</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-white dropdown-toggle" href="#" id="dropdownTransactions" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Transactions
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownTransactions">
                            <li><a class="dropdown-item" href="../formulaire/formulaire_produit.php">Formulaire Produits</a></li>
                            <li><a class="dropdown-item" href="../formulaire/formulaire_fournisseur.php">Formulaire Fournisseurs</a></li>
                            <li><a class="dropdown-item" href="../formulaire/formulaire_vente.php">Formulaire Ventes</a></li>
                            <li><a class="dropdown-item" href="../formulaire/formulaire_recette.php">Formulaire Recettes</a></li>
                            <li><a class="dropdown-item" href="../formulaire/formulaire_depense.php">Formulaire Dépenses</a></li>
                            <li><a class="dropdown-item" href="../formulaire/formulaire_mdp.php">Formulaire Mode de Paiement</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-white dropdown-toggle" href="#" id="dropdownEvents" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Evènements financiers
                        </a>
                        <ul class="dropdown-menu ms-lg-2" aria-labelledby="dropdownEvents">
                            <li><a class="dropdown-item" href="../dashbord/produit.php">Produits</a></li>
                            <li><a class="dropdown-item" href="../dashbord/fournisseur.php">Fournisseurs</a></li>
                            <li><a class="dropdown-item" href="../dashbord/vente.php">Ventes</a></li>
                            <li><a class="dropdown-item" href="../dashbord/recette.php">Recettes</a></li>
                            <li><a class="dropdown-item" href="../dashbord/depense.php">Dépenses</a></li>
                            <li><a class="dropdown-item" href="../dashbord/mdp.php">Mode de Paiement</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../dashbord/gestion.php">Gestion financière</a>
                    </li>
                    <li class="nav-item ms-lg-5 logout">
                        <a class="btn btn-danger w-lg-auto w-md-auto w-100 my-xs-3 my-sm-3 my-md-0" href="../dashbord/logout.php">
                            <i class="fas fa-sign-out-alt"></i> Profil
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</header>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>