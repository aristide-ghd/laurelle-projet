<?php
    include("connexion.php");
    $message = "";
    
    if(isset($_POST['valider']))
    {
        $nom = $_POST['s_name'];
        $mdp = $_POST['s_motdepasse'];
        if(empty($nom)||empty($mdp))
        {
            $message = "Veuillez remplir tous les champs";
        }
        else
        {
            $req = "SELECT * FROM entreprise WHERE namebusiness = '$nom' AND motdepasse = '$mdp'";
            $reponse = $bdd -> query($req);
            $donnee = $reponse -> fetchAll();
            
            if(!$donnee)
            {
                $message = "Paramètre de connexion invalide";
            }
            else
            {
                header("location:home.php");
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Page de connexion</title>
</head>
<body class="bg-secondary">
    <div id="deuxblocs" class="container d-lg-flex d-md-block d-sm-block mt-5 my-md-4 py-lg-5 py-md-0 my-sm-4">
        <div class="w-50 mx-md-auto mx-sm-auto first">
            <img class="img-fluid image_achat rounded-0" src="image/connect.jpg" alt="">
        </div>
        <div class="infos w-50 mx-md-auto mx-sm-auto rounded-0">
            <br>
            <h2 class="text-danger mb-4">Connectez-vous</h2>
            <form action="index.php" method="post">
                <?php
                    echo $message;
                ?>
                <fieldset>
                    <label for="nom">Nom de l'entreprise:</label><br>
                    <input class="form-control-sm" type="text" name="s_name" id="nom" ><br>
                    <br>
                    <label for="password">Mot de passe:</label><br>
                    <input class="form-control-sm" type="password" name="s_motdepasse" id="motdepasse" >
                </fieldset><br>
                <button class="btn btn-danger btn-sm col-12 mb-md-5 mb-sm-5" type="submit" name="valider">Se connecter</button>
                <br>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>