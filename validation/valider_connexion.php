<?php
    // Activer l'affichage des erreurs
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start(); // Initialiser la session
    session_regenerate_id(true); // Regenere l'id de session pour plus de securité

    include("../connexion.php"); // Connexion a la base de donnée


    if (isset($_POST['valider'])) 
    {
        //Utilisation de trim pour eliminer les espaces inutiles dans les entrées
        $nom_entreprise = trim($_POST['s_name']);
        $mot_de_passe = trim($_POST['s_motdepasse']);
        
        if (empty($nom_entreprise) || empty($mot_de_passe)) 
        {
            //Stocker les messages dans la session 
            $_SESSION['message_input'] = "Veuillez remplir tous les champs";
        } 
        else 
        {
            // Préparation de la requête pour obtenir le mot de passe haché
            $req = $bdd -> prepare("SELECT id_entreprise, motDePasse FROM entreprise WHERE nomEntreprise = :nomEntreprise");

            //Utilisation de la methode bindParams() pour securiser la requete SQL  
            $req -> bindParam(':nomEntreprise', $nom_entreprise, PDO::PARAM_STR);
            $req -> execute();

            $donnee = $req->fetch(PDO::FETCH_ASSOC);

            // Vérification si l'entreprise existe et si le mot de passe est correct
            if ($donnee && password_verify($mot_de_passe, $donnee['motDePasse'])) //Comparaison du mot de passe saisi et celui haché
            {
                $_SESSION['logged_in'] = true;

                //Stocke le mot de passe dans la session
                $_SESSION['motDePasse'] = $donnee['motDePasse'];

                //Stocke l'id de l'entreprise dans la session
                $_SESSION['id_entreprise'] = $donnee['id_entreprise'];

                //Stocker les messages dans la session
                $_SESSION['message_success'] = "Connexion réussie avec succès! Veuillez patienter quelques instants.";
            } 
            else 
            {
                //Stocker les messages dans la session
                $_SESSION['message_login'] = "Paramètres de connexion invalide";
            }
        }

        //Redirection
        header("location: ../index.php");
        exit();
    }
?>