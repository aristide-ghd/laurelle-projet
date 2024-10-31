<?php
    // Activer l'affichage des erreurs pour le developpement
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include("../session_start_verify.php"); // Fichier pour verifier la connexion_user avec la session

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


    include("../connexion.php"); // Connexion a la base de donnée

    include("../db_connected_verify.php"); // Vérification de la connexion à la base de données

    $matmdp = $_GET['id'];

    $req1 = "SELECT * FROM modepaiement WHERE idModePaiement = $matmdp";
    $reponse1 = $bdd -> query($req1);
    $donnee1 = $reponse1 -> fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Modification du Mode de Paiement</title>
    
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
        <h1 class="ajout text-center mb-4">Modifier un mode de paiement</h1>

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
                
                <!-- Utilisation de javascript pour la redirection -->
                <script>
                    setTimeout(function() {
                        window.location.href = "../dashbord/mdp.php"; // redirige vers la page des modes de paiement
                    }, 3000); // délai de 3 secondes
                </script>
            </div>
        <?php endif; ?>

        <!-- Affichage du message d'echec -->
        <?php if($message_mdp_fail != ""): ?>
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $message_mdp_fail; ?>
            </div>
        <?php endif; ?>


        <form action="../validation/valider_modif_form.php" method="post">
            <fieldset class="border p-4 rounded">
                <legend class="fw-bold">Mode de Paiement</legend>

                <?php foreach($donnee1 as $liste){ ?>

                <div class="mb-3">
                    <label for="s_numero" class="form-label">Matricule Mode Paiement :</label>
                    <input type="text" id="s_numero" name="s_numero" class="form-control" value="<?= $liste['idModePaiement'] ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="s_nom_modepaiement" class="form-label">Nom Mode de Paiement :</label>
                    <input type="text" id="s_nom_modepaiement" name="s_nom_modepaiement" class="form-control" value="<?= $liste['NomModePaiement'] ?>">
                </div>

                <?php } ?>
            </fieldset>

            <div class="mt-4 text-center">
                <button type="submit" name="update_form_mdp" class="btn btn-primary">Ajouter</button>
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