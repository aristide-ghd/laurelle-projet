<?php
    session_start();
    
    // Vérification si l'utilisateur est connecté
    if(!isset($_SESSION['logged_in'])) {
        // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
        header("Location: ../index.php");
        exit;
    }
    
    include("../connexion.php");
    $req = " SELECT * FROM produits ORDER BY idProduit";
    $reponse = $bdd -> query($req);
    $donnee = $reponse -> fetchAll();

    $req2 = " SELECT * FROM modepaiement ORDER BY idModePaiement";
    $reponse2 = $bdd -> query($req2);
    $donnee2 = $reponse2 -> fetchAll();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Formulaire des ventes</title>
    <style>
        .ajout{
            margin-top: 60px;
            color: #198754;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../navbar/en_tete.php'; ?>
    
    <section class="container my-5 flex-grow-1">
        <h1 class=" ajout text-center mb-4">Enregistrer une vente</h1>
        <form action="../validation/valider_transaction.php" method="post">
            <fieldset class="border p-4 rounded"> 
                <legend class="w-auto px-2">Vente</legend>
                
                <div class="mb-3">
                    <label for="s_datevente" class="form-label">Date de Vente :</label>
                    <input type="date" name="s_datevente" class="form-control" id="s_datevente" required>
                </div>
                
                <div class="mb-3">
                    <label for="s_quantitevendue" class="form-label">Quantité Vendue :</label>
                    <input type="number" name="s_quantitevendue" class="form-control" id="s_quantitevendue" required>
                </div>
                
                <div class="mb-3 row">
                    <div class="col">
                        <label for="s_montanttotal" class="form-label">Montant Total :</label>
                        <input type="text" id="s_montanttotal" name="s_montanttotal" class="form-control" required>
                    </div>
                    <div class="col">
                        <label for="deviseMontantTotal" class="form-label">Devise :</label>
                        <select id="deviseMontantTotal" name="s_devisemontanttotal" class="form-select" required>
                            <option value="">Selectionner la monnaie...</option>
                            <option value="CFA">CFA</option>
                            <option value="EUR">Euro</option>
                            <option value="USD">Dollar</option>
                            <!-- Ajouter d'autres devises si nécessaire -->
                        </select>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="listproduit" class="form-label">Produit :</label>
                    <select name="s_produit" id="listproduit" class="form-select" required>
                        <option value="">Selectionner le produit...</option>
                        <?php foreach ($donnee as $listeproduit): ?>
                            <option value="<?= $listeproduit['idProduit'] ?>">
                                <?= $listeproduit['NomProduit'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="listmode" class="form-label">Mode de Paiement :</label>
                    <select name="s_modepaiement" id="listmode" class="form-select" required>
                        <option value="">Selectionner le mode de paiement...</option>
                        <?php foreach ($donnee2 as $listemode): ?>
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
