<?php 
    // Activer l'affichage des erreurs
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    
    include("../session_start_verify.php"); // Fichier pour verifier la connexion_user avec la session

    include('../sign_in.php'); // Connexion a la base de donnée

    include("../db_connected_verify.php"); // Vérification de la connexion à la base de données
    
    // Préparer les requêtes pour éviter l'injection SQL
    $req = $bdd -> prepare("SELECT * FROM fournisseurs");
    $req -> execute();
    $fournisseurs = $req -> fetchAll();

    if (!$fournisseurs)
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Page fournisseur</title>

    <style>
        .ajout {
            margin-top: 60px;
        }
        footer {
            margin-top: auto;
            bottom: 0;
            width: 100%;
        }
        .table-responsive {
            overflow-x: auto;
        }
        @media (max-width: 768px) {
            .ajout {
                margin-top: 50px;
            }
            footer {
                margin-top: 20%;
            }
        }
    </style>

    <?php include '../mode.php'; // Fichier pour activer le mode sombre et le mode clair ?>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../navbar/en_tete.php'; ?>
    
    <section class="container my-5 flex-grow-1">
        <h1 class="ajout mb-4 text-center">Liste des fournisseurs</h1>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Matricule fournisseur</th>
                        <th>Nom du fournisseur</th>
                        <th>Adresse du fournisseur</th>
                        <th>Coordonnées du fournisseur</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($fournisseurs as $liste): ?>
                    <tr>
                        <td><?= $liste['idFournisseur'] ?></td>
                        <td><?= $liste['NomFournisseur'] ?></td>
                        <td><?= $liste['AdresseFournisseur'] ?></td>
                        <td><?= $liste['CoordonneesFournisseur'] ?></td>
                        <td>
                            <a href="../modif_formulaire/modif_form_fournisseur.php?id=<?= $liste['idFournisseur'] ?>" class="btn btn-primary btn-sm col-lg-5 col-md-12 col-sm-12">Modifier</a>
                            <button type="button" class="btn btn-danger btn-sm col-lg-5 col-md-12 col-sm-12" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $liste['idFournisseur'] ?>">
                                Supprimer
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <a href="../formulaire/formulaire_fournisseur.php" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Enregistrer un fournisseur
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
                    Êtes-vous sûr de vouloir supprimer ce fournisseur ? <br>
                    Cette action est irréversible.
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
        // Script pour passer l'ID du fournisseur à la modale et configurer le lien de suppression
        var deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Bouton qui a déclenché la modale
            var idFournisseur = button.getAttribute('data-id'); // Extraction de l'ID

            var confirmDelete = document.getElementById('confirmDelete');
            confirmDelete.href = '../suppression/delete_fournisseur.php?id=' + idFournisseur; // Configuration du lien de suppression
        });
    </script>
</body>
</html>