<?php
    // Activer l'affichage des erreurs pour le developpement
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start(); // Initialiser la session
    session_regenerate_id(true); // Regenere l'id de session pour plus de securité

    // Récupere le message des champs stocké dans la session (si disponible)
    $message_input = htmlspecialchars($_SESSION['message_input'] ?? '', ENT_QUOTES, 'UTF-8');

    //Recupere le message d'email stocké dans la session (si disponible)
    $message_email = htmlspecialchars($_SESSION['message_email'] ?? '', ENT_QUOTES, 'UTF-8');

    // Récupere le message de mot de passe stocké dans la session (si disponible)
    $message_password = htmlspecialchars($_SESSION['message_password'] ?? '', ENT_QUOTES, 'UTF-8');

    // Récupere le message d'utilisateur stocké dans la session (si disponible)
    $message_entreprise = htmlspecialchars($_SESSION['message_entreprise'] ?? '', ENT_QUOTES, 'UTF-8');

    // Récupere le message d'inscription stocké dans la session (si disponible)
    $message_register = htmlspecialchars($_SESSION['message_register'] ?? '', ENT_QUOTES, 'UTF-8');


    // Supprime le message des champs après l'avoir affiché pour éviter qu'il persiste
    unset($_SESSION['message_input']);

    //Supprime le message d'email après l'avoir affiché pour eviter qu'il persiste
    unset($_SESSION['message_email']);

    // Supprime le message de mot de passe après l'avoir affiché pour éviter qu'il persiste
    unset($_SESSION['message_password']);

    // Supprime le message d'utilisateur après l'avoir affiché pour éviter qu'il persiste
    unset($_SESSION['message_entreprise']);

    // Supprime le message d'inscription après l'avoir affiché pour éviter qu'il persiste
    unset($_SESSION['message_register']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Charge la feuille de style Bootstrap 5.3.3 pour styliser la page avec le framework CSS de Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Charge la bibliothèque de styles Font Awesome version 6.0.0 pour afficher des icônes vectorielles (comme des utilisateurs, des flèches, etc.) -->
    <link href="../fontawesome/css/all.min.css" rel="stylesheet">

    <title>Inscription</title>

    <style>
        /* Styles personnalisés pour les sections de la page */
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
                            
                            <!-- Affichage du message des champs -->
                            <?php if($message_input != ""): ?>
                                <div class="alert alert-warning" role="alert">
                                    <i class="fas fa-exclamation-triangle"></i> <?php echo $message_input; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Affichage du message d'email -->
                            <?php if($message_email != ""): ?>
                                <div class="alert alert-warning" role="alert">
                                    <i class="fas fa-exclamation-triangle"></i> <?php echo $message_email; ?>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Affichage du message de mot de passe -->
                            <?php if($message_password != ""): ?>
                                <div class="alert alert-danger" role="alert">
                                    <i class="fas fa-exclamation-triangle"></i> <?php echo $message_password; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Affichage du message d'utilisateur -->
                            <?php if($message_entreprise != ""): ?>
                                <div class="alert alert-info" role="alert">
                                    <i class="fas fa-exclamation-circle"></i> <?php echo $message_entreprise;?>
                                </div>
                            <?php endif; ?>

                            <!-- Affichage du message d'inscription -->
                            <?php if($message_register != ""): ?>
                                <div class="alert alert-success" role="alert">
                                    <i class="fas fa-check-circle"></i> <?php echo $message_register; ?>
                                </div>
                                <!-- Utilisation du javascript pour la redirection -->
                                <script>
                                    setTimeout(function() {
                                        window.location.href = "../index.php"; // redirige vers la page de connexion
                                    }, 3000); // délai de 3 secondes
                                </script>
                            <?php endif; ?>

                            <fieldset>
                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email_business" class="form-label">Email de l'entreprise :</label>
                                    <input type="" class="form-control" id="email_business" name="s_email_business" placeholder="Email de l'entreprise">
                                </div>

                                <!-- Nom de l'entreprise -->
                                <div class="mb-3">
                                    <label for="nom_entreprise" class="form-label">Nom de l'entreprise :</label>
                                    <input type="text" class="form-control" id="nom_entreprise" name="s_nom_entreprise" placeholder="Nom de l'entreprise">
                                </div>

                                <!-- Nom d'utilisateur -->
                                <div class="mb-3">
                                    <label for="nom_user" class="form-label">Nom d'utilisateur :</label>
                                    <input type="text" class="form-control" id="nom_user" name="s_nom_utilisateur" placeholder="Votre nom d'utilisateur">
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

</body>

</html>
