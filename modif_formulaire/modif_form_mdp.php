<?php
    include("../connexion.php");
    $matmdp = $_GET['id'];
    $req1 = "SELECT * FROM modepaiement where idModePaiement = $matmdp";
    $reponse1 = $db -> query($req1);
    $donnee1 = $reponse1 -> fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Modification du Mode de Paiement</title>
    <style>
        .ajout{
            margin-top: 60px;
            color: #0d6efd;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../navbar/en_tete.php'; ?>

    <section class="container my-5 flex-grow-1">
        <h1 class="ajout text-center mb-4">Modifier un mode de paiement</h1>
        <form action="../validation/valider_modif_form.php" method="post">
            <fieldset class="border p-4 rounded">
                <legend class="fw-bold">Mode de Paiement</legend>

                <?php foreach($donnee1 as $liste){ ?>

                <div class="mb-3">
                    <label for="s_numero" class="form-label">Matricule Mode Paiement :</label>
                    <input type="text" id="s_numero" name="s_numero" class="form-control" value="<?= $liste['idModePaiement'] ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="s_nom_modepaiement" class="form-label">Nom Mode de Paiement :</label>
                    <input type="text" id="s_nom_modepaiement" name="s_nom_modepaiement" class="form-control" value="<?= $liste['NomModePaiement'] ?>">
                </div>

                <?php } ?>
            </fieldset>

            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-primary">Ajouter</button>
                <button type="reset" class="btn btn-secondary">Annuler</button>
            </div>
        </form>
    </section>

    <footer class="footer bg-dark text-white text-center py-4">
        <p class="mb-0 ">Copyright © 2024 Homechip's Laure | Tous droits réservés</p>
        <p class="mb-0 ">Design by: <a href="https://ari-luxury.com" class="text-white text-decoration-none">Ari-Luxury</a></p>
    </footer>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>