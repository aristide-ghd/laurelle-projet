<?php
    session_start();
    
    // Vérification si l'utilisateur est connecté
    if(!isset($_SESSION['logged_in'])) {
        // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
        header("Location: ../index.php");
        exit;
    }

    include("../connexion.php");
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
    <title>Formulaire des dépenses</title>
    <style>
        .ajout{
            margin-top: 60px;
            color: #198754;
        }
    </style>

    <?php include '../mode.php'; ?>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../navbar/en_tete.php'; ?>
    
    <section class="container my-5 flex-grow-1">
        <h1 class="ajout text-center mb-4">Ajouter une dépense</h1>
        <form action="../validation/valider_transaction.php" method="post">
            <fieldset class="border p-4 rounded">
                <legend class="w-auto">Dépense</legend>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="montantDepense" class="form-label">Montant de Dépense :</label>
                        <input type="text" id="montantDepense" name="s_montantdepense" class="form-control montant" required>
                    </div>
                    <div class="col">
                        <label for="deviseMontantDepense" class="form-label">Devise :</label>
                        <select id="deviseMontantDepense" name="s_devisemontantdepense" class="form-select" required>
                            <option value="">Selectionner la monnaie...</option>
                            <option value="CFA">CFA</option>
                            <option value="EUR">Euro</option>
                            <option value="USD">Dollar</option>
                            <!-- Ajouter d'autres devises si nécessaire -->
                        </select>
                    </div>
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

    <?php
        include("../footer/pied_de_page.php");
    ?>

    <!-- Bootstrap JS (optional, for interactive components) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>