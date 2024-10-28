<?php
    // Activer l'affichage des erreurs
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start(); // Initialiser la session

    // Recuperation du message des champs stocké dans la session (si disponible)
    $message_keyword_input = isset($_SESSION['message_keyword_input']) ? $_SESSION['message_keyword_input'] : '';

    // Recuperation du message du mot de passe actuel stocké dans la session (si disponible)
    $message_keyword_current = isset($_SESSION['message_keyword_current']) ? $_SESSION['message_keyword_current'] : '';

    // Recuperation du message de mots de passe non identiques stocké dans la session (si disponible)
    $message_keyword_same = isset($_SESSION['message_keyword_same']) ? $_SESSION['message_keyword_same'] : '';

    // Recuperation du message de mot de passe enregistré avec succès stocké dans la session (si disponible)
    $message_keyword_success = isset($_SESSION['message_keyword_success']) ? $_SESSION['message_keyword_success'] : '';

    // Recuperation du message d'echec de modification stocké dans la session (si disponible)
    $message_keyword_fail = isset($_SESSION['message_keyword_fail']) ? $_SESSION['message_keyword_fail'] : '';


    // Supprime le message des champs apres l'avoir affiché pour eviter qu'il persiste 
    unset($_SESSION['message_keyword_input']);

    // Supprime le message du mot de passe actuel apres l'avoir affiché pour eviter qu'il persiste 
     unset($_SESSION['message_keyword_current']);

    // Supprime le message de mots de passe non identiques apres l'avoir affiché pour eviter qu'il persiste 
    unset($_SESSION['message_keyword_same']);

    // Supprime le message de mot de passe enregistré avec succès apres l'avoir affiché pour eviter qu'il persiste 
     unset($_SESSION['message_keyword_success']);

    // Supprime le message d'echec de modification apres l'avoir affiché pour eviter qu'il persiste 
    unset($_SESSION['message_keyword_fail']);


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
    <title>Paramètres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .footer {
            /* margin-top: 4%; */
            width: 100%;
        }
    </style>
    
    <?php include '../mode.php'; ?>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../navbar/en_tete.php'; ?>

    <section class="container my-5 pt-5 flex-grow-1">
        <h2 class="mb-2 mt-5">Modification du mot de passe</h2>

        <!-- Affichage du message des champs -->
        <?php if($message_keyword_input != ""): ?>
            <div class="alert alert-warning" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $message_keyword_input; ?>
            </div>
        <?php endif; ?>

        <!-- Affichage du message de mot de passe actuel -->
        <?php if($message_keyword_current != ""): ?>
            <div class="alert alert-secondary" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $message_keyword_current; ?>
            </div>
        <?php endif; ?>

        <!-- Affichage du message de mots de passe non identiques -->
        <?php if($message_keyword_same != ""): ?>
            <div class="alert alert-primary" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $message_keyword_same; ?>
            </div>
        <?php endif; ?>

        <!-- Affichage du message de mots de passe enregistré avec succès -->
        <?php if($message_keyword_success != ""): ?>
            <div class="alert alert-success" role="alert">
                <i class="fas fa-check-circle"></i> <?php echo $message_keyword_success; ?>
            </div>
        <?php endif; ?>

        <!-- Affichage du message d'echec de modification -->
        <?php if($message_keyword_fail != ""): ?>
            <div class="alert alert-info" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $message_keyword_fail; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="../validation/change_password.php">
            <fieldset class="border p-4 rounded">
                <div class="mb-3">
                    <label for="currentPassword" class="form-label">Mot de passe actuel</label>
                    <input type="password" class="form-control" id="currentPassword" name="s_current_password">
                </div>
                <div class="mb-3">
                    <label for="newPassword" class="form-label">Nouveau mot de passe</label>
                    <input type="password" class="form-control" id="newPassword" name="s_new_password">
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirmer le nouveau mot de passe</label>
                    <input type="password" class="form-control" id="confirmPassword" name="s_confirm_password">
                </div>
            </fieldset>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" name="submit_keyword" class="btn btn-primary">Ajouter</button>
                <button type="reset" class="btn btn-secondary">Annuler</button>
            </div>
        </form>
    </section>

    <button id="toggleTheme" class="btn btn-secondary mt-3">Activer le mode sombre</button>

    <!--Utilisation du JavaScript pour appliquer et mémoriser le mode sélectionné via le localStorage.-->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const currentTheme = localStorage.getItem('theme') || 'light';
            const toggleThemeBtn = document.getElementById('toggleTheme');

            if (currentTheme === 'dark') {
                toggleThemeBtn.textContent = 'Activer le mode clair';
            }

            toggleThemeBtn.addEventListener('click', () => {
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                localStorage.setItem('theme', newTheme);
                toggleThemeBtn.textContent = newTheme === 'dark' ? 'Activer le mode clair' : 'Activer le mode sombre';
                document.body.classList.toggle('bg-dark');
                document.body.classList.toggle('text-white');
            });
        });
    </script>


    <?php
        include("../footer/pied_de_page.php");
    ?>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
</body>
</html>