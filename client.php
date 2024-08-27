<?php 
    include('connexion.php');
    $req = "SELECT * FROM clients";
    $reponse = $bdd -> query($req);
    $donnee = $reponse -> fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/tab_cli.css"> -->
    <title>Page Client</title>
    <style>
        .ajout {
            margin-top: 60px;
        }
        footer {
            margin-top: auto;
            bottom: 0;
            width: 100%;
        }
        .table-responsive {
            overflow-x: auto;
        }
        @media (max-width: 768px) {
            .ajout {
                margin-top: 50px;
            }
            footer {
                margin-top: 20%;
            }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include 'navbar/en_tete.php'; ?>
    
    <section class="container my-5 flex-grow-1">
        <h1 class="ajout mb-4 text-center">Liste des clients</h1>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Matricule Client</th>
                        <th>Nom du Client</th>
                        <th>Adresse du Client</th>
                        <th>Coordonnées du Client</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($donnee as $liste){
                    ?>
                    <tr>
                        <td><?= $liste['idClient'] ?></td>
                        <td><?= $liste['NomClient'] ?></td>
                        <td><?= $liste['AdresseClient'] ?></td>
                        <td><?= $liste['CoordonneesClient'] ?></td>
                        <td>
                            <a href="modif_form_client.php?id=<?= $liste['idClient'] ?>" class="btn btn-primary btn-sm col-lg-5 col-md-12 col-sm-12">Modifier</a>
                            <a href="modif_form_client.php?id=<?= $liste['idClient'] ?>"
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

    <footer class="footer bg-dark text-white text-center py-4 mt-auto">
        <p class="mb-0 ">Copyright © 2024 Homechip's Laure | Tous droits réservés</p>
        <p class="mb-0 ">Design by: <a href="https://ari-luxury.com" class="text-white text-decoration-none">Ari-Luxury</a></p>
    </footer>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
</body>
</html>



<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/tab_cli.css">
    <title>Page Client</title>
</head>
<body>
    <section>
        <h1>Liste des clients avec qui vous communiquez</h1>
        <table>
            <thead>
                <tr>
                    <th>Matricule Client</th>
                    <th>Nom du Client</th>
                    <th>Adresse du Client</th>
                    <th>Coordonnées du Client</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($donnee as $liste){
                ?>
                <tr>
                    <td><?= $liste['idClient'] ?></td>
                    <td><?= $liste['NomClient'] ?></td>
                    <td><?= $liste['AdresseClient'] ?></td>
                    <td><?= $liste['CoordonneesClient'] ?></td>
                    <td>
                        <button class="btn1">
                            <a href="modif_form_client.php?id=<?= $liste['idClient'] ?>">Modifier</a>
                        </button>
                        <button class="btn2">
                            <a href="modif_form_client.php?id=<?= $liste['idClient'] ?>"
                                onclick= "return confirm('Voulez-vous supprimez cet enregistrement?')">Supprimer</a>
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