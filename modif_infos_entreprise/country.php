<?php
    session_start();

    // Recuperer le message des champs stocké dans la session (si disponible)
    $message_country_input = isset($_SESSION['message_country_input']) ? $_SESSION['message_country_input'] : '';

    // Recuperer le message de succès stocké dans la session (si disponible)
    $message_country_success = isset($_SESSION['message_country_success']) ? $_SESSION['message_country_success'] : '';

    // Recuperer le message d'error stocké dans la session (si disponible)
    $message_country_error = isset($_SESSION['message_country_error']) ? $_SESSION['message_country_error'] : '';


    // Supprimer le message des champs apres l'avoir affiché pour eviter qu'il persiste
    unset($_SESSION['message_country_input']);

    // Supprimer le message de succès apres l'avoir affiché pour eviter qu'il persiste
    unset($_SESSION['message_country_success']);

    // Supprimer le message d'error apres l'avoir affiché pour eviter qu'il persiste
    unset($_SESSION['message_country_error']);


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

    $query = "SELECT Pays FROM entreprise WHERE id_entreprise = :id_entreprise";
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

    <title>Modification du pays</title>
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

        <!-- Affichage du message des champs -->
        <?php if($message_country_input != ""): ?>
            <div class="alert alert-warning" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $message_country_input; ?>
            </div>
        <?php endif; ?>

        <!-- Affichage du message de succès -->
        <?php if($message_country_success != ""): ?>
            <div class="alert alert-success" role="alert">
                <i class="fas fa-check-circle"></i> <?php echo $message_country_success; ?>
            </div>
            <!-- Utilisation de javascript pour la redirection -->
            <script>
                setTimeout(function() {
                    window.location.href = "../profile/account_info.php"; // redirige vers la page d'accueil
                }, 3000); // délai de 3 secondes
            </script>
        <?php endif; ?>

        <!-- Affichage du message d'error -->
        <?php if($message_country_error != ""): ?>
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $message_country_error; ?>
            </div>
        <?php endif; ?>

        <h3 class="mb-2">Pays :</h3>
        <form method="post" action="../validation/valider_infos_entreprise.php">
            <fieldset class="border p-4 rounded">
                <div class="mb-3">
                    <label for="country" class="form-label"></label>
                    <select class="form-select rounded-5" id="country" name="s_country" value="<?= htmlspecialchars($entreprise['Pays'])?>"></select>
                </div>
            </fieldset>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" name="submit_country" class="btn btn-primary">Ajouter</button>
                <button type="reset" class="btn btn-secondary">Annuler</button>
            </div>
        </form>
    </section>

    <?php
        include("../footer/pied_de_page.php");
    ?>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->

    <!-- Charge la bibliothèque intl-tel-input version 17.0.8 pour ajouter des fonctionnalités avancées à l'entrée de numéro de téléphone -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>

    <!-- Utilisation du javascript pour le champs Pays -->
    <script>
        // Fonction asynchrone pour récupérer la liste des pays à partir de l'API
        async function fetchCountries() {
            try {
                // Effectue une requête pour obtenir la liste de tous les pays via l'API REST Countries
                const response = await fetch('https://restcountries.com/v3.1/all');

                // Convertit la réponse en JSON
                const countries = await response.json();

                // Trier les pays par ordre alphabétique
                countries.sort((a, b) => a.name.common.localeCompare(b.name.common));

                // Sélectionne l'élément de liste déroulante pour les pays
                const countrySelect = document.getElementById('country');
                
                // Parcourt chaque pays et crée une option correspondante dans la liste déroulante
                countries.forEach(country => {

                    // Crée un nouvel élément option
                    const option = document.createElement('option');

                    // Utilise le code du pays (par exemple US, FR) comme valeur de l'option
                    option.value = country.cca2;

                    // Utilise le nom commun du pays comme texte visible dans la liste
                    option.textContent = country.name.common;

                    // Ajoute cette option à la liste déroulante
                    countrySelect.appendChild(option);
                });

            } catch (error) {
                console.error('Erreur lors de la récupération des pays:', error);
            }
        }

        // Appeler la fonction pour remplir la liste
        fetchCountries();
    </script>
</body>
</html>