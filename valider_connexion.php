<?php
    include("connexion.php");
    $nom = $_POST['s_name'];
    $mdp = $_POST['s_motdepasse'];
    $message = "";

    
        if(empty($email)||empty($mdp))
        {
            $message = "Veuillez remplir les champs";
        }
        else
        {
            $req = "SELECT * FROM entreprise WHERE namebusiness = '$nom' AND motdepasse = '$mdp'";
            $reponse = $bdd -> query($req);
            $donnee = $reponse -> fecthAll();
            
            if(!$donnee)
            {
                $message = "Paramètre de connexion invalide";
            }
            else
            {
                header('location:home.html');
            }
        }
?>