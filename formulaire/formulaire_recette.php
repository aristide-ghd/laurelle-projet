<?php
    // Activer l'affichage des erreurs pour le developpement
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include("../session_start_verify.php"); // Fichier pour verifier la connexion_user avec la session

    // Recuperer le message des champs stocké dans la session (si disponible)
    $message_recette_input = htmlspecialchars($_SESSION['message_recette_input'] ?? '', ENT_QUOTES, 'UTF-8');

    // Recuperer le message de succes stocké dans la session (si disponible)
    $message_recette_success = htmlspecialchars($_SESSION['message_recette_success'] ?? '', ENT_QUOTES, 'UTF-8');

    // Recuperer le message d'echec stocké dans la session (si disponible)
    $message_recette_fail = htmlspecialchars($_SESSION['message_recette_fail'] ?? '', ENT_QUOTES, 'UTF-8');


    // Supprimer le message des champs apres l'avoir affiché pour eviter qu'il persiste
    unset($_SESSION['message_recette_input']);

    // Supprimer le message de succes apres l'avoir affiché pour eviter qu'il persiste
    unset($_SESSION['message_recette_success']);

    // Supprimer le message d'echec apres l'avoir affiché pour eviter qu'il persiste
    unset($_SESSION['message_recette_fail']);


    include("../connexion.php"); // Connexion a la base de donnée

    include("../db_connected_verify.php"); // Vérification de la connexion à la base de données

    // Préparer les requêtes pour éviter l'injection SQL
    $req = $bdd -> prepare("SELECT * FROM modepaiement ORDER BY idModePaiement");
    $req -> execute();
    $modes_paiement = $req -> fetchAll();

    if (!$modes_paiement)
    {
        // Affichage d'un message si aucune information n'est trouvée
        echo "Erreur lors de la recuperation des données. Veuillez reessayer plus tard !";
        exit();
    }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Formulaire des recettes</title>

    <style>
        .ajout{
            margin-top: 60px;
            color: #198754;
        }
    </style>

    <?php include '../mode.php'; // Fichier pour activer le mode sombre et le mode clair ?>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../navbar/en_tete.php'; ?>
    
    <section class="container my-5 flex-grow-1">
        <h1 class="ajout text-center mb-4">Ajouter une recette</h1>

        <!-- Affichage du message des champs -->
        <?php if($message_recette_input != ""): ?>
            <div class="alert alert-warning" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $message_recette_input; ?>
            </div>
        <?php endif; ?>

        <!-- Affichage du message de succès -->
        <?php if($message_recette_success != ""): ?>
            <div class="alert alert-success" role="alert">
                <i class="fas fa-check-circle"></i> <?php echo $message_recette_success; ?>
                <a href="../dashbord/recette.php" class="btn btn-primary">Consulter</a>
            </div>
        <?php endif; ?>

        <!-- Affichage du message d'echec -->
        <?php if($message_recette_fail != ""): ?>
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $message_recette_fail; ?>
            </div>
        <?php endif; ?>


        <form action="../validation/valider_transaction.php" method="post">
            <fieldset class="border p-4 rounded">
                <legend class="w-auto">Recette</legend>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="montantRecette" class="form-label">Montant de Recette :</label>
                        <input type="text" id="montantRecette" name="s_montantrecette" class="form-control">
                    </div>
                    <div class="col">
                        <label for="deviseMontantRecette" class="form-label">Devise :</label>
                        <select id="deviseMontantRecette" name="s_devisemontantrecette" class="form-select">
                            <option value="">Selectionner la monnaie...</option>
                            <option value="CFA">CFA</option>
                            <option value="EUR">Euro</option>
                            <option value="USD">Dollar</option>
                            <!-- Ajouter d'autres devises si nécessaire -->
                        </select>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="dateRecette" class="form-label">Date de Recette :</label>
                    <input type="date" id="dateRecette" name="s_daterecette" class="form-control">
                </div>
                
                <div class="mb-3">
                    <label for="descriptionRecette" class="form-label">Description de Recette :</label>
                    <input type="text" id="descriptionRecette" name="s_descriptionrecette" class="form-control">
                </div>
                
                <div class="mb-3">
                    <label for="listmode" class="form-label">Mode de Paiement :</label>
                    <select name="s_modepaiement" id="listmode" class="form-select">
                        <option value="">Selectionner le mode de paiement...</option>
                        <?php foreach ($modes_paiement as $listemode): ?>
                        <option value="<?= $listemode['idModePaiement'] ?>">
                            <?= $listemode['NomModePaiement'] ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
            </fieldset>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" name="submit_form_recette" class="btn btn-primary">Ajouter</button>
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