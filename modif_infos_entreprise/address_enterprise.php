<?php
    session_start();

    // Recuperer le message des champs stocké dans la session (si disponible)
    $message_address_entreprise_input = isset($_SESSION['message_address_entreprise_input']) ? $_SESSION['message_address_entreprise_input'] : '';

    // Recuperer le message de succès stocké dans la session (si disponible)
    $message_address_entreprise_success = isset($_SESSION['message_address_entreprise_success']) ? $_SESSION['message_address_entreprise_success'] : '';

    // Recuperer le message d'error stocké dans la session (si disponible)
    $message_address_entreprise_error = isset($_SESSION['message_address_entreprise_error']) ? $_SESSION['message_address_entreprise_error'] : '';


    // Supprimer le message des champs apres l'avoir affiché pour eviter qu'il persiste
    unset($_SESSION['message_address_entreprise_input']);

    // Supprimer le message de succès apres l'avoir affiché pour eviter qu'il persiste
    unset($_SESSION['message_address_entreprise_success']);

    // Supprimer le message d'error apres l'avoir affiché pour eviter qu'il persiste
    unset($_SESSION['message_address_entreprise_error']);


    // Vérification si l'utilisateur est connecté
    if(!isset($_SESSION['logged_in'])) {
        // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
        header("Location: ../index.php");
        exit;
    }

    include('../connexion.php');

    // Vérification de la connexion à la base de données
    if (!$bdd) {
        die("Erreur de connexion à la base de données");
    }

    $id_entreprise = $_SESSION['id_entreprise'];

    $query = "SELECT adresseEntreprise FROM entreprise WHERE id_entreprise = :id_entreprise";
    $stmt = $bdd -> prepare($query);
    $stmt -> bindParam(':id_entreprise', $id_entreprise, PDO::PARAM_INT);
    $stmt -> execute();
    $entreprise = $stmt -> fetch(PDO::FETCH_ASSOC);

    if (!$entreprise)
    {
        echo "Aucune information disponible pour l'entreprise.";
        exit;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Modification de l'adresse</title>
    <style>
        .link_back{
            font-size: 1.1rem;
        }
        .link_back:hover{
            color: blue;
        }
    </style>
    
    <?php include '../mode.php'; ?>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../navbar/en_tete.php'; ?>

    <section class="container my-5 pt-5 flex-grow-1">
        <a href="../profile/account_info.php" class="text-decoration-none text-dark">
            <p class="link_back my-5">
                <i class="fas fa-arrow-left"></i>
                <span class="ms-2">Retour</span>
            </p>
        </a>

        <!-- Affichage du message des champs -->
        <?php if($message_address_entreprise_input != ""): ?>
            <div class="alert alert-warning" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $message_address_entreprise_input; ?>
            </div>
        <?php endif; ?>

        <!-- Affichage du message de succès -->
        <?php if($message_address_entreprise_success != ""): ?>
            <div class="alert alert-success" role="alert">
                <i class="fas fa-check-circle"></i> <?php echo $message_address_entreprise_success; ?>
            </div>
            <!-- Utilisation de javascript pour la redirection -->
            <script>
                setTimeout(function() {
                    window.location.href = "../profile/account_info.php"; // redirige vers la page d'accueil
                }, 3000); // délai de 3 secondes
            </script>
        <?php endif; ?>

        <!-- Affichage du message d'error -->
        <?php if($message_address_entreprise_error != ""): ?>
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $message_address_entreprise_error; ?>
            </div>
        <?php endif; ?>

        <h3 class="mb-2">Adresse de l'entreprise :</h3>
        <form method="post" action="../validation/valider_infos_entreprise.php">
            <fieldset class="border p-4 rounded">
                <div class="mb-3">
                    <label for="adresse_entreprise" class="form-label"></label>
                    <input type="text" class="form-control" id="adresse_entreprise" name="s_adresse_entreprise" value="<?= htmlspecialchars($entreprise['adresseEntreprise'])?>">
                </div>
            </fieldset>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" name="submit_adresse_entreprise" class="btn btn-primary">Ajouter</button>
                <button type="reset" class="btn btn-secondary">Annuler</button>
            </div>
        </form>
    </section>

    <?php
        include("../footer/pied_de_page.php");
    ?>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->

</body>
</html>