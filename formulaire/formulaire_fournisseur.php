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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Formulaire des fournisseurs</title>
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

    <?php include '../mode.php'; ?>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../navbar/en_tete.php'; ?>
    
    <section class="container my-5 flex-grow-1">
        <h1 class="ajout text-center mb-4">Ajouter un fournisseur</h1>
        <form action="../validation/valider_transaction.php" method="post">
            <fieldset class="border p-4 rounded">
                <legend class="w-auto">Fournisseur</legend>
                
                <div class="mb-3">
                    <label for="nomFournisseur" class="form-label">Nom du fournisseur :</label>
                    <input type="text" id="nomFournisseur" name="s_nomfournisseur" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="adresseFournisseur" class="form-label">Adresse du fournisseur :</label>
                    <input type="text" id="adresseFournisseur" name="s_adressefournisseur" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="coordonneesFournisseur" class="form-label">Coordonnées du fournisseur :</label>
                    <input type="text" id="coordonneesFournisseur" name="s_coordonneesfournisseur" class="form-control" required>
                </div>
                
            </fieldset>

            <div class="d-flex justify-content-between mt-4 mb-4">
                <button type="submit" class="btn btn-primary">Ajouter</button>
                <button type="reset" class="btn btn-secondary">Annuler</button>
            </div>
        </form>
    </section>

    <?php
        include("../footer/pied_de_page.php");
    ?>

    <!-- Bootstrap JS and dependencies -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
</body>
</html>