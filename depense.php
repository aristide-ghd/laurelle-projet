<?php
    include("connexion.php");
    $req = " SELECT * FROM depenses ";
    $reponse = $bdd -> query($req);
    $donnee = $reponse -> fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/tab_dep.css"> -->
    <title>Page Depense</title>
    <style>
        .ajout{
            margin-top: 60px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        footer {
            margin-top: auto;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include 'navbar/en_tete.php'; ?>

    <section class="container my-5 flex-grow-1">
        <h1 class=" ajout text-center mb-4">Vos dépenses s'affichent ici</h1>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Matricule Depense</th>
                        <th>Montant de Dépense</th>
                        <th>Date de Dépense</th>
                        <th>Description de Dépense</th>
                        <th>Matricule Mode de Paiement</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($donnee as $liste){  
                    ?>
                    <tr>
                        <td><?= $liste['idDepense'] ?></td>
                        <td><?= $liste['MontantDepense'] ?></td>
                        <td><?= $liste['DateDepense'] ?></td>
                        <td><?= $liste['DescriptionDepense'] ?></td>
                        <td><?= $liste['idModePaiement'] ?></td>
                        <td>
                            <a href="modif_form_recette.php?id=<?= $liste['idRecette'] ?>" class="btn btn-primary btn-sm col-lg-5 col-md-12 col-sm-12">Modifier</a>
                            <a href="modif_form_recette.php?id=<?= $liste['idRecette'] ?>"
                                onclick="return confirm('Voulez-vous supprimer cet enregistrement?')" class="btn btn-danger btn-sm col-lg-5 col-md-12 col-sm-12">Supprimer
                            </a>
                        </td>
                    </tr>
                    <?php
                        }  
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p class="mb-0">Copyright © 2024 Homechip's Laure | Tous droits réservés</p>
        <p class="mb-0">Design by: <a href="https://ari-luxury.com" class="text-white text-decoration-none">Ari-Luxury</a></p>
    </footer>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
</body>
</html>