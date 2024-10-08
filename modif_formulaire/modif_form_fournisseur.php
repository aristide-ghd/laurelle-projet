<?php
    include('../connexion.php');
    $matfournisseur = $_GET['id'];
    $req = "SELECT * FROM fournisseurs where idFournisseur= $matfournisseur";
    $reponse = $db -> query($req);
    $donnee = $reponse -> fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Modifications des fournisseurs</title>
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
        <h1 class="ajout text-center mb-4">Modifier un fournisseur</h1>
        <form action="../validation/valider_modif_form.php" method="post">
            <fieldset class="border p-4 rounded">
                <legend class="fw-bold">Fournisseur</legend>
                <?php foreach($donnee as $liste){ ?>
                    <div class="mb-3">
                        <label for="s_numero" class="form-label">Matricule fournisseur :</label>
                        <input type="text" id="s_numero" name="s_numero" class="form-control" value="<?= $liste['idFournisseur'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="s_nomfournisseur" class="form-label">Nom du fournisseur :</label>
                        <input type="text" id="s_nomfournisseur" name="s_nomfournisseur" class="form-control" value="<?= $liste['NomFournisseur'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="s_adressefournisseur" class="form-label">Adresse du fournisseur :</label>
                        <input type="text" id="s_adressefournisseur" name="s_adressefournisseur" class="form-control" value="<?= $liste['AdresseFournisseur'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="s_coordonneesfournisseur" class="form-label">Coordonnées du fournisseur :</label>
                        <input type="text" id="s_coordonneesfournisseur" name="s_coordonneesfournisseur" class="form-control" value="<?= $liste['CoordonneesFournisseur'] ?>">
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
