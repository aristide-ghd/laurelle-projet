<?php
    // Activer l'affichage des erreurs pour le developpement
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start(); // Initialiser la session
    session_regenerate_id(true); // Regenere l'id de session pour plus de securité

    // Recuperer le message des champs stocké dans la session (si disponible)
    $message_depense_input = htmlspecialchars($_SESSION['message_depense_input'] ?? '', ENT_QUOTES, 'UTF-8');

    // Recuperer le message de succes stocké dans la session (si disponible)
    $message_depense_success = htmlspecialchars($_SESSION['message_depense_success'] ?? '', ENT_QUOTES, 'UTF-8');

    // Recuperer le message d'echec stocké dans la session (si disponible)
    $message_depense_fail = htmlspecialchars($_SESSION['message_depense_fail'] ?? '', ENT_QUOTES, 'UTF-8');


    // Supprimer le message des champs apres l'avoir affiché pour eviter qu'il persiste
    unset($_SESSION['message_depense_input']);

    // Supprimer le message de succes apres l'avoir affiché pour eviter qu'il persiste
    unset($_SESSION['message_depense_success']);

    // Supprimer le message d'echec apres l'avoir affiché pour eviter qu'il persiste
    unset($_SESSION['message_depense_fail']);

    
    // Vérification si l'utilisateur est connecté
    if(!isset($_SESSION['logged_in'])) {
        // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
        header("Location: ../index.php");
        exit;
    }

    include("../connexion.php"); // Connexion a la base de donnée

    // Vérification de la connexion à la base de données
    if (!$bdd) {
        die("Erreur de connexion à la base de données");
    }

    // Préparer les requêtes pour éviter l'injection SQL
    $req = $bdd -> prepare("SELECT * FROM modepaiement ORDER BY idModePaiement");
    $req -> execute();
    $modes_paiement = $req -> fetchAll();

    if (!$modes_paiement)
    {
        // Affichage d'un message si aucune information n'est trouvée
        echo "Erreur lors de la recuperation des données. Veuillew reessayer plus tard !";
        exit();
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Formulaire des dépenses</title>

    <style>
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
        <h1 class="ajout text-center mb-4">Ajouter une dépense</h1>

        <!-- Affichage du message des champs -->
        <?php if($message_depense_input != ""): ?>
            <div class="alert alert-warning" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $message_depense_input; ?>
            </div>
        <?php endif; ?>

        <!-- Affichage du message de succès -->
        <?php if($message_depense_success != ""): ?>
            <div class="alert alert-success" role="alert">
                <i class="fas fa-check-circle"></i> <?php echo $message_depense_success; ?>
                <a href="../dashbord/depense.php" class="btn btn-primary">Consulter</a>
            </div>
        <?php endif; ?>

        <!-- Affichage du message d'echec -->
        <?php if($message_depense_fail != ""): ?>
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $message_depense_fail; ?>
            </div>
        <?php endif; ?>


        <form action="../validation/valider_transaction.php" method="post">
            <fieldset class="border p-4 rounded">
                <legend class="w-auto">Dépense</legend>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="montantDepense" class="form-label">Montant de Dépense :</label>
                        <input type="text" id="montantDepense" name="s_montantdepense" class="form-control" >
                    </div>
                    <div class="col">
                        <label for="deviseMontantDepense" class="form-label">Devise :</label>
                        <select id="deviseMontantDepense" name="s_devisemontantdepense" class="form-select" >
                            <option value="">Selectionner la monnaie...</option>
                            <option value="CFA">CFA</option>
                            <option value="EUR">Euro</option>
                            <option value="USD">Dollar</option>
                            <!-- Ajouter d'autres devises si nécessaire -->
                        </select>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="dateDepense" class="form-label">Date de Dépense :</label>
                    <input type="date" id="dateDepense" name="s_datedepense" class="form-control" >
                </div>
                
                <div class="mb-3">
                    <label for="descriptionDepense" class="form-label">Description de Dépense :</label>
                    <input type="text" id="descriptionDepense" name="s_descriptiondepense" class="form-control" >
                </div>
                
                <div class="mb-3">
                    <label for="modePaiement" class="form-label">Mode de Paiement :</label>
                    <select name="s_modepaiement" id="modePaiement" class="form-select" >
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
                <button type="submit" name="submit_form_depense" class="btn btn-primary">Ajouter</button>
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