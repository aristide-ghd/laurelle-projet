<?php
    include("../connexion.php");
    $matdep = $_GET['id'];
    $req1 = "SELECT * FROM depenses where idDepense = $matdep";
    $reponse1 = $bdd -> query($req1);
    $donnee1 = $reponse1 -> fetchAll();

    foreach($donnee1 as $liste)
    {
        $mdp = $liste['idModePaiement'];

        $montantDepenseDetails = explode(' ', $liste['MontantDepense']);
        $liste['Montant'] = $montantDepenseDetails[0];
        $liste['DeviseMontantDepense'] = $montantDepenseDetails[1];
    }

    $req = " SELECT * FROM modepaiement ORDER BY idModePaiement";
    $reponse = $bdd -> query($req);
    $donnee = $reponse -> fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Modifications des dépenses</title>
    <style>
        .ajout{
            margin-top: 60px;
            color: #0d6efd;
        }
    </style>

    <?php include '../mode.php'; ?>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../navbar/en_tete.php'; ?>

    <section class="container my-5 flex-grow-1">
        <h1 class="ajout text-center mb-4">Modifier une dépense</h1>
        <form action="../validation/valider_modif_form.php" method="post">
            <fieldset class="border p-4 rounded">
                <legend class="fw-bold">Dépense</legend>

                <div class="mb-3">
                    <label for="s_numero" class="form-label">Matricule Dépense :</label>
                    <input type="text" id="s_numero" name="s_numero" class="form-control" value="<?= $liste['idDepense'] ?>" readonly>
                </div>

                <div class="mb-3 row">
                    <div class="col">
                        <label for="s_montantdepense" class="form-label">Montant de dépense :</label>
                        <input type="text" id="s_montantdepense" name="s_montantdepense" class="form-control" value="<?= $liste['Montant'] ?>">
                    </div>
                    <div class="col">
                        <label for="s_devisemontantdepense" class="form-label">Devise :</label>
                        <select id="s_devisemontantdepense" name="s_devisemontantdepense" class="form-select">
                            <option value="CFA" <?= $liste['DeviseMontantDepense'] == 'CFA' ? 'selected' : '' ?>>CFA</option>
                            <option value="EUR" <?= $liste['DeviseMontantDepense'] == 'EUR' ? 'selected' : '' ?>>Euro</option>
                            <option value="USD" <?= $liste['DeviseMontantDepense'] == 'USD' ? 'selected' : '' ?>>Dollar</option>
                            <!-- Ajoute d'autres devises si nécessaire -->
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="s_datedepense" class="form-label">Date de Dépense :</label>
                    <input type="date" id="s_datedepense" name="s_datedepense" class="form-control" value="<?= $liste['DateDepense'] ?>">
                </div>

                <div class="mb-3">
                    <label for="s_descriptiondepense" class="form-label">Description de Dépense :</label>
                    <input type="text" id="s_descriptiondepense" name="s_descriptiondepense" class="form-control" value="<?= $liste['DescriptionDepense'] ?>">
                </div>

                <div class="mb-3">
                    <label for="listmode" class="form-label">Mode de Paiement :</label>
                    <select name="s_modepaiement" id="listmode" class="form-select">
                        <?php
                                foreach ($donnee as $listemode)
                                {
                                    if($listemode['idModePaiement'] == $mdp)
                                    {?>
                                        <option selected value="<?= $listemode['idModePaiement'] ?>">
                                                                <?= $listemode['NomModePaiement'] ?>
                                        </option>
                        <?php       }
                                    else
                                    {?>
                                        <option value="<?= $listemode['idModePaiement'] ?>">
                                                        <?= $listemode['NomModePaiement'] ?>
                                        </option>
                        <?php       }
                                }?>
                    </select>
                </div>
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