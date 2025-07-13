<?php
    // Activer l'affichage des erreurs pour le developpement
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include("../session_start_verify.php"); // Fichier pour verifier la connexion_user avec la session

    // Recuperation du message des champs stocké dans la session (si disponible)
    $message_keyword_input = htmlspecialchars($_SESSION['message_keyword_input'] ?? '', ENT_QUOTES, 'UTF-8');

    // Recuperation du message du mot de passe actuel stocké dans la session (si disponible)
    $message_keyword_current = htmlspecialchars($_SESSION['message_keyword_current'] ?? '', ENT_QUOTES, 'UTF-8');

    // Recuperation du message de mots de passe non identiques stocké dans la session (si disponible)
    $message_keyword_same = htmlspecialchars($_SESSION['message_keyword_same'] ?? '', ENT_QUOTES, 'UTF-8');

    // Recuperation du message de mot de passe enregistré avec succès stocké dans la session (si disponible)
    $message_keyword_success = htmlspecialchars($_SESSION['message_keyword_success'] ?? '', ENT_QUOTES, 'UTF-8');

    // Recuperation du message d'echec de modification stocké dans la session (si disponible)
    $message_keyword_fail = htmlspecialchars($_SESSION['message_keyword_fail'] ?? '', ENT_QUOTES, 'UTF-8');


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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Paramètres</title>

    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .footer {
            /* margin-top: 4%; */
            width: 100%;
        }
    </style>
    
    <?php include '../mode.php'; // Fichier pour activer le mode sombre et le mode clair ?>

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