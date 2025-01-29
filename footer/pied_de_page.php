<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pied de page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        @media only screen and (max-width: 576px) {

        }
        footer div a{
            color: white;
            text-decoration: none;
        }
        footer div a:hover{
            text-decoration: underline;
            color: white;
        }
    </style>
</head>
<body>
    <footer class="text-center bg-dark text-white pt-3 pb-2 d-lg-flex d-md-block justify-content-around">
        <div>
            <p>&copy; <?php echo date("Y"); ?> Homechip's Laure. Tous droits réservés.</p>
        </div>
        <div>
            <p>Contactez-nous : <a href="mailto:info@aquafarm.com">info@homelaurechip.com</a></p>
        </div>
        <div>
            <a href="https://web.facebook.com/profile.php?id=61554966975796" target="_blank">Facebook</a> |
            <a href="https://www.twitter.com/" target="_blank">Twitter</a> |
            <a href="https://www.instagram.com/" target="_blank">Instagram</a>
        </div>
        <div>
            <p>
                <a href="../règlements/terms_of_service.php">Conditions d'utilisation</a> | 
                <a href="../règlements/privacy_policy.php">Politique de confidentialité</a>
            </p>
        </div>
    </footer>
</body>
</html>