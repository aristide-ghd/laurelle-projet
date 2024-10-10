<?php
    session_start();

    // Vérification si l'utilisateur est connecté
    if(!isset($_SESSION['logged_in'])) {
        // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
        header("Location: ../index.php");
        exit;
    }

    include("../connexion.php");

    $id_entreprise = $_SESSION['id_entreprise'];

    $query = "SELECT * FROM entreprise WHERE id_entreprise = :id_entreprise";
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
    <title>Homechip's Laure</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .footer {
            /* margin-top: 4%; */
            width: 100%;
        }
        .bg-gradient {
            background: linear-gradient(45deg, #ff6f61, #ff946e);
        }
        .card {
            overflow: hidden;
        }
        .card-body p {
            font-size: 1.1rem;
            padding: 0.5rem 0;
        }
        .card-body i, .card-body strong {
            margin-right: 0.5rem;
        }
        footer {
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }
        .bordered {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1); /* Bordure fine et transparente */
            margin-left: 10px;
            margin-right: 10px;
        }
        .bordered:last-child {
            border-bottom: none; /* Pas de bordure sur le dernier élément */
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../navbar/en_tete.php'; ?>

    <section class="container my-5 pt-5 flex-grow-1">
        <div class="text-center mb-4">
            <h2 class="bg-gradient p-3 rounded shadow mt-4">
                Informations de l'entreprise
            </h2>
        </div>
        <div class="card shadow-lg border-0">
            <div class="card-body bg-white rounded">
                <p class="bordered">
                    <i class="fas fa-user-tie text-primary"></i>
                    <strong>Noms et Prénoms :</strong> 
                    <?= htmlspecialchars($entreprise['Prenom']); ?> <?= htmlspecialchars($entreprise['Nom']); ?>
                </p>
                <p class="bordered">
                    <i class="fas fa-envelope text-primary"></i>
                    <strong>Email :</strong> 
                    <?= htmlspecialchars($entreprise['Email']); ?>

                    <button class="btn btn-link text-decoration-none" onclick="copyToClipboard('<?= htmlspecialchars($entreprise['Email']); ?>')" title="Copier l'email">
                        <i class="fas fa-copy"></i>
                    </button>
                </p>
                <p class="bordered">
                    <i class="fas fa-phone text-primary"></i>
                    <strong>Téléphone :</strong> 
                    <?= htmlspecialchars($entreprise['Telephone']); ?>

                    <button class="btn btn-link text-decoration-none" onclick="copyToClipboard('<?= htmlspecialchars($entreprise['Telephone']); ?>')" title="Copier le numéro de téléphone">
                        <i class="fas fa-copy"></i>
                    </button>
                </p>
                <p class="bordered">
                    <i class="fas fa-globe text-primary"></i>
                    <strong>Pays :</strong> 
                    <?= htmlspecialchars($entreprise['Pays']); ?>
                </p>
                <p class="bordered">
                    <i class="fas fa-building text-primary"></i>
                    <strong>Nom de l'entreprise :</strong> 
                    <?= htmlspecialchars($entreprise['nomEntreprise']); ?>
                </p>
                <p class="bordered">
                    <i class="fas fa-box text-primary"></i>
                    <strong>Nom du produit :</strong> 
                    <?= htmlspecialchars($entreprise['Produit']); ?>
                </p>
                <p class="bordered">
                    <i class="fas fa-map-marker-alt text-primary"></i>
                    <strong>Adresse :</strong> 
                    <?= htmlspecialchars($entreprise['adresseEntreprise']); ?>
                </p>
            </div>
        </div>
    </section>
    
    <footer class="bg-dark text-white text-center py-4 footer">
        <p class="mb-0 ">Copyright © 2024 Homechip's Laure | Tous droits réservés</p>
        <p class="mb-0 ">Design by: <a href="https://ari-luxury.com" class="text-white text-decoration-none">Ari-Luxury    </a></p>
    </footer>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text)
                .then(() => alert('Copié dans le presse-papiers'))
                .catch(err => console.error('Échec de la copie : ', err));
        }
    </script>
</body>
</html>