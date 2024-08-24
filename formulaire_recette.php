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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/form_rec.css"> -->
    <title>Formulaire des recettes</title>
    <style>
        .ajout{
            margin-top: 60px;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include 'navbar/en_tete.php'; ?>
    
    <section class="container my-5 flex-grow-1">
        <h1 class="ajout text-center text-danger mb-4">Ajouter une recette</h1>
        <form action="valider_transaction.php" method="post">
            <fieldset class="border p-4 rounded">
                <legend class="w-auto">Recette</legend>
                
                <div class="mb-3">
                    <label for="montantRecette" class="form-label">Montant de Recette :</label>
                    <input type="text" id="montantRecette" name="s_montantrecette" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="dateRecette" class="form-label">Date de Recette :</label>
                    <input type="date" id="dateRecette" name="s_daterecette" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="descriptionRecette" class="form-label">Description de Recette :</label>
                    <input type="text" id="descriptionRecette" name="s_descriptionrecette" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="listmode" class="form-label">Mode de Paiement :</label>
                    <select name="s_modepaiement" id="listmode" class="form-select" required>
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

    <!-- Bootstrap JS and dependencies -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
</body>
</html>