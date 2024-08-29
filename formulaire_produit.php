<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/form_prod.css"> -->
    <title>Formulaire des produits</title>
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
        <h1 class="ajout text-center mb-4">Ajouter un produit</h1>
        <form action="valider_transaction.php" method="post">
            <fieldset class="border p-4 rounded">
                <legend class="w-auto">Produit</legend>
                
                <div class="mb-3">
                    <label for="nomProduit" class="form-label">Nom du Produit :</label>
                    <input type="text" id="nomProduit" name="s_nomproduit" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="descriptionProduit" class="form-label">Description du Produit :</label>
                    <input type="text" id="descriptionProduit" name="s_descriptionproduit" class="form-control" required>
                </div>
                
                <!-- <div class="mb-3">
                    <label for="prixVente" class="form-label">Prix de vente :</label>
                    <input type="text" id="prixVente" name="s_prixvente" class="form-control" required>
                </div> -->
                <div class="mb-3 row">
                    <div class="col">
                        <label for="prixVente" class="form-label">Prix de vente :</label>
                        <input type="text" id="prixVente" name="s_prixvente" class="form-control" required>
                    </div>
                    <div class="col">
                        <label for="devisePrixVente" class="form-label">Devise :</label>
                        <select id="devisePrixVente" name="s_deviseprixvente" class="form-select" required>
                            <option value="">Selectionner la monnaie...</option>
                            <option value="CFA">CFA</option>
                            <option value="EUR">Euro</option>
                            <option value="USD">Dollar</option>
                            <!-- Ajouter d'autres devises si nécessaire -->
                        </select>
                    </div>
                </div>
                
                <!-- <div class="mb-3">
                    <label for="coutUnit" class="form-label">Coût unitaire :</label>
                    <input type="text" id="coutUnit" name="s_coutunit" class="form-control" required>
                </div> -->
                <div class="mb-3 row">
                    <div class="col">
                        <label for="coutUnit" class="form-label">Coût unitaire :</label>
                        <input type="text" id="coutUnit" name="s_coutunit" class="form-control" required>
                    </div>
                    <div class="col">
                        <label for="deviseCoutUnit" class="form-label">Devise :</label>
                        <select id="deviseCoutUnit" name="s_devisecoutunit" class="form-select" required>
                            <option value="">Selectionner la monnaie...</option>
                            <option value="CFA">CFA</option>
                            <option value="EUR">Euro</option>
                            <option value="USD">Dollar</option>
                            <!-- Ajouter d'autres devises si nécessaire -->
                        </select>
                    </div>
                </div>
            </fieldset>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn btn-primary">Ajouter</button>
                <button type="reset" class="btn btn-secondary">Annuler</button>
            </div>
        </form>
    </section>

    <footer class="footer bg-dark text-white text-center py-4">
        <p class="mb-0 ">Copyright © 2024 Homechip's Laure | Tous droits réservés</p>
        <p class="mb-0 ">Design by: <a href="https://ari-luxury.com" class="text-white text-decoration-none">Ari-Luxury</a></p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->

    <!-- Bootstrap JS and dependencies -->
    <script>
        const devisePrixVente = document.getElementById('devisePrixVente');
        const deviseCoutUnit = document.getElementById('deviseCoutUnit');

        // Fonction pour synchroniser les devises
        function syncDevises(event) {
            if (event.target.id === 'devisePrixVente') {
                deviseCoutUnit.value = event.target.value;
            } else if (event.target.id === 'deviseCoutUnit') {
                devisePrixVente.value = event.target.value;
            }
        }

        // Ajout des écouteurs d'événements pour les deux sélecteurs
        devisePrixVente.addEventListener('change', syncDevises);
        deviseCoutUnit.addEventListener('change', syncDevises);
    </script>
</body>
</html>