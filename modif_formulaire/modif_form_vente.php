<?php
    include("../connexion.php");
    $matvente = $_GET['id'];
    $req3 = "SELECT * FROM ventes where idVente = $matvente";
    $reponse3 = $db -> query($req3);
    $donnee3 = $reponse3 -> fetchAll();

    foreach($donnee3 as $liste)
    {
        $produit = $liste['idProduit'];
        $mdp = $liste['idModePaiement'];

        $montantTotalDetails = explode(' ', $liste['MontantTotal']);
        $liste['Montant'] = $montantTotalDetails[0];
        $liste['DeviseMontantTotal'] = $montantTotalDetails[1];
    }

    $req = " SELECT * FROM produits ORDER BY idProduit";
    $reponse = $db -> query($req);
    $donnee = $reponse -> fetchAll();

    $req2 = " SELECT * FROM modepaiement ORDER BY idModePaiement";
    $reponse2 = $db -> query($req2);
    $donnee2 = $reponse2 -> fetchAll();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Modification des ventes</title>
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
        <h1 class="ajout text-center mb-4">Modifier une vente</h1>
        <form action="../validation/valider_modif_form.php" method="post">
            <fieldset class="border p-4 rounded">
                <legend class="fw-bold">Vente</legend>

                <div class="mb-3">
                    <label for="s_numero" class="form-label">Matricule Vente :</label>
                    <input type="text" id="s_numero" name="s_numero" class="form-control" value="<?= $liste['idVente'] ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="s_datevente" class="form-label">Date de Vente :</label>
                    <input type="date" id="s_datevente" name="s_datevente" class="form-control" value="<?= $liste['DateVente'] ?>">
                </div>

                <div class="mb-3">
                    <label for="s_quantitevendue" class="form-label">Quantité Vendue :</label>
                    <input type="text" id="s_quantitevendue" name="s_quantitevendue" class="form-control" value="<?= $liste['QuantiteVendue'] ?>">
                </div>

                <div class="mb-3 row">
                    <div class="col">
                        <label for="s_montanttotal" class="form-label">Montant Total :</label>
                        <input type="text" id="s_montanttotal" name="s_montanttotal" class="form-control" value="<?= $liste['Montant'] ?>">
                    </div>
                    <div class="col">
                        <label for="s_devisemontanttotal" class="form-label">Devise :</label>
                        <select id="s_devisemontanttotal" name="s_devisemontanttotal" class="form-select">
                            <option value="CFA" <?= $liste['DeviseMontantTotal'] == 'CFA' ? 'selected' : '' ?>>CFA</option>
                            <option value="EUR" <?= $liste['DeviseMontantTotal'] == 'EUR' ? 'selected' : '' ?>>Euro</option>
                            <option value="USD" <?= $liste['DeviseMontantTotal'] == 'USD' ? 'selected' : '' ?>>Dollar</option>
                            <!-- Ajoute d'autres devises si nécessaire -->
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="listproduit" class="form-label">Produit :</label>
                    <select name="s_produit" id="listproduit" class="form-select">
                        <?php
                                foreach ($donnee as $listeproduit)
                                {
                                    if($listeproduit['idProduit'] == $produit)
                                    {?>
                                        <option selected value="<?= $listeproduit['idProduit'] ?>">
                                                                <?= $listeproduit['NomProduit'] ?>
                                        </option>
                        <?php       }
                                    else
                                    {?>
                                        <option value="<?= $listeproduit['idProduit'] ?>">
                                                        <?= $listeproduit['NomProduit'] ?>
                                        </option>
                        <?php       }
                                }?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="listmode" class="form-label">Mode de Paiement :</label>
                    <select name="s_modepaiement" id="listmode" class="form-select">
                        <?php
                                foreach ($donnee2 as $listemode)
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