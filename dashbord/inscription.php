<?php
    session_start();

    // Récupere le message des champs stocké dans la session (si disponible)
    $message_input = isset($_SESSION['message_input']) ? $_SESSION['message_input'] : '';

    // Récupere le message de mot de passe stocké dans la session (si disponible)
    $message_password = isset($_SESSION['message_password']) ? $_SESSION['message_password'] : '';

    // Récupere le message d'utilisateur stocké dans la session (si disponible)
    $message_user = isset($_SESSION['message_user']) ? $_SESSION['message_user'] : '';

    // Récupere le message d'inscription stocké dans la session (si disponible)
    $message_register = isset($_SESSION['message_register']) ? $_SESSION['message_register'] : '';


    // Supprime le message des champs après l affiché pour éviter qu'il persiste
    unset($_SESSION['message_input']);

    // Supprime le message de mot de passe après l affiché pour éviter qu'il persiste
    unset($_SESSION['message_password']);

    // Supprime le message d'utilisateur après l affiché pour éviter qu'il persiste
    unset($_SESSION['message_user']);

    // Supprime le message d'inscription après l affiché pour éviter qu'il persiste
    unset($_SESSION['message_register']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Charge la feuille de style Bootstrap 5.3.3 pour styliser la page avec le framework CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Charge la bibliothèque de styles Font Awesome version 6.0.0 pour afficher des icônes vectorielles (comme des utilisateurs, des flèches, etc.) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Charge la feuille de style CSS pour la bibliothèque intl-tel-input version 17.0.8, qui stylise le champ de saisie des numéros de téléphone avec un drapeau et un code de pays -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
    <title>Page d'inscription</title>
    <style>
        .pays{
            padding-top: 14px;
            padding-bottom: 15px;
        }
        body {
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            font-family: 'Roboto', sans-serif;
        }
        .card {
            border: none;
            border-radius: 20px;
        }
        .card-body {
            background-color: #f8f9fa;
            border-radius: 20px;
        }
        .btn-primary {
            border: none;
            border-radius: 50px;
            transition: background-color 0.3s ease-in-out;
        }
        .form-control {
            border-radius: 50px;
            padding: 15px;
        }
        .form-label {
            font-weight: bold;
        }
        .text-primary {
            font-size: 2rem;
            font-weight: bold;
        }
        .link_login{
            text-decoration: none;
        }
        .link_login:hover
        {
            text-decoration: underline;
            color: blue;
        }
    </style>
</head>
<body>
    <div class="container d-lg-flex d-md-block d-sm-block justify-content-center mt-5 my-md-4 py-lg-5 py-md-0 my-sm-4">
        <div class="card shadow-lg p-3 mb-5 bg-body-tertiary rounded">
            <div class="row g-0">
                <!-- Section image -->
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <img class="img-fluid rounded h-100" src="../image/register2.jpg" alt="Image d'inscription">
                </div>
                <!-- Formulaire d'inscription -->
                <div class="col-lg-6 col-md-12 col-sm-12 d-flex align-items-center">
                    <div class="card-body p-5">
                        <h2 class="text-primary text-center mb-4"><i class="fas fa-user-plus me-2"></i>Inscrivez-vous</h2>
                        <form action="../validation/valider_inscription.php" method="post">
                            <?php if($message_input != ""): ?>
                                <div class="alert alert-warning" role="alert">
                                    <i class="fas fa-exclamation-triangle"></i> <?php echo $message_input; ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if($message_password != ""): ?>
                                <div class="alert alert-danger" role="alert">
                                    <i class="fas fa-exclamation-triangle"></i> <?php echo $message_password; ?>
                                </div>
                            <?php endif; ?>

                            <?php if($message_user != ""): ?>
                                <div class="alert alert-info" role="alert">
                                    <i class="fas fa-exclamation-circle"></i> <?php echo $message_user; ?>
                                </div>
                            <?php endif; ?>

                            <?php if($message_register != ""): ?>
                                <div class="alert alert-success" role="alert">
                                    <i class="fas fa-check-circle"></i> <?php echo $message_register; ?>
                                </div>
                            <?php endif; ?>

                            <fieldset>
                                <div class="row">
                                    <!-- Nom -->
                                    <div class="col-md-6 mb-3">
                                        <label for="nom" class="form-label">Nom :</label>
                                        <input type="text" class="form-control" id="nom" name="s_nom" placeholder="Votre nom">
                                    </div> 
                                    <!-- Prénom -->
                                    <div class="col-md-6 mb-3">
                                        <label for="prenom" class="form-label">Prénom :</label>
                                        <input type="text" class="form-control" id="prenom" name="s_prenom" placeholder="Votre prénom">
                                    </div>
                                </div>
                                
                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email :</label>
                                    <input type="email" class="form-control" id="email" name="s_email" placeholder="Votre email">
                                </div>
                                
                                <div class="row">
                                    <!-- Numéro de téléphone -->
                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                        <label for="phone" class="form-label">Numéro de téléphone :</label>
                                        <input type="tel" id="phone" name="s_phone" class="form-control">
                                    </div>
                                    
                                    <!-- Pays -->
                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                        <label for="country" class="form-label">Pays :</label>
                                        <select class="form-select rounded-5 pays" id="country" name="s_country"></select>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <!-- Nom de l'entreprise -->
                                    <div class="col-md-6 mb-3">
                                        <label for="nom_entreprise" class="form-label">Nom de l'entreprise :</label>
                                        <input type="text" class="form-control" id="nom_entreprise" name="s_nom_entreprise" placeholder="Nom de l'entreprise">
                                    </div>
                                    
                                    <!-- Type de produit -->
                                    <div class="col-md-6 mb-3">
                                        <label for="produit" class="form-label">Type de produit :</label>
                                        <input type="text" class="form-control" id="produit" name="s_produit" placeholder="Type de produit vendu">
                                    </div>
                                </div>

                                <!-- Adresse de l'entreprise -->
                                <div class="mb-3">
                                    <label for="adresse_entreprise" class="form-label">Adresse de l'entreprise :</label>
                                    <input type="text" class="form-control" id="adresse_entreprise" name="s_adresse_entreprise" placeholder="Adresse de l'entreprise">
                                </div>

                                <!-- Mot de passe -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="password" class="form-label">Mot de passe :</label>
                                        <input type="password" class="form-control" id="password" name="s_password" placeholder="Mot de passe">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="password_confirm" class="form-label">Confirmer le mot de passe :</label>
                                        <input type="password" class="form-control" id="password_confirm" name="s_password_confirm" placeholder="Confirmez le mot de passe">
                                    </div>
                                </div>
                            </fieldset>
                            <br>

                            <!-- Bouton de soumission -->
                            <button class="btn btn-primary col-12" type="submit" name="valider"><i class="fas fa-user-plus me-2"></i>S'inscrire</button><br>
                            <br>

                            <span>Vous avez déjà un compte?  <a href="../index.php" class="link_login">Cliquez ici pour vous connecter</a></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charge la bibliothèque JavaScript Bootstrap 5.3.3, incluant les composants et les plugins Bootstrap (comme les modals, carousels, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Charge la bibliothèque intl-tel-input version 17.0.8 pour ajouter des fonctionnalités avancées à l'entrée de numéro de téléphone -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    
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
