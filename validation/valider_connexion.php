<?php
    // Activer l'affichage des erreurs
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start(); //Initialiser la session

    include("../connexion.php");

    $message_input = "";
    $message_login = "";
    $message_success = "";
    
    if(isset($_POST['valider']))
    {
        $nom = $_POST['s_name'];
        $mot_de_passe = $_POST['s_motdepasse'];
        if(empty($nom)||empty($mdp))
        {
            $message_input = "Veuillez remplir tous les champs";

            // Stocker les messages dans la session
            $_SESSION['message_input'] = $message_input;

            header("location: ../index.php");
            exit();
        }
        else
        {
            $req = "SELECT * FROM entreprise WHERE nomEntreprise = '$nom' AND motdepasse = '$mdp'";
            $reponse = $bdd -> query($req);
            $donnee = $reponse -> fetchAll();
            
            if(!$donnee)
            {
                $message_login = "Paramètre de connexion invalide";

                // Stocker les messages dans la session
                $_SESSION['message_login'] = $message_login;
                
                header("location: ../index.php");
                exit();
            }
            else
            {
                // Connexion réussie
                $message_success = "Connexion réussie avec succès!";

                $_SESSION['logged_in'] = true;
                $_SESSION['user_name'] = $nom; //stockage du nom de l'utilisateur
                $_SESSION['message_success'] = $message_success;

                header("location: ../index.php");
                exit();
            }
        }
    }
?>