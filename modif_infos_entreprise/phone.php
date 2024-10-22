<?php
    session_start();

    // Vérification si l'utilisateur est connecté
    if(!isset($_SESSION['logged_in'])) {
        // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
        header("Location: ../index.php");
        exit;
    }

    include('../connexion.php');

    // Vérification de la connexion à la base de données
    if (!$bdd) {
        die("Erreur de connexion à la base de données");
    }

    $id_entreprise = $_SESSION['id_entreprise'];

    $query = "SELECT Telephone FROM entreprise WHERE id_entreprise = :id_entreprise";
    $stmt = $bdd -> prepare($query);
    $stmt -> bindParam(':id_entreprise', $id_entreprise, PDO::PARAM_INT);
    $stmt -> execute();
    $entreprise = $stmt -> fetch(PDO::FETCH_ASSOC);

    if (!$entreprise)
    {
        echo "Aucune information disponible pour l'entreprise.";
        exit;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Charge la feuille de style CSS pour la bibliothèque intl-tel-input version 17.0.8, qui stylise le champ de saisie des numéros de téléphone avec un drapeau et un code de pays -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">

    <title>Modification du numéro de téléphone</title>
    <style>
        .footer {
            /* margin-top: 4%; */
            width: 100%;
        }
        .link_back{
            font-size: 1.1rem;
        }
        .link_back:hover{
            color: blue;
        }
    </style>
    
    <?php include '../mode.php'; ?>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../navbar/en_tete.php'; ?>

    <section class="container my-5 pt-5 flex-grow-1">
        <a href="../profile/account_info.php" class="text-decoration-none text-dark">
            <p class="link_back my-5">
                <i class="fas fa-arrow-left"></i>
                <span class="ms-2">Retour</span>
            </p>
        </a>

        <h3 class="mb-2">Téléphone :</h3>
        <form method="post" action="../validation/valider_infos_entreprise.php">
            <fieldset class="border p-4 rounded">
                <div class="mb-3">
                    <label for="phone" class="form-label"></label>
                    <input type="tel" class="form-control" id="phone" name="s_phone" value="<?= htmlspecialchars($entreprise['Telephone'])?>">
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
        <p class="mb-0 ">Design by: <a href="https://ari-luxury.com" class="text-white text-decoration-none">Ari-Luxury    </a></p>
    </footer>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->

    <!-- Charge la bibliothèque intl-tel-input version 17.0.8 pour ajouter des fonctionnalités avancées à l'entrée de numéro de téléphone -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>

    <!-- Utilisation de javascript pour le champs numero de telephone  -->
    <script>
        // Sélectionne l'élément de saisie du numéro de téléphone
        const input = document.querySelector("#phone"); 

        const iti = window.intlTelInput(input, { // Initialise la bibliothèque intlTelInput pour l'élément de saisie du téléphone

            initialCountry: "", // Prend le pays automatiquement selon l'adresse IP de l'utilisateur

            separateDialCode: true, // Affiche le code du pays séparément

            preferredCountries: ["fr", "us", "gb", "ben"], // Liste des pays en priorité (exemple)

            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js" // Charge le script utils.js pour des fonctionnalités supplémentaires, comme la validation des numéros de téléphone
        });
    </script>
</body>
</html>