<?php
    // Activer l'affichage des erreurs pour le developpement
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start(); // Initialiser la session
    session_regenerate_id(true); // Regenere l'id de session pour plus de securité

    
    // Récupere le message des champs stocké dans la session (si disponible)
    $message_input = htmlspecialchars($_SESSION['message_input'] ?? '', ENT_QUOTES, 'UTF-8');

    // Récupere le message de connexion invalide stocké dans la session (si disponible)
    $message_login = htmlspecialchars($_SESSION['message_login'] ?? '', ENT_QUOTES, 'UTF-8');

    // Récupere le message de connexion reussie stocké dans la session (si disponible)
    $message_success = htmlspecialchars($_SESSION['message_success'] ?? '', ENT_QUOTES, 'UTF-8');


    // Supprime le message des champs après l'avoir affiché pour éviter qu'il persiste
    unset($_SESSION['message_input']);

    // Supprime le message de connexion invalide après l'avoir affiché pour éviter qu'il persiste
    unset($_SESSION['message_login']);

    // Supprime le message de connexion reussie après l'avoir affiché pour éviter qu'il persiste
    unset($_SESSION['message_success']);

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

    <title>Connexion</title>

    <style>
        /* Styles personnalisés pour les sections de la page */
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
        .btn-danger {
            background-color: #dc3545;
            border: none;
            border-radius: 50px;
            transition: background-color 0.3s ease-in-out;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .form-control {
            border-radius: 50px;
            padding: 15px;
        }
        .form-label {
            font-weight: bold;
        }
        .text-danger {
            font-size: 2rem;
            font-weight: bold;
        }
    </style>

</head>

<body>
    <div class="container d-lg-flex d-md-block d-sm-block mt-5 my-md-4 py-lg-5 py-md-0 my-sm-4 justify-content-center">
        <div class="card shadow-lg p-3 mb-5 bg-body-tertiary rounded">
            <div class="row g-0">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <img class="img-fluid rounded h-100" src="image/connect.jpg" alt="Image de connexion">
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 d-flex align-items-center">
                    <div class="card-body p-5">
                        <h2 class="text-danger text-center mb-4"><i class="fas fa-sign-in-alt me-2"></i>Connectez-vous</h2>
                        <form action="validation/valider_connexion.php" method="post"> 

                            <!-- Affichage du message des champs -->
                            <?php if($message_input != ""): ?>
                                <div class="alert alert-warning" role="alert">
                                    <i class="fas fa-exclamation-triangle"></i> <?php echo $message_input; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Affichage du message de paramètre invalide -->
                            <?php if($message_login != ""): ?>
                                <div class="alert alert-danger" role="alert">
                                    <i class="fas fa-exclamation-triangle"></i> <?php echo $message_login; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Affichage du message de succès -->
                            <?php if($message_success != ""): ?>
                                <div class="alert alert-success" role="alert">
                                    <i class="fas fa-check-circle"></i> <?php echo $message_success; ?>
                                </div>

                                <!-- Utilisation de javascript pour la redirection -->
                                <script>
                                    setTimeout(function() {
                                        window.location.href = "dashbord/home.php"; // redirige vers la page d'accueil
                                    }, 3000); // délai de 3 secondes
                                </script>
                            <?php endif; ?>
                            
                            <fieldset>
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom de l'entreprise:</label>
                                    <input class="form-control" type="text" name="s_name" id="nom" placeholder="Entrez le nom">
                                </div>

                                <div class="mb-4">
                                    <label for="motdepasse" class="form-label">Mot de passe:</label>
                                    <input class="form-control" type="password" name="s_motdepasse" id="motdepasse" placeholder="Entrez votre mot de passe">
                                </div>
                            </fieldset>
                            
                            <button class="btn btn-danger col-12" type="submit" name="valider"><i class="fas fa-lock me-2"></i>Se connecter</button><br>
                            <br>
                            <p class="m-auto">Vous n'avez pas de compte?<a href="dashbord/inscription.php">Inscrivez-vous ici</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charge la bibliothèque JavaScript Bootstrap 5.3.3, incluant les composants et les plugins Bootstrap (comme les modals, carousels, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>