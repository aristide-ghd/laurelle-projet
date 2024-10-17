<?php
    include('../connexion.php');
    $matprod = $_GET['id'];
    $req = "SELECT * FROM produits where idProduit= $matprod";
    $reponse = $bdd -> query($req);
    $donnee = $reponse -> fetchAll();

    // Séparer le prix de vente et la devise
    foreach ($donnee as &$liste) {
        $prixVenteDetails = explode(' ', $liste['PrixVente']);
        $liste['Prix'] = $prixVenteDetails[0]; // Le prix sans la devise
        $liste['DevisePrixVente'] = $prixVenteDetails[1]; // La devise
        $coutUnitDetails = explode(' ', $liste['CoutUnitaire']);
        $liste['Cout'] = $coutUnitDetails[0]; // Le coût unitaire sans la devise
        $liste['DeviseCoutUnit'] = $coutUnitDetails[1]; // La devise
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Modification des produits</title>
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
        <h1 class="ajout text-center mb-4">Modification d'un produit</h1>
        <form action="../validation/valider_modif_form.php" method="post">
            <fieldset class="border p-4 rounded">
                <legend class="fw-bold">Produit</legend>

                <?php foreach($donnee as $liste){ ?>
                    <div class="mb-3">
                        <label for="s_numero" class="form-label">Matricule Produit :</label>
                        <input type="text" id="s_numero" name="s_numero" class="form-control" value="<?= $liste['idProduit'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="s_nomproduit" class="form-label">Nom du Produit :</label>
                        <input type="text" id="s_nomproduit" name="s_nomproduit" class="form-control" value="<?= $liste['NomProduit'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="s_descriptionproduit" class="form-label">Description du Produit :</label>
                        <input type="text" id="s_descriptionproduit" name="s_descriptionproduit" class="form-control" value="<?= $liste['DescriptionProduit'] ?>">
                    </div>
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="s_prixvente" class="form-label">Prix de vente :</label>
                            <input type="text" id="s_prixvente" name="s_prixvente" class="form-control" value="<?= $liste['Prix'] ?>">
                        </div>
                        <div class="col">
                            <label for="s_deviseprixvente" class="form-label">Devise :</label>
                            <select id="s_deviseprixvente" name="s_deviseprixvente" class="form-select" onchange="synchronizeCurrencies(this)">
                                <option value="CFA" <?= $liste['DevisePrixVente'] == 'CFA' ? 'selected' : '' ?>>CFA</option>
                                <option value="EUR" <?= $liste['DevisePrixVente'] == 'EUR' ? 'selected' : '' ?>>Euro</option>
                                <option value="USD" <?= $liste['DevisePrixVente'] == 'USD' ? 'selected' : '' ?>>Dollar</option>
                                <!-- Ajoute d'autres devises si nécessaire -->
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col">
                            <label for="s_coutunit" class="form-label">Coût unitaire :</label>
                            <input type="text" id="s_coutunit" name="s_coutunit" class="form-control" value="<?= $liste['Cout'] ?>">
                        </div>
                        <div class="col">
                            <label for="s_devisecoutunit" class="form-label">Devise :</label>
                            <select id="s_devisecoutunit" name="s_devisecoutunit" class="form-select" onchange="synchronizeCurrencies(this)">
                                <option value="CFA" <?= $liste['DeviseCoutUnit'] == 'CFA' ? 'selected' : '' ?>>CFA</option>
                                <option value="EUR" <?= $liste['DeviseCoutUnit'] == 'EUR' ? 'selected' : '' ?>>Euro</option>
                                <option value="USD" <?= $liste['DeviseCoutUnit'] == 'USD' ? 'selected' : '' ?>>Dollar</option>
                                <!-- Ajoute d'autres devises si nécessaire -->
                            </select>
                        </div>
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

    <script>
        function synchronizeCurrencies(selectedElement) {
            var selectedValue = selectedElement.value;

            // Synchroniser la devise Prix de vente avec Coût unitaire et vice versa
            if (selectedElement.id === 's_deviseprixvente') {
                document.getElementById('s_devisecoutunit').value = selectedValue;
            } else {
                document.getElementById('s_deviseprixvente').value = selectedValue;
            }
        }
    </script>
</body>
</html>