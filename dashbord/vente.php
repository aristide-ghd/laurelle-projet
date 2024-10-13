<?php
session_start();

// Vérification si l'utilisateur est connecté
if(!isset($_SESSION['logged_in'])) {
    header("Location: ../index.php");
    exit;
}

include("../connexion.php");
// Test de la connexion
if (!isset($db)) {
    die('La connexion à la base de données a échoué.');
}

// Récupération des données des ventes
try {
    $req = "SELECT * FROM ventes";
    $stmt = $db->prepare($req);
    $stmt->execute();
    $donnee = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur lors de la récupération des données : " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Page Vente</title>
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
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../navbar/en_tete.php'; ?>

    <section class="container my-5 flex-grow-1">
        <h1 class="ajout mb-4 text-center">Voici ci-joint une liste des ventes effectuées</h1>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Matricule Vente</th>
                        <th>Date de Vente</th>
                        <th>Quantité Vendue</th>
                        <th>Montant Total</th>
                        <th>Matricule Produit</th>
                        <th>Matricule Mode de Paiement</th>
                        <th class="col-lg-2 col-md-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($donnee as $liste): ?>
                    <tr>
                        <td><?= htmlspecialchars($liste['idVente']) ?></td>
                        <td><?= htmlspecialchars($liste['DateVente']) ?></td>
                        <td><?= htmlspecialchars($liste['QuantiteVendue']) ?></td>
                        <td><?= htmlspecialchars($liste['MontantTotal']) ?></td>
                        <td><?= htmlspecialchars($liste['idProduit']) ?></td>
                        <td><?= htmlspecialchars($liste['idModePaiement']) ?></td>
                        <td>
                            <a href="../modif_formulaire/modif_form_vente.php?id=<?= htmlspecialchars($liste['idVente']) ?>" class="btn btn-primary btn-sm col-lg-5 col-md-12 col-sm-12">Modifier</a>
                            <button type="button" class="btn btn-danger btn-sm col-lg-5 col-md-12 col-sm-12" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= htmlspecialchars($liste['idVente']) ?>">
                                Supprimer
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
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
                    Êtes-vous sûr de vouloir supprimer cette vente ? <br>
                    Cette action est irréversible.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <a href="#" id="confirmDelete" class="btn btn-danger">Supprimer</a>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-4 mt-auto">
        <p class="mb-0 ">Copyright © 2024 Homechip's Laure | Tous droits réservés</p>
        <p class="mb-0 ">Design by: <a href="https://ari-luxury.com" class="text-white text-decoration-none">Ari-Luxury</a></p>
    </footer>
    
    <script>
        // Script pour passer l'ID de vente à la modale et configurer le lien de suppression
        var deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Bouton qui a déclenché la modale
            var idVente = button.getAttribute('data-id'); // Extraction de l'ID

            var confirmDelete = document.getElementById('confirmDelete');
            confirmDelete.href = '../suppression/delete_vente.php?id=' + idVente; // Configuration du lien de suppression
        });
    </script>
</body>
</html>
