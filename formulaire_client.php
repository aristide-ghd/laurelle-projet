<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/form_prod.css"> -->
    <title>Formulaire des clients</title>
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
    <?php include 'navbar/en_tete.php'; ?>
    
    <section class="container my-5 flex-grow-1">
        <h1 class="ajout text-center mb-4">Ajouter un client</h1>
        <form action="valider_transaction.php" method="post">
            <fieldset class="border p-4 rounded">
                <legend class="w-auto">Client</legend>
                
                <div class="mb-3">
                    <label for="nomClient" class="form-label">Nom du client :</label>
                    <input type="text" id="nomClient" name="s_nomclient" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="adresseClient" class="form-label">Adresse du client :</label>
                    <input type="text" id="adresseClient" name="s_adresseclient" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="coordonneesClient" class="form-label">Coordonnées du client :</label>
                    <input type="text" id="coordonneesClient" name="s_coordonneesclient" class="form-control" required>
                </div>
                
            </fieldset>

            <div class="d-flex justify-content-between mt-4 mb-4">
                <button type="submit" class="btn btn-primary">Ajouter</button>
                <button type="reset" class="btn btn-secondary">Annuler</button>
            </div>
        </form>
    </section>

    <footer class="bg-dark text-white text-center footer py-4">
        <p class="mb-0 ">Copyright © 2024 Homechip's Laure | Tous droits réservés</p>
        <p class="mb-0 ">Design by: <a href="https://ari-luxury.com" class="text-white text-decoration-none">Ari-Luxury</a></p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
</body>
</html>