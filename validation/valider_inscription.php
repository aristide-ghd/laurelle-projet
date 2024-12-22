<?php
    // Activer l'affichage des erreurs
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start(); // Initialiser la session
    session_regenerate_id(true); // Regenere l'id de session pour plus de securité

    include("../sign_in.php"); // Connexion a la base de donnée

    include("../db_connected_verify.php"); // Vérification de la connexion à la base de données


    if(isset($_POST['valider']))
    {
        // Recuperation de données du formulaire 
        $email_business = $_POST['s_email_business'];
        $nom_entreprise = $_POST['s_nom_entreprise'];
        $nom_utilisateur = $_POST['s_nom_utilisateur'];
        $password = $_POST['s_password'];
        $password_confirm = $_POST['s_password_confirm'];

        // Verification si les champs sont remplis
        if(empty($email_business) || empty($nom_entreprise) || empty($nom_utilisateur) || empty($password) || empty($password_confirm))
        {
            // Stocker les messages dans la session
            $_SESSION['message_input'] = "Veuillez remplir tous les champs";
        }
        else
        {
            // Verification de la validité de l'email
            if(!filter_var($email_business, FILTER_VALIDATE_EMAIL)) 
            {
                // Stocker les messages dans la session
                $_SESSION['message_email'] = "Adresse email invalide";
            }
            else
            {
                // Verification si les mots de passe correspondent
                if($password !== $password_confirm)
                {
                    // Stocker les messages dans la session
                    $_SESSION['message_password'] = "Les mots de passe ne correspondent pas";
                }
                else
                {
                    // Vérification si l'entreprise existe déjà
                    $req = "SELECT * FROM entreprise WHERE nom_entreprise = :nom_entreprise ";
                    $stmt = $bdd -> prepare($req);
                    $stmt -> execute(['nom_entreprise' => $nom_entreprise]);
                    $donnee = $stmt -> fetch();

                    if($donnee)
                    {
                        // Stocker les messages dans la session
                        $_SESSION['message_entreprise']  = "Cette entreprise existe déjà";
                    }
                    else
                    {
                        // Cryptage du mot de passe
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                        // Insertion dans la base de données
                        $req1 = "INSERT INTO entreprise VALUES (:id_entreprise, :email_business, :nom_entreprise, :nom_utilisateur, :mot_de_passe)";
                        $stmt = $bdd -> prepare($req1);
                        $stmt -> execute([
                            'id_entreprise' => 0,
                            'email_business' => $email_business,
                            'nom_entreprise' => $nom_entreprise,
                            'nom_utilisateur' => $nom_utilisateur,
                            'mot_de_passe' => $hashed_password
                        ]);

                        // Stocker les messages dans la session
                        $_SESSION['message_register'] = "Inscription réussie. Vous serez redirigé vers la page de connexion dans quelques instants";
                    }
                }
            }
        }

        // Redirection après enregistrements des informations 
        header("location: ../dashbord/inscription.php");
        exit();
    }
?>
