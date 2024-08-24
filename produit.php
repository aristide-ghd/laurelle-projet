<?php
    include('connexion.php');
    $req= "SELECT * FROM produits";
    $reponse= $bdd -> query($req);
    $donnee= $reponse -> fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/tab_prod.css"> -->
    <title>Page Produit</title>
    <style>
        .ajout{
            margin-top: 60px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        footer{
            margin-top: auto;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include 'navbar/en_tete.php'; ?>

    <section class="container mt-5 flex-grow-1">
        <h1 class="ajout text-center mb-4">Voici une liste de vos produits</h1>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Matricule Produit</th>
                        <th>Nom du produit</th>
                        <th>Description du Produit</th>
                        <th>Prix de Vente</th>
                        <th>Cout Unitaire</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($donnee as $liste){ 
                    ?>
                    <tr>
                        <td><?= $liste['idProduit'] ?></td>
                        <td><?= $liste['NomProduit'] ?></td>
                        <td><?= $liste['DescriptionProduit'] ?></td>
                        <td><?= $liste['PrixVente'] ?></td>
                        <td><?= $liste['CoutUnitaire'] ?></td>
                        <td>
                            <a href="modif_form_prod.php?id=<?= $liste['idProduit'] ?>" class="btn btn-primary btn-sm col-lg-5 col-md-12 col-sm-12">Modifier</a>
                            <a href="modif_form_prod.php?id=<?= $liste['idProduit'] ?>"
                                onclick="return confirm('Voulez-vous supprimer cet enregistrement?')" class="btn btn-danger btn-sm col-lg-5 col-md-12 col-sm-12">Supprimer</a>
                        </td>
                    </tr>
                    <?php 
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <footer class="footer bg-dark text-white text-center py-4">
        <p class="mb-0 ">Copyright © 2024 Homechip's Laure | Tous droits réservés</p>
        <p class="mb-0 ">Design by: <a href="https://ari-luxury.com" class="text-white text-decoration-none">Ari-Luxury</a></p>
    </footer>

    <!-- Bootstrap JS (optional, for interactive components) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/tab_prod.css">
    <title>Page Produit</title>
</head>
<body>
    <section>
        <h1>Voici une liste de vos produits</h1>
        <table>
            <thead>
                <tr>
                    <th>Matricule Produit</th>
                    <th>Nom du produit</th>
                    <th>Description du Produit</th>
                    <th>Prix de Vente</th>
                    <th>Cout Unitaire</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($donnee as $liste){ 
                ?>
                <tr>
                    <td><?= $liste['idProduit'] ?></td>
                    <td><?= $liste['NomProduit'] ?></td>
                    <td><?= $liste['DescriptionProduit'] ?></td>
                    <td><?= $liste['PrixVente'] ?></td>
                    <td><?= $liste['CoutUnitaire'] ?></td>
                    <td>
                        <button class="btn1">
                            <a href="modif_form_prod.php?id=<?= $liste['idProduit'] ?>">Modifier</a>
                        </button>
                        <button class="btn2">
                            <a href="modif_form_prod.php?id=<?= $liste['idProduit'] ?>"
                                onclick="return confirm('Voulez-vous supprimez ce enregistrement?')">Supprimer</a>
                        </button>
                    </td>
                </tr>
                <?php 
                    }
                ?>
            </tbody>
        </table>
    </section>
    <div class="footer">
        <p>Copyright © 2024 Homechip's Laure | Tous droits réservés <br>
            Design by: <a href="https://ari-luxury.com">Ari-Luxury</a>
        </p>
    </div>
</body>
</html> -->