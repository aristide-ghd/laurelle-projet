<?php
    // Activer l'affichage des erreurs pour le developpement
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start(); // Initialiser la session
    session_regenerate_id(true); // Regenere l'id de session pour plus de securité

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


    $matrec = $_GET['id'];

    $req1 = "SELECT * FROM recettes WHERE idRecette = $matrec";
    $reponse1 = $bdd -> query($req1);
    $donnee1 = $reponse1 -> fetchAll();

    foreach($donnee1 as $liste)
    {
        $mdp = $liste['idModePaiement'];

        $montantRecetteDetails = explode(' ', $liste['MontantRecette']);
        $liste['Montant'] = $montantRecetteDetails[0];
        $liste['DeviseMontantRecette'] = $montantRecetteDetails[1];
    }

    $req = " SELECT * FROM modepaiement ORDER BY idModePaiement";
    $reponse = $bdd -> query($req);
    $donnee = $reponse -> fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Modification des recettes</title>

    <style>
        .ajout{
            margin-top: 60px;
            color: #0d6efd;
        }
    </style>

    <?php include '../mode.php'; ?>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../navbar/en_tete.php'; ?>

    <section class="container my-5 flex-grow-1">
        <h1 class="ajout text-center mb-4">Modifier une recette</h1>

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

                <!-- Utilisation de javascript pour la redirection -->
                <script>
                    setTimeout(function() {
                        window.location.href = "../dashbord/recette.php"; // redirige vers la page des recettes
                    }, 3000); // délai de 3 secondes
                </script>
            </div>
        <?php endif; ?>

        <!-- Affichage du message d'echec -->
        <?php if($message_recette_fail != ""): ?>
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $message_recette_fail; ?>
            </div>
        <?php endif; ?>


        <form action="../validation/valider_modif_form.php" method="post">
            <fieldset class="border p-4 rounded">
                <legend class="fw-bold">Recette</legend>

                <div class="mb-3">
                    <label for="s_numero" class="form-label">Matricule Recette :</label>
                    <input type="text" id="s_numero" name="s_numero" class="form-control" value="<?= $liste['idRecette'] ?>" readonly>
                </div>

                <div class="mb-3 row">
                    <div class="col">
                        <label for="s_montantrecette" class="form-label">Montant de recette :</label>
                        <input type="text" id="s_montantrecette" name="s_montantrecette" class="form-control" value="<?= $liste['Montant'] ?>">
                    </div>

                    <div class="col">
                        <label for="s_devisemontantrecette" class="form-label">Devise :</label>
                        <select id="s_devisemontantrecette" name="s_devisemontantrecette" class="form-select">
                            <option value="CFA" <?= $liste['DeviseMontantRecette'] == 'CFA' ? 'selected' : '' ?>>CFA</option>
                            <option value="EUR" <?= $liste['DeviseMontantRecette'] == 'EUR' ? 'selected' : '' ?>>Euro</option>
                            <option value="USD" <?= $liste['DeviseMontantRecette'] == 'USD' ? 'selected' : '' ?>>Dollar</option>
                            <!-- Ajoute d'autres devises si nécessaire -->
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="s_daterecette" class="form-label">Date de Recette :</label>
                    <input type="date" id="s_daterecette" name="s_daterecette" class="form-control" value="<?= $liste['DateRecette'] ?>">
                </div>

                <div class="mb-3">
                    <label for="s_descriptionrecette" class="form-label">Description de Recette :</label>
                    <input type="text" id="s_descriptionrecette" name="s_descriptionrecette" class="form-control" value="<?= $liste['DescriptionRecette'] ?>">
                </div>

                <div class="mb-3">
                    <label for="listmode" class="form-label">Mode de Paiement :</label>
                    <select name="s_modepaiement" id="listmode" class="form-select">
                        <?php
                                foreach ($donnee as $listemode)
                                {
                                    if($listemode['idModePaiement'] == $mdp)
                                    {?>
                                        <option selected value="<?= $listemode['idModePaiement'] ?>">
                                                                <?= $listemode['NomModePaiement'] ?>
                                        </option>
                        <?php       }
                                    else
                                    {?>
                                        <option value="<?= $listemode['idModePaiement'] ?>">
                                                        <?= $listemode['NomModePaiement'] ?>
                                        </option>
                        <?php       }
                                }?>
                    </select>
                </div>
            </fieldset>

            <div class="mt-4 text-center">
                <button type="submit" name="update_form_recette" class="btn btn-primary">Ajouter</button>
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