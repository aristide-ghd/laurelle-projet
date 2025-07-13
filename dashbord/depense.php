<?php
    // Activer l'affichage des erreurs
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    
    include("../session_start_verify.php"); // Fichier pour verifier la connexion_user avec la session

    include("../sign_in.php"); // Connexion a la base de donnée

    include("../db_connected_verify.php"); // Vérification de la connexion à la base de données

    // Préparer les requêtes pour éviter l'injection SQL
    $req = $bdd -> prepare(" SELECT * FROM depenses ");
    $req -> execute();
    $depenses = $req -> fetchAll();

    if (!$depenses)
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

    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <title>Page Depense</title>

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
    </style>

    <?php include '../mode.php'; // Fichier pour activer le mode sombre et le mode clair ?>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../navbar/en_tete.php'; ?>

    <section class="container my-5 flex-grow-1">
        <h1 class=" ajout text-center mb-4">Vos dépenses s'affichent ici</h1>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Matricule Depense</th>
                        <th>Montant de Dépense</th>
                        <th>Date de Dépense</th>
                        <th>Description de Dépense</th>
                        <th>Matricule Mode de Paiement</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($depenses as $liste): ?>
                    <tr>
                        <td><?= $liste['idDepense'] ?></td>
                        <td><?= $liste['MontantDepense'] ?></td>
                        <td><?= $liste['DateDepense'] ?></td>
                        <td><?= $liste['DescriptionDepense'] ?></td>
                        <td><?= $liste['idModePaiement'] ?></td>
                        <td>
                            <a href="../modif_formulaire/modif_form_depense.php?id=<?= $liste['idDepense'] ?>" class="btn btn-primary btn-sm col-lg-5 col-md-12 col-sm-12">Modifier</a>
                            <button type="button" class="btn btn-danger btn-sm col-lg-5 col-md-12 col-sm-12" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $liste['idDepense'] ?>">
                                Supprimer
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <a href="../formulaire/formulaire_depense.php" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Enregistrer une dépense
        </a>

    </section>

    <!-- Modale Bootstrap pour la confirmation de suppression -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer cette dépense ? <br>
                    Notez bien que cette action est irréversible.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <!-- Le lien de suppression réel -->
                    <a href="#" id="confirmDelete" class="btn btn-danger">Supprimer</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php
        include("../footer/pied_de_page.php");
    ?>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->

    <script>
        // Script pour passer l'ID de depense à la modale et configurer le lien de suppression
        var deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Bouton qui a déclenché la modale
            var idDepense = button.getAttribute('data-id'); // Extraction de l'ID

            var confirmDelete = document.getElementById('confirmDelete');
            confirmDelete.href = '../suppression/delete_depense.php?id=' + idDepense; // Configuration du lien de suppression
        });
    </script>
</body>
</html>