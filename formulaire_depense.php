<?php
    include("connexion.php");
    $req = " SELECT * FROM modepaiement ORDER BY idModePaiement";
    $reponse = $bdd -> query($req);
    $donnee = $reponse -> fetchAll();
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/form_dep.css"> -->
    <title>Formulaire des dépenses</title>
    <style>
        .ajout{
            margin-top: 60px;
            color: #198754;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include 'navbar/en_tete.php'; ?>
    
    <section class="container my-5 flex-grow-1">
        <h1 class="ajout text-center mb-4">Ajouter une dépense</h1>
        <form action="valider_transaction.php" method="post">
            <fieldset class="border p-4 rounded">
                <legend class="w-auto">Dépense</legend>
                
                <div class="mb-3">
                    <label for="montantDepense" class="form-label">Montant de Dépense :</label>
                    <input type="text" id="montantDepense" name="s_montantdepense" class="form-control montant" required>
                </div>
                
                <div class="mb-3">
                    <label for="dateDepense" class="form-label">Date de Dépense :</label>
                    <input type="date" id="dateDepense" name="s_datedepense" class="form-control date" required>
                </div>
                
                <div class="mb-3">
                    <label for="descriptionDepense" class="form-label">Description de Dépense :</label>
                    <input type="text" id="descriptionDepense" name="s_descriptiondepense" class="form-control description" required>
                </div>
                
                <div class="mb-3">
                    <label for="modePaiement" class="form-label">Mode de Paiement :</label>
                    <select name="s_modepaiement" id="modePaiement" class="form-select" required>
                        <option value="">Selectionner le mode de paiement...</option>
                        <?php foreach ($donnee as $listemode): ?>
                            <option value="<?= $listemode['idModePaiement'] ?>">
                                <?= $listemode['NomModePaiement'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </fieldset>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn btn-primary">Ajouter</button>
                <button type="reset" class="btn btn-secondary">Annuler</button>
            </div>
        </form>
    </section>

    <footer class="bg-dark text-white text-center py-4">
        <p class="mb-0 ">Copyright © 2024 Homechip's Laure | Tous droits réservés</p>
        <p class="mb-0 ">Design by: <a href="https://ari-luxury.com" class="text-white text-decoration-none">Ari-Luxury</a></p>
    </footer>

    <!-- Bootstrap JS (optional, for interactive components) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>