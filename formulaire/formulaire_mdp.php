<?php
    session_start();
    
    // Vérification si l'utilisateur est connecté
    if(!isset($_SESSION['logged_in'])) {
        // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
        header("Location: ../index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Formulaire du Mode de Paiement</title>
    <style>
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .ajout{
            margin-top: 60px;
            color: #198754;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../navbar/en_tete.php'; ?>
    
    <section class="container mt-5 flex-grow-1">
        <h1 class="ajout text-center mb-4">Ajouter un Mode de Paiement</h1>
        <form action="../validation/valider_transaction.php" method="post">
            <fieldset class="border p-4 rounded">
                <legend class="w-auto">Mode de Paiement</legend>
                
                <div class="mb-3">
                    <label for="nomModePaiement" class="form-label">Nom Mode de Paiement :</label>
                    <input type="text" id="nomModePaiement" name="s_nom_modepaiement" class="form-control nom_mode" required>
                </div>
            </fieldset>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn btn-primary">Ajouter</button>
                <button type="reset" class="btn btn-secondary">Annuler</button>
            </div>
        </form>
    </section>

    <footer class="bg-dark text-white text-center py-4 footer">
        <p class="mb-0 ">Copyright © 2024 Homechip's Laure | Tous droits réservés</p>
        <p class="mb-0 ">Design by: <a href="https://ari-luxury.com" class="text-white text-decoration-none">Ari-Luxury</a></p>
    </footer>

    <!-- Bootstrap JS (optional, for interactive components) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>