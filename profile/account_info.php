<?php
    // Activer l'affichage des erreurs
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start(); // Initialiser la session

    // Vérification si l'utilisateur est connecté
    if(!isset($_SESSION['logged_in'])) {
        // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
        header("Location: ../index.php");
        exit;
    }

    include("../connexion.php"); // Connexion a la base de donnée

    $id_entreprise = $_SESSION['id_entreprise']; // Recupération d'id de lentreprise dans la session

    // Requete pour afficher les infos de l'entreprise 
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
    <title>Informations du compte</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
        /* footer {
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        } */
        .bordered-link, .bordered{
            border-bottom: 1px solid rgba(0, 0, 0, 0.1); /* Bordure fine et transparente */
            margin-left: 10px;
            margin-right: 10px;
        }
        .bordered:last-child{
            border-bottom: none;
        }
        .last-child{
            margin-left: 10px;
            margin-right: 10px;
        }
        .p-editable {
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
        }
        .p-editable i.fa-arrow-right {
            color: black;
            opacity: 0.5; /* Rend la flèche transparente */
            transition: opacity 0.3s; /* Ajoute une transition pour un effet d’apparition */
        }
        .p-editable:hover i.fa-arrow-right {
            opacity: 1; /* Rend la flèche visible au survol */
        }
        .btn-primary{
            margin-left: 10px;
        }
        #map {
            width: 100%;
            height: 400px;
        }
        .phone-icon {
            color: #28a745; /* Vert pour le téléphone */
        }
        .facebook-icon {
            color: #3b5998; /* Bleu pour Facebook */
        }
        .twitter-icon {
            color: #1da1f2; /* Bleu clair pour Twitter */
        }
        .whatsapp-icon {
            color: #25D366; /* Vert WhatsApp */
        }
    </style>

    <?php include '../mode.php'; ?>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include '../navbar/en_tete.php'; ?>

    <section class="container my-5 pt-5 flex-grow-1">

        <!-- Informations de l'entreprise-->
        <div class="text-center mb-4">
            <h2 class="bg-gradient p-3 rounded shadow mt-4">
                Informations de l'entreprise
            </h2>
        </div>

        <div class="card shadow-lg border-0">
            <div class="card-body bg-white rounded">
                <a href="../modif_infos_entreprise/identity.php" class="text-decoration-none text-dark" title="Modifier">
                    <p class="p-editable bordered-link">
                        <span>
                            <i class="fas fa-user-tie text-primary"></i>
                            <strong>Noms et Prénoms :</strong> 
                            <?= htmlspecialchars($entreprise['Prenom']); ?> <?= htmlspecialchars($entreprise['Nom']); ?>
                        </span>
                        <i class="fas fa-arrow-right"></i>
                    </p>
                </a>

                <a href="../modif_infos_entreprise/email.php" class="text-decoration-none text-dark" title="Modifier">
                    <p class="p-editable bordered-link">
                        <span>
                            <i class="fas fa-envelope text-primary"></i>
                            <strong>Email :</strong> 
                            <?= htmlspecialchars($entreprise['Email']); ?>

                            <button class="btn btn-link text-decoration-none" onclick="copyToClipboard('<?= htmlspecialchars($entreprise['Email']); ?>')" title="Copier l'email">
                                <i class="fas fa-copy"></i>
                            </button>
                        </span>
                        <i class="fas fa-arrow-right"></i>
                    </p>
                </a>
                
                <a href="../modif_infos_entreprise/phone.php" class="text-decoration-none text-dark" title="Modifier">
                    <p class="p-editable bordered-link">
                        <span>
                            <i class="fas fa-phone text-primary"></i>
                            <strong>Téléphone :</strong> 
                            <?= htmlspecialchars($entreprise['Telephone']); ?>

                            <button class="btn btn-link text-decoration-none" onclick="copyToClipboard('<?= htmlspecialchars($entreprise['Telephone']); ?>')" title="Copier le numéro de téléphone">
                                <i class="fas fa-copy"></i>
                            </button>
                        </span>
                        <i class="fas fa-arrow-right"></i>
                    </p>
                </a>

                <a href="../modif_infos_entreprise/country.php" class="text-decoration-none text-dark" title="Modifier">
                    <p class="p-editable bordered-link">
                        <span>
                            <i class="fas fa-globe text-primary"></i>
                            <strong>Pays :</strong> 
                            <?= htmlspecialchars($entreprise['Pays']); ?>
                        </span>
                        <i class="fas fa-arrow-right"></i>
                    </p>
                </a>

                <a href="../modif_infos_entreprise/name_enterprise.php" class="text-decoration-none text-dark" title="Modifier">
                    <p class="p-editable bordered-link">
                        <span>
                            <i class="fas fa-building text-primary"></i>
                            <strong>Nom de l'entreprise :</strong> 
                            <?= htmlspecialchars($entreprise['nomEntreprise']); ?>
                        </span>
                        <i class="fas fa-arrow-right"></i>
                    </p>
                </a>

                <a href="../modif_infos_entreprise/name_produit.php" class="text-decoration-none text-dark" title="Modifier">
                    <p class="p-editable bordered-link">
                        <span>
                            <i class="fas fa-box text-primary"></i>
                            <strong>Nom du produit :</strong> 
                            <?= htmlspecialchars($entreprise['Produit']); ?>
                        </span>
                        <i class="fas fa-arrow-right"></i>
                    </p>
                </a>

                <a href="../modif_infos_entreprise/address_enterprise.php" class="text-decoration-none text-dark" title="Modifier">
                    <p class="p-editable last-child">
                        <span>
                            <i class="fas fa-map-marker-alt text-primary"></i>
                            <strong>Adresse :</strong> 
                            <?= htmlspecialchars($entreprise['adresseEntreprise']); ?>
                        </span>
                        <i class="fas fa-arrow-right"></i>
                    </p>
                </a>
            </div>
        </div>

        <!-- À propos de l'entreprise -->
        <div class="text-center mb-4">
            <h2 class="bg-gradient p-3 rounded shadow mt-5">
                À propos de l'entreprise
            </h2>
        </div>

        <div class="card shadow-lg border-0">
            <div class="card-body bg-white rounded">
                <p class= "bordered">
                    <i class="fas fa-info-circle"></i> 
                    <strong>Description :</strong> Une brève description de l'entreprise, ses valeurs et sa mission.
                </p>
                
                <p class= "bordered">
                    <i class="fas fa-bullseye"></i> 
                    <strong>Objectifs :</strong> Un aperçu des objectifs à long terme et de la vision de l'entreprise.
                </p>
            </div>
        </div>

        <!-- Produits et Services -->
        <div class="text-center mb-4">
            <h2 class="bg-gradient p-3 rounded shadow mt-5">
                Produits et Services
            </h2>
        </div>

        <div class="card shadow-lg border-0">
            <div class="card-body bg-white rounded">
                <p class= "bordered">
                    <i class="fas fa-box-open"></i> 
                    <strong>Description des produits :</strong> Un résumé des produits ou services offerts par l'entreprise.
                </p>
                <a href="#" class="btn btn-primary">Télécharger le catalogue</a>
            </div>
        </div>

        <!-- Localisation -->
        <div class="text-center mb-4">
            <h2 class="bg-gradient p-3 rounded shadow mt-5">
                Localisation
            </h2>
        </div>

        <div class="card shadow-lg border-0">
            <div class="card-body bg-white rounded">
                <p class= "bordered">
                    <i class="fas fa-map"></i> 
                    <strong>Ma Carte :</strong>
                </p>

                <div id="map"></div><br>

                <p class= "bordered">
                    <i class="fas fa-clock"></i> 
                    <strong>Heures d'ouverture :</strong> Lundi - Vendredi, 9h - 17h
                </p>
            </div>
        </div>

        <!-- Contact et réseaux sociaux -->
        <div class="text-center mb-4">
            <h2 class="bg-gradient p-3 rounded shadow mt-5">
                Contact et Réseaux Sociaux
            </h2>
        </div>

        <div class="card shadow-lg border-0">
            <div class="card-body bg-white rounded">
                <p class= "bordered">
                    <i class="fas fa-phone-alt phone-icon"></i> 
                    <strong>Service Client :</strong> +123 456 789
                </p>

                <p class= "bordered">
                    <i class="fab fa-facebook facebook-icon"></i> 
                    <strong>Facebook :</strong> <a href="#">facebook.com/entreprise</a>
                </p>

                <p class= "bordered">
                    <i class="fab fa-twitter twitter-icon"></i> 
                    <strong>Twitter :</strong> <a href="#">@entreprise</a>
                </p>

                <p class= "bordered">
                    <i class="fab fa-whatsapp whatsapp-icon"></i> 
                    <strong>Whatsapp :</strong> <a href="https://wa.me/57136115">+229 57 13 61 15</a>
                </p>
            </div>
        </div>

    </section>
    
    <?php
        include("../footer/pied_de_page.php");
    ?>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text)
                .then(() => alert('Copié dans le presse-papiers'))
                .catch(err => console.error('Échec de la copie : ', err));
        }
    </script>

    <script>
        function initMap() {
            // Spécifie la localisation de l'entreprise (par exemple, Paris, France)
            const entrepriseLocation = { lat: 48.8566, lng: 2.3522 };
            
            // Crée la carte, centrée sur la localisation de l'entreprise
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 12,
                center: entrepriseLocation,
            });
            
            // Place un marqueur sur la localisation
            const marker = new google.maps.Marker({
                position: entrepriseLocation,
                map: map,
                title: "Localisation de l'entreprise",
            });
        }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script>
</body>
</html>