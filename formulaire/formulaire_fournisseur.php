<?php
    // Activer l'affichage des erreurs pour le developpement
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include("../session_start_verify.php"); // Fichier pour verifier la connexion_user avec la session

    // Recuperer le message des champs stocké dans la session (si disponible)
    $message_fournisseur_input = htmlspecialchars($_SESSION['message_fournisseur_input'] ?? '', ENT_QUOTES, 'UTF-8');

    // Recuperer le message de succes stocké dans la session (si disponible)
    $message_fournisseur_success = htmlspecialchars($_SESSION['message_fournisseur_success'] ?? '', ENT_QUOTES, 'UTF-8');

    // Recuperer le message d'echec stocké dans la session (si disponible)
    $message_fournisseur_fail = htmlspecialchars($_SESSION['message_fournisseur_fail'] ?? '', ENT_QUOTES, 'UTF-8');


    // Supprimer le message des champs apres l'avoir affiché pour eviter qu'il persiste
    unset($_SESSION['message_fournisseur_input']);

    // Supprimer le message de succes apres l'avoir affiché pour eviter qu'il persiste
    unset($_SESSION['message_fournisseur_success']);

    // Supprimer le message d'echec apres l'avoir affiché pour eviter qu'il persiste
    unset($_SESSION['message_fournisseur_fail']);
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

        <!-- Affichage du message des champs -->
        <?php if($message_fournisseur_input != ""): ?>
            <div class="alert alert-warning" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $message_fournisseur_input; ?>
            </div>
        <?php endif; ?>

        <!-- Affichage du message de succès -->
        <?php if($message_fournisseur_success != ""): ?>
            <div class="alert alert-success" role="alert">
                <i class="fas fa-check-circle"></i> <?php echo $message_fournisseur_success; ?>
                <a href="../dashbord/fournisseur.php" class="btn btn-primary">Consulter</a>
            </div>
        <?php endif; ?>

        <!-- Affichage du message d'echec -->
        <?php if($message_fournisseur_fail != ""): ?>
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $message_fournisseur_fail; ?>
            </div>
        <?php endif; ?>


        <form action="../validation/valider_transaction.php" method="post">
            <fieldset class="border p-4 rounded">
                <legend class="w-auto">Fournisseur</legend>
                
                <div class="mb-3">
                    <label for="nomFournisseur" class="form-label">Nom du fournisseur :</label>
                    <input type="text" id="nomFournisseur" name="s_nomfournisseur" class="form-control" autocomplete="off">
                </div>
                
                <div class="mb-3">
                    <label for="adresseFournisseur" class="form-label">Adresse du fournisseur :</label>
                    <input type="text" id="adresseFournisseur" name="s_adressefournisseur" class="form-control" autocomplete="off">
                </div>
                
                <div class="mb-3">
                    <label for="coordonneesFournisseur" class="form-label">Coordonnées du fournisseur :</label>
                    <input type="tel" id="coordonneesFournisseur" name="s_coordonneesfournisseur" class="form-control" pattern="[0-9+().-]*" placeholder="Ex: +229 57 57 57 57" autocomplete="off">
                </div>
                
            </fieldset>

            <div class="d-flex justify-content-between mt-4 mb-4">
                <button type="submit" name="submit_form_fournisseur" class="btn btn-primary">Ajouter</button>
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