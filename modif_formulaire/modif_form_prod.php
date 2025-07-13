<?php
    // Activer l'affichage des erreurs
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    include("../session_start_verify.php"); // Fichier pour verifier la connexion_user avec la session

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


    include("../sign_in.php"); // Connexion a la base de donnée

    include("../db_connected_verify.php"); // Vérification de la connexion à la base de données

    $matprod = $_GET['id']; // Recuperation de l'id du produit a modifier

    // Preparer les requetes pour eviter l'injection SQL
    $req = "SELECT * FROM produits WHERE idProduit = :idProduit";
    $stmt = $bdd -> prepare($req);
    $stmt -> execute(['idProduit' => $matprod]);
    $update_produits = $stmt -> fetchAll();

    if (!$update_produits)
    {
        // Affichage d'un message si aucune information n'est trouvée
        echo "Erreur lors de la recuperation des données. Veuillez reessayer plus tard !";
        exit();
    }

    // Séparer le prix de vente et la devise
    foreach ($update_produits as $liste) {
        $prixVenteDetails = explode(' ', $liste['PrixVente']);
        $liste['Prix'] = $prixVenteDetails[0]; // Le prix sans la devise
        $liste['DevisePrixVente'] = $prixVenteDetails[1]; // La devise
        $coutUnitDetails = explode(' ', $liste['CoutUnitaire']);
        $liste['Cout'] = $coutUnitDetails[0]; // Le coût unitaire sans la devise
        $liste['DeviseCoutUnit'] = $coutUnitDetails[1]; // La devise
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <title>Modification des produits</title>

    <style>
        .ajout{
            margin-top: 60px;
            color: #0d6efd;
        }
    </style>

    <?php include '../mode.php'; // Fichier pour activer le mode sombre et le mode clair ?>

</head>

<body class="d-flex flex-column min-vh-100">
    <?php include '../navbar/en_tete.php'; ?>

    <section class="container my-5 flex-grow-1">
        <h1 class="ajout text-center mb-4">Modification d'un produit</h1>

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
            </div>

            <!-- Utilisation de javascript pour la redirection -->
            <script>
                setTimeout(function() {
                    window.location.href = "../dashbord/produit.php"; // redirige vers la page des produits
                }, 3000); // délai de 3 secondes
            </script>
        <?php endif; ?>

        <!-- Affichage du message d'echec -->
        <?php if($message_produit_fail != ""): ?>
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $message_produit_fail; ?>
            </div>
        <?php endif; ?>


        <form action="../validation/valider_modif_form.php" method="post">
            <fieldset class="border p-4 rounded">
                <legend class="fw-bold">Produit</legend>

                    <div class="mb-3">
                        <label for="s_numero" class="form-label">Matricule Produit :</label>
                        <input type="text" id="s_numero" name="s_numero" class="form-control" value="<?= $liste['idProduit'] ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="s_nomproduit" class="form-label">Nom du Produit :</label>
                        <input type="text" id="s_nomproduit" name="s_nomproduit" class="form-control" value="<?= $liste['NomProduit'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="s_descriptionproduit" class="form-label">Description du Produit :</label>
                        <input type="text" id="s_descriptionproduit" name="s_descriptionproduit" class="form-control" value="<?= $liste['DescriptionProduit'] ?>">
                    </div>

                    <div class="mb-3 row">
                        <div class="col">
                            <label for="s_prixvente" class="form-label">Prix de vente :</label>
                            <input type="text" id="s_prixvente" name="s_prixvente" class="form-control" value="<?= $liste['Prix'] ?>">
                        </div>

                        <div class="col">
                            <label for="s_deviseprixvente" class="form-label">Devise :</label>
                            <select id="s_deviseprixvente" name="s_deviseprixvente" class="form-select" onchange="synchronizeCurrencies(this)">
                                <option value="CFA" <?= $liste['DevisePrixVente'] == 'CFA' ? 'selected' : '' ?>>CFA</option>
                                <option value="EUR" <?= $liste['DevisePrixVente'] == 'EUR' ? 'selected' : '' ?>>Euro</option>
                                <option value="USD" <?= $liste['DevisePrixVente'] == 'USD' ? 'selected' : '' ?>>Dollar</option>
                                <!-- Ajoute d'autres devises si nécessaire -->
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col">
                            <label for="s_coutunit" class="form-label">Coût unitaire :</label>
                            <input type="text" id="s_coutunit" name="s_coutunit" class="form-control" value="<?= $liste['Cout'] ?>">
                        </div>
                        
                        <div class="col">
                            <label for="s_devisecoutunit" class="form-label">Devise :</label>
                            <select id="s_devisecoutunit" name="s_devisecoutunit" class="form-select" onchange="synchronizeCurrencies(this)">
                                <option value="CFA" <?= $liste['DeviseCoutUnit'] == 'CFA' ? 'selected' : '' ?>>CFA</option>
                                <option value="EUR" <?= $liste['DeviseCoutUnit'] == 'EUR' ? 'selected' : '' ?>>Euro</option>
                                <option value="USD" <?= $liste['DeviseCoutUnit'] == 'USD' ? 'selected' : '' ?>>Dollar</option>
                                <!-- Ajoute d'autres devises si nécessaire -->
                            </select>
                        </div>
                    </div>

            </fieldset>
            
            <div class="mt-4 text-center">
                <button type="submit" name="update_form_produit" class="btn btn-primary">Ajouter</button>
                <button type="reset" class="btn btn-secondary">Annuler</button>
            </div>
        </form>
    </section>

    <?php
        include("../footer/pied_de_page.php");
    ?>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->

    <script>
        function synchronizeCurrencies(selectedElement) {
            var selectedValue = selectedElement.value;

            // Synchroniser la devise Prix de vente avec Coût unitaire et vice versa
            if (selectedElement.id === 's_deviseprixvente') {
                document.getElementById('s_devisecoutunit').value = selectedValue;
            } else {
                document.getElementById('s_deviseprixvente').value = selectedValue;
            }
        }
    </script>
</body>

</html>