<?php
    // Activer l'affichage des erreurs pour le developpement
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include("../session_start_verify.php"); // Fichier pour verifier la connexion_user avec la session

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


    include("../sign_in.php"); // Connexion a la base de donnée

    include("../db_connected_verify.php"); // Vérification de la connexion à la base de données

    $matdep = $_GET['id']; // Recuperation de l'id de la depense a modifié

    // Preparer les requetes pour eviter l'injection SQL
    $req = $bdd -> prepare("SELECT * FROM depenses WHERE idDepense = $matdep");
    $req -> execute();
    $update_depenses = $req -> fetchAll();

    if (!$update_depenses)
    {
        // Affichage d'un message si aucune information n'est trouvée
        echo "Erreur lors de la recuperation des données. Veuillez reessayer plus tard !";
        exit();
    }

    foreach ($update_depenses as $liste)
    {
        $mdp = $liste['idModePaiement'];

        $montantDepenseDetails = explode(' ', $liste['MontantDepense']);
        $liste['Montant'] = $montantDepenseDetails[0];
        $liste['DeviseMontantDepense'] = $montantDepenseDetails[1];
    }

    // Preparer les requetes pour eviter l'injection SQL
    $req1 = $bdd -> prepare("SELECT * FROM modepaiement ORDER BY idModePaiement");
    $req1 -> execute();
    $liste_mdp = $req1 -> fetchAll();

    if (!$liste_mdp)
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Modifications des dépenses</title>

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
        <h1 class="ajout text-center mb-4">Modifier une dépense</h1>

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

                <!-- Utilisation de javascript pour la redirection -->
                <script>
                    setTimeout(function() {
                        window.location.href = "../dashbord/depense.php"; // redirige vers la page des depenses
                    }, 3000); // délai de 3 secondes
                </script>
            </div>
        <?php endif; ?>

        <!-- Affichage du message d'echec -->
        <?php if($message_depense_fail != ""): ?>
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $message_depense_fail; ?>
            </div>
        <?php endif; ?>


        <form action="../validation/valider_modif_form.php" method="post">
            <fieldset class="border p-4 rounded">
                <legend class="fw-bold">Dépense</legend>

                <div class="mb-3">
                    <label for="s_numero" class="form-label">Matricule Dépense :</label>
                    <input type="text" id="s_numero" name="s_numero" class="form-control" value="<?= $liste['idDepense'] ?>" readonly>
                </div>

                <div class="mb-3 row">
                    <div class="col">
                        <label for="s_montantdepense" class="form-label">Montant de dépense :</label>
                        <input type="text" id="s_montantdepense" name="s_montantdepense" class="form-control" value="<?= $liste['Montant'] ?>">
                    </div>

                    <div class="col">
                        <label for="s_devisemontantdepense" class="form-label">Devise :</label>
                        <select id="s_devisemontantdepense" name="s_devisemontantdepense" class="form-select">
                            <option value="CFA" <?= $liste['DeviseMontantDepense'] == 'CFA' ? 'selected' : '' ?>>CFA</option>
                            <option value="EUR" <?= $liste['DeviseMontantDepense'] == 'EUR' ? 'selected' : '' ?>>Euro</option>
                            <option value="USD" <?= $liste['DeviseMontantDepense'] == 'USD' ? 'selected' : '' ?>>Dollar</option>
                            <!-- Ajoute d'autres devises si nécessaire -->
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="s_datedepense" class="form-label">Date de Dépense :</label>
                    <input type="date" id="s_datedepense" name="s_datedepense" class="form-control" value="<?= $liste['DateDepense'] ?>">
                </div>

                <div class="mb-3">
                    <label for="s_descriptiondepense" class="form-label">Description de Dépense :</label>
                    <input type="text" id="s_descriptiondepense" name="s_descriptiondepense" class="form-control" value="<?= $liste['DescriptionDepense'] ?>">
                </div>

                <div class="mb-3">
                    <label for="listmode" class="form-label">Mode de Paiement :</label>
                    <select name="s_modepaiement" id="listmode" class="form-select">
                        <?php
                                foreach ($liste_mdp as $liste_mode)
                                {
                                    if($liste_mode['idModePaiement'] == $mdp)
                                    {?>
                                        <option selected value="<?= $liste_mode['idModePaiement'] ?>">
                                                                <?= $liste_mode['NomModePaiement'] ?>
                                        </option>
                        <?php       }
                                    else
                                    {?>
                                        <option value="<?= $liste_mode['idModePaiement'] ?>">
                                                        <?= $liste_mode['NomModePaiement'] ?>
                                        </option>
                        <?php       }
                                }?>
                    </select>
                </div>
            </fieldset>

            <div class="mt-4 text-center">
                <button type="submit" name="update_form_depense" class="btn btn-primary">Ajouter</button>
                <button type="reset" class="btn btn-secondary">Annuler</button>
            </div>
        </form>
    </section>

    <?php
        include("../footer/pied_de_page.php");
    ?>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>