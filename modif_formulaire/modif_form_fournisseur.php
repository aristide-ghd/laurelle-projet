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


    include("../connexion.php"); // Connexion a la base de donnée

    include("../db_connected_verify.php"); // Vérification de la connexion à la base de données

    $matfournisseur = $_GET['id'];
    $req = "SELECT * FROM fournisseurs WHERE idFournisseur= $matfournisseur";
    $reponse = $bdd -> query($req);
    $donnee = $reponse -> fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Modifications des fournisseurs</title>

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
        <h1 class="ajout text-center mb-4">Modifier un fournisseur</h1>

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
            </div>

            <!-- Utilisation de javascript pour la redirection -->
            <script>
                setTimeout(function() {
                    window.location.href = "../dashbord/fournisseur.php"; // redirige vers la page des fournisseurs
                }, 3000); // délai de 3 secondes
            </script>
        <?php endif; ?>

        <!-- Affichage du message d'echec -->
        <?php if($message_fournisseur_fail != ""): ?>
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $message_fournisseur_fail; ?>
            </div>
        <?php endif; ?>


        <form action="../validation/valider_modif_form.php" method="post">
            <fieldset class="border p-4 rounded">
                <legend class="fw-bold">Fournisseur</legend>
                <?php foreach($donnee as $liste){ ?>

                    <div class="mb-3">
                        <label for="s_numero" class="form-label">Matricule fournisseur :</label>
                        <input type="text" id="s_numero" name="s_numero" class="form-control" value="<?= $liste['idFournisseur'] ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="s_nomfournisseur" class="form-label">Nom du fournisseur :</label>
                        <input type="text" id="s_nomfournisseur" name="s_nomfournisseur" class="form-control" value="<?= $liste['NomFournisseur'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="s_adressefournisseur" class="form-label">Adresse du fournisseur :</label>
                        <input type="text" id="s_adressefournisseur" name="s_adressefournisseur" class="form-control" value="<?= $liste['AdresseFournisseur'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="s_coordonneesfournisseur" class="form-label">Coordonnées du fournisseur :</label>
                        <input type="text" id="s_coordonneesfournisseur" name="s_coordonneesfournisseur" class="form-control" value="<?= $liste['CoordonneesFournisseur'] ?>">
                    </div>

                <?php } ?>
            </fieldset>

            <div class="mt-4 text-center">
                <button type="submit" name="update_form_fournisseur" class="btn btn-primary">Ajouter</button>
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
