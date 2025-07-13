<?php
    // Activer l'affichage des erreurs pour le developpement
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include("../includes/session_start_verify.php"); // Fichier pour verifier la connexion_user avec la session

    // Recuperer le message des champs stocké dans la session (si disponible)
    $message_mdp_input = htmlspecialchars($_SESSION['message_mdp_input'] ?? '', ENT_QUOTES, 'UTF-8');

    // Recuperer le message de succes stocké dans la session (si disponible)
    $message_mdp_success = htmlspecialchars($_SESSION['message_mdp_success'] ?? '', ENT_QUOTES, 'UTF-8');

    // Recuperer le message d'echec stocké dans la session (si disponible)
    $message_mdp_fail = htmlspecialchars($_SESSION['message_mdp_fail'] ?? '', ENT_QUOTES, 'UTF-8');


    // Supprimer le message des champs apres l'avoir affiché pour eviter qu'il persiste
    unset($_SESSION['message_mdp_input']);

    // Supprimer le message de succes apres l'avoir affiché pour eviter qu'il persiste
    unset($_SESSION['message_mdp_success']);

    // Supprimer le message d'echec apres l'avoir affiché pour eviter qu'il persiste
    unset($_SESSION['message_mdp_fail']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title>Formulaire du Mode de Paiement</title>

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

    <?php include '../includes/mode.php'; ?>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../includes/en_tete.php';; ?>
    
    <section class="container mt-5 flex-grow-1">
        <h1 class="ajout text-center mb-4">Ajouter un Mode de Paiement</h1>

        <!-- Affichage du message des champs -->
        <?php if($message_mdp_input != ""): ?>
            <div class="alert alert-warning" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $message_mdp_input; ?>
            </div>
        <?php endif; ?>

        <!-- Affichage du message de succès -->
        <?php if($message_mdp_success != ""): ?>
            <div class="alert alert-success" role="alert">
                <i class="fas fa-check-circle"></i> <?php echo $message_mdp_success; ?>
                <a href="../dashbord/mdp.php" class="btn btn-primary">Consulter</a>
            </div>
        <?php endif; ?>

        <!-- Affichage du message d'echec -->
        <?php if($message_mdp_fail != ""): ?>
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $message_mdp_fail; ?>
            </div>
        <?php endif; ?>


        <form action="../validation/valider_transaction.php" method="post">
            <fieldset class="border p-4 rounded">
                <legend class="w-auto">Mode de Paiement</legend>
                
                <div class="mb-3">
                    <label for="nomModePaiement" class="form-label">Nom Mode de Paiement :</label>
                    <input type="text" id="nomModePaiement" name="s_nom_modepaiement" class="form-control nom_mode">
                </div>
            </fieldset>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" name="submit_form_mdp" class="btn btn-primary">Ajouter</button>
                <button type="reset" class="btn btn-secondary">Annuler</button>
            </div>
        </form>
    </section>

    <?php
        include("../footer/pied_de_page.php");
    ?>

    <!-- Bootstrap JS (optional, for interactive components) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>