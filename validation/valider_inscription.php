<?php
    session_start(); //Initialiser la session 
    include("connexion.php");
    $message = "";

    if(isset($_POST['valider']))
    {
        $nom = $_POST['s_name'];
        $mdp = $_POST['s_motdepasse'];
        $email = $_POST['s_email'];

        if(empty($nom) || empty($mdp) || empty($email))
        {
            $message = "Veuillez remplir tous les champs";
        }
        else
        {
            // Vérification si l'utilisateur existe déjà
            $req = "SELECT * FROM entreprise WHERE namebusiness = '$nom' AND email = '$email'";
            $reponse = $bdd -> query($req);
            $donnee = $reponse -> fetchAll();

            if($donnee)
            {
                $message = "L'utilisateur existe déjà";
            }
            else
            {
                // Cryptage du mot de passe
                $hashed_password = password_hash($mdp, PASSWORD_DEFAULT);

                // Insertion dans la base de données
                $req = "INSERT INTO entreprise (namebusiness, motdepasse, email) VALUES ('$nom', '$hashed_password', '$email')";
                $bdd -> exec($req);

                $message = "Inscription réussie !";

                // Stocker le message d'erreur dans la session
                $_SESSION['message'] = $message;
                header("location: ../index.php");
            }
        }
    }
?>
