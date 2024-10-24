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
        <form method="post" action="../validation/change_password.php">
            <fieldset class="border p-4 rounded">
                <div class="mb-3">
                    <label for="currentPassword" class="form-label">Mot de passe actuel</label>
                    <input type="password" class="form-control" id="currentPassword" name="s_current_password" required>
                </div>
                <div class="mb-3">
                    <label for="newPassword" class="form-label">Nouveau mot de passe</label>
                    <input type="password" class="form-control" id="newPassword" name="s_new_password" required>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirmer le nouveau mot de passe</label>
                    <input type="password" class="form-control" id="confirmPassword" name="s_confirm_password" required>
                </div>
            </fieldset>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn btn-primary">Ajouter</button>
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