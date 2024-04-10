<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        .welcome-section {
            height: 400px; /* Ajustez la hauteur selon vos besoins */
            background-color: #f8f9fa; /* Couleur de fond */
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .welcome-section h1 {
            font-size: 2.5rem; /* Taille de police */
        }

        .welcome-section p {
            font-size: 1.25rem; /* Taille de police */
            margin-bottom: 20px; /* Marge basse */
        }

        .welcome-section .btn {
            font-size: 1.25rem; /* Taille de police */
        }
    </style>
    <title>Homechip's Laure</title>
</head>
<body>
    <?php include 'navbar/navbar.php'; ?>
    <section class="welcome-section">
        <div class="container">
            <h1>Bienvenue à Homechip's Laure</h1>
            <p>Ceci est une introduction à votre site ou votre application. Vous pouvez présenter brièvement ce que propose votre projet.</p>
            <a href="#" class="btn btn-danger">Commencer</a>
        </div>
    </section>

    <section class="content-section">
        <div class="container">
            <!-- Ajoutez le contenu spécifique à la page d'accueil ici -->
        </div>
    </section>
    
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">Copyright © 2024 Homechip's Laure | Tous droits réservés.
            Design by: <a href="https://ari-luxury.com">Ari-Luxury</a></span>
        </div>
    </footer>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjO3uiV7A9TL7MwHNBW9R+Ep2T4klo7YwGI5Os/qGIlDQ2hF5V1dE7" crossorigin="anonymous"></script>
</body>
</html>
