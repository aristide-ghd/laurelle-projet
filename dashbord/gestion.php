<?php 
    // Activer l'affichage des erreurs pour le developpement
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    include("../session_start_verify.php"); // Fichier pour verifier la connexion_user avec la session

    include('../sign_in.php'); // Connexion a la base de donnée

    include("../db_connected_verify.php"); // Vérification de la connexion à la base de données

    // Récupération de la date sélectionnée ou celle du jour par defaut
    $date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

    // Requêtes pour récupérer les montants des ventes, recettes et dépenses pour la date sélectionnée
    $queryVentes = "SELECT MontantTotal FROM ventes WHERE DateVente = :date";
    $queryDepenses = "SELECT MontantDepense FROM depenses WHERE DateDepense = :date";
    $queryRecettes = "SELECT MontantRecette FROM recettes WHERE DateRecette = :date";
    
    if (isset($bdd)) {
        // Préparation et exécution des requêtes
        $slmtVentes = $bdd->prepare($queryVentes);
        $slmtDepenses = $bdd->prepare($queryDepenses);
        $slmtRecettes = $bdd->prepare($queryRecettes);
    
        $slmtVentes->execute([':date' => $date]);
        $slmtDepenses->execute([':date' => $date]);
        $slmtRecettes->execute([':date' => $date]);
    } else {
        die("Connexion à la base de données échouée.");
    }
    
    // Initialisation des variables pour les totaux et les devises
    $totalVentes = 0;
    $totalDepenses = 0;
    $totalRecettes = 0;
    $deviseVentes = '';
    $deviseDepenses = '';
    $deviseRecettes = '';

    // Fonction pour extraire le montant numérique
    function extractMontant($string) {
        // Supprimer les caracteres non numeriques, y compris les espaces et les lettres 
        $string = preg_replace('/[^\d.,]/', '', $string);
    
        // Remplacer les virgules par des points pour des decimales 
        $string = str_replace(',', '.', $string);

        return is_numeric($string) ? (float)$string : 0; //Par defaut 0 si aucun montant n'est trouvée
    }

    // Fonction pour extraire la devise
    function extractDevise($string) {
        // Extraire tous les caractères après le dernier chiffre (c'est la devise)
        $devise = preg_replace('/[\d.,\s]/', '', $string);
        return $devise ? $devise : 'CFA'; // Par défaut, CFA si aucune devise n'est trouvée
    }

    // Calcul des totaux et recuperation des devises pour les ventes 
    while($row = $slmtVentes -> fetch(PDO::FETCH_ASSOC)){
        $totalVentes += extractMontant($row['MontantTotal']);  //Extraire le montant
        $deviseVentes = extractDevise($row['MontantTotal']);   //Extraire la devise
    }

    while($row = $slmtDepenses -> fetch(PDO::FETCH_ASSOC)){
        $totalDepenses += extractMontant($row['MontantDepense']);
        $deviseDepenses = extractDevise($row['MontantDepense']);
    }

    while($row = $slmtRecettes -> fetch(PDO::FETCH_ASSOC)){
        $totalRecettes += extractMontant($row['MontantRecette']);
        $deviseRecettes = extractDevise($row['MontantRecette']);
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title>Page de gestion</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .ajout{
            margin-top: 60px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        footer {
            margin-top: auto;
            bottom: 0;
            width: 100%;
        }
        .refresh-button {
            margin-top: 20px;
        }
    </style>

    <?php include '../mode.php'; // Fichier pour activer le mode sombre et le mode clair  ?>

</head>

<body class="d-flex flex-column min-vh-100">
    <?php include '../navbar/en_tete.php';?>

    <section class="container my-5 flex-grow-1">
        <h1 class=" ajout text-center text-secondary fs-1 mb-4">Visibilité sur vos finances</h1>
        <div class="date-filter text-center">
            <form method="GET" action="gestion.php">
                <div class="input-group">
                    <span class="input-group-text">Date</span>
                    <input type="date" name="date" class="form-control" value="<?= htmlspecialchars($date); ?>" required>
                    <button type="submit" class="btn btn-outline-dark">Filtrer</button>
                </div>
            </form>
        </div><br>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead class="text-white">
                    <tr>
                        <th>Type</th>
                        <th class="text-end fw-bold">Total</th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="bg-light rounded-3 shadow-sm">
                        <td class="fw-bold d-flex align-items-center">
                            <i class="bi bi-cash me-2 fs-4 text-success"></i> Ventes
                        </td>

                        <td class="text-end"><?= number_format($totalVentes, 2, ',', ' '); ?> <?= htmlspecialchars($deviseVentes); ?> </td>
                    </tr>

                    <tr class="bg-light rounded-3 shadow-sm mt-3">
                        <td class="fw-bold d-flex align-items-center">
                            <i class="bi bi-wallet2 me-2 fs-4 text-danger"></i> Dépenses
                        </td>

                        <td class="text-end"><?= number_format($totalDepenses, 2, ',', ' '); ?> <?= htmlspecialchars($deviseDepenses); ?> </td>
                    </tr>

                    <tr class="bg-light rounded-3 shadow-sm mt-3">
                        <td class="fw-bold d-flex align-items-center">
                            <i class="bi bi-piggy-bank me-2 fs-4 text-info"></i> Recettes
                        </td>

                        <td class="text-end"><?= number_format($totalRecettes, 2, ',', ' '); ?> <?= htmlspecialchars($deviseRecettes); ?> </td>
                    </tr>
                </tbody>

            </table>
        </div>

        <div class="text-center refresh-button">
            <a href="gestion.php" class="btn btn-primary">Rafraîchir les données</a>
        </div>
    </section>

    <?php
        include("../footer/pied_de_page.php");
    ?>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
</body>

</html>