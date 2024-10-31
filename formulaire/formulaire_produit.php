<?php
    // Activer l'affichage des erreurs pour le developpement
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start(); // Initialiser la session
    session_regenerate_id(true); // Regenere l'id de session pour plus de securité

    // Recuperer le message des champs stocké dans la session (si disponible)
    $message_produit_input = htmlspecialchars($_SESSION['message_produit_input'] ?? '', ENT_QUOTES, 'UTF-8');

    // Recuperer le message de succes stocké dans la session (si disponible)
    $message_produit_success = htmlspecialchars($_SESSION['message_produit_success'] ?? '', ENT_QUOTES, 'UTF-8');

    // Recuperer le message d'echec stocké dans la session (si disponible)
    $message_produit_fail = htmlspecialchars($_SESSION['message_produit_fail'] ?? '', ENT_QUOTES, 'UTF-8');


    // Supprimer le message des champs apres l'avoir affiché pour eviter qu'il persiste
    unset($_SESSION['message_produit_input']);

    // Supprimer le message de succes apres l'avoir affiché pour eviter qu'il persiste
    unset($_SESSION['message_produit_success']);

    // Supprimer le message d'echec apres l'avoir affiché pour eviter qu'il persiste
    unset($_SESSION['message_produit_fail']);


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

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Formulaire des produits</title>

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
        <h1 class="ajout text-center mb-4">Ajouter un produit</h1>

        <!-- Affichage du message des champs -->
        <?php if($message_produit_input != ""): ?>
            <div class="alert alert-warning" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $message_produit_input; ?>
            </div>
        <?php endif; ?>

        <!-- Affichage du message de succès -->
        <?php if($message_produit_success != ""): ?>
            <div class="alert alert-success" role="alert">
                <i class="fas fa-check-circle"></i> <?php echo $message_produit_success; ?>
                <a href="../dashbord/produit.php" class="btn btn-primary">Consulter</a>
            </div>
        <?php endif; ?>

        <!-- Affichage du message d'echec -->
        <?php if($message_produit_fail != ""): ?>
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $message_produit_fail; ?>
            </div>
        <?php endif; ?>


        <form action="../validation/valider_transaction.php" method="post">
            <fieldset class="border p-4 rounded">
                <legend class="w-auto">Produit</legend>
                
                <div class="mb-3">
                    <label for="nomProduit" class="form-label">Nom du Produit :</label>
                    <input type="text" id="nomProduit" name="s_nomproduit" class="form-control">
                </div>
                
                <div class="mb-3">
                    <label for="descriptionProduit" class="form-label">Description du Produit :</label>
                    <input type="text" id="descriptionProduit" name="s_descriptionproduit" class="form-control">
                </div>
                
                <div class="mb-3 row">
                    <div class="col">
                        <label for="prixVente" class="form-label">Prix de vente :</label>
                        <input type="text" id="prixVente" name="s_prixvente" class="form-control">
                    </div>
                    <div class="col">
                        <label for="devisePrixVente" class="form-label">Devise :</label>
                        <select id="devisePrixVente" name="s_deviseprixvente" class="form-select">
                            <option value="">Selectionner la monnaie...</option>
                            <option value="CFA">CFA</option>
                            <option value="EUR">Euro</option>
                            <option value="USD">Dollar</option>
                            <!-- Ajouter d'autres devises si nécessaire -->
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col">
                        <label for="coutUnit" class="form-label">Coût unitaire :</label>
                        <input type="text" id="coutUnit" name="s_coutunit" class="form-control">
                    </div>
                    <div class="col">
                        <label for="deviseCoutUnit" class="form-label">Devise :</label>
                        <select id="deviseCoutUnit" name="s_devisecoutunit" class="form-select">
                            <option value="">Selectionner la monnaie...</option>
                            <option value="CFA">CFA</option>
                            <option value="EUR">Euro</option>
                            <option value="USD">Dollar</option>
                            <!-- Ajouter d'autres devises si nécessaire -->
                        </select>
                    </div>
                </div>
            </fieldset>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" name="submit_form_produit" class="btn btn-primary">Ajouter</button>
                <button type="reset" class="btn btn-secondary">Annuler</button>
            </div>
        </form>
    </section>

    <?php
        include("../footer/pied_de_page.php");
    ?>

    <!-- Bootstrap JS and dependencies -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->

    <!-- Bootstrap JS and dependencies -->
    <script>
        const devisePrixVente = document.getElementById('devisePrixVente');
        const deviseCoutUnit = document.getElementById('deviseCoutUnit');

        // Fonction pour synchroniser les devises
        function syncDevises(event) {
            if (event.target.id === 'devisePrixVente') {
                deviseCoutUnit.value = event.target.value;
            } else if (event.target.id === 'deviseCoutUnit') {
                devisePrixVente.value = event.target.value;
            }
        }

        // Ajout des écouteurs d'événements pour les deux sélecteurs
        devisePrixVente.addEventListener('change', syncDevises);
        deviseCoutUnit.addEventListener('change', syncDevises);
    </script>
</body>
</html>