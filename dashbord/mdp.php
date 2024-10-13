<?php
    session_start();
    
    // Vérification si l'utilisateur est connecté
    if(!isset($_SESSION['logged_in'])) {
        // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
        header("Location: ../index.php");
        exit;
    }

    include("../connexion.php");
    $req = " SELECT * FROM modepaiement ";
    $reponse = $db -> query($req);
    $donnee = $reponse -> fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css/tab_mdp.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Page Mode de Paiement</title>
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
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../navbar/en_tete.php'; ?>

    <section class="container my-5 flex-grow-1">
        <h1 class=" ajout text-center mb-4">Liste des modes de paiement</h1>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Matricule Mode de Paiement</th>
                        <th>Nom Mode de Paiement</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($donnee as $liste){  
                    ?>
                    <tr>
                        <td><?= $liste['idModePaiement'] ?></td>
                        <td><?= $liste['NomModePaiement'] ?></td>
                        <td>
                            <a href="../modif_formulaire/modif_form_mdp.php?id=<?= $liste['idModePaiement'] ?>" class="btn btn-primary btn-sm col-lg-5 col-md-12 col-sm-12">Modifier</a>
                            <button type="button" class="btn btn-danger btn-sm col-lg-5 col-md-12 col-sm-12" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $liste['idModePaiement'] ?>">
                                Supprimer
                            </button>
                        </td>
                    </tr>
                    <?php
                        }  
                    ?>
                </tbody>
            </table>
        </div>
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
                    Êtes-vous sûr de vouloir supprimer ce mode de paiement ? <br>
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

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p class="mb-0">Copyright © 2024 Homechip's Laure | Tous droits réservés</p>
        <p class="mb-0">Design by: <a href="https://ari-luxury.com" class="text-white text-decoration-none">Ari-Luxury</a></p>
    </footer>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->

    <script>
        // Script pour passer l'ID du mode de paiement à la modale et configurer le lien de suppression
        var deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Bouton qui a déclenché la modale
            var idModePaiement = button.getAttribute('data-id'); // Extraction de l'ID

            var confirmDelete = document.getElementById('confirmDelete');
            confirmDelete.href = '../suppression/delete_mdp.php?id=' + idModePaiement; // Configuration du lien de suppression
        });
    </script>
</body>
</html>