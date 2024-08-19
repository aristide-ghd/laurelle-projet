<?php
    include("connexion.php");
    $nom = $_POST['s_name'];
    $mdp = $_POST['s_motdepasse'];
    $message = "";

    if(isset($_POST['valider']))
    {
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
    <title>Page de connexion</title>
</head>
<body>
    <div id="deuxblocs" >
        <div style="background-image: url(image/connect.jpg);" class="image_achat"></div>
        <div class="infos">
            <h2>Connectez-vous</h2>
            <form action="index.php" method="post">
                <p>
                    <?php
                        echo $message;
                    ?>
                </p>
                <fieldset>
                    <label for="nom">Nom de l'entreprise:</label><br>
                    <input type="text" name="s_name" id="nom" ><br>
                    <br>
                    <label for="password">Mot de passe:</label><br>
                    <input type="password" name="s_motdepasse" id="motdepasse" >
                </fieldset><br>
                <br>
                <button type="submit" name="valider" >Se connecter</button>
            </form>
        </div>
    </div>
</body>
</html>