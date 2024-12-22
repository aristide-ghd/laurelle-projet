<?php 
    // Activer l'affichage des erreurs
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include("../session_start_verify.php"); // Fichier pour verifier la connexion_user avec la session

    $motDePasse = $_SESSION['motDePasse']; // Recuperation du mot de passe dentreprise dans la session
    $id_entreprise = $_SESSION['id_entreprise']; // Recuperation d'id de lentreprise dans la session

    include("../sign_in.php"); // Connexion a la base de donnée

    include("../db_connected_verify.php"); // Vérification de la connexion à la base de données


    // Condition a la soumission du formulaire
    if(isset($_POST['submit_keyword']))
    {
        // Recuperation des données via le formulaire
        // Utilisation de trim pour eliminer les espaces inutiles dans les entrées
        $current_password = trim($_POST['s_current_password']);
        $new_password = trim($_POST['s_new_password']);
        $confirm_password = trim($_POST['s_confirm_password']);

        //Vérification si les champs ne sont pas vides
        if (empty($current_password) || empty($new_password) || empty($confirm_password))
        {
            // Stocker le message dans la session
            $_SESSION['message_keyword_input'] = "Veuillez remplir tous les champs.";
        }
        else
        {
            // Requete pour utiliser le mot de passe stocké dans la base de donnée en fonction de l'id de lentreprise
            $query = "SELECT mot_de_passe FROM entreprise WHERE id_entreprise = :id_entreprise";
            $stmt = $bdd -> prepare($query);
            $stmt -> bindParam(':id_entreprise', $id_entreprise, PDO::PARAM_INT);
            $stmt -> execute();
            $donnee = $stmt -> fetch(PDO::FETCH_ASSOC);

            // Vérification si le mot de passe actuel est incorrect
            if (!password_verify($current_password, $donnee['motDePasse']))
            {
                // Stocker le message dans la session
                $_SESSION['message_keyword_current'] = "Votre mot de passe actuel est incorrect.";
            }
            else
            {
                // Verification si les nouveaux mots de passe sont identiques
                if($new_password != $confirm_password)
                {
                    // Stocker le message dans la session
                    $_SESSION['message_keyword_same'] = "Les mots de passe nouvellement définis ne correspondent pas.";
                }
                else
                {
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                    // Requête pour mettre à jour le mot de passe dans la base de données
                    $req = "UPDATE entreprise SET mot_de_passe = :hashed_password WHERE id_entreprise = :id_entreprise";
                    $stmt = $bdd -> prepare($req);
                    $stmt -> bindParam(':hashed_password', $hashed_password, PDO::PARAM_STR);
                    $stmt -> bindParam(':id_entreprise', $id_entreprise, PDO::PARAM_INT);

                    if($stmt -> execute())
                    {
                        // Stocker le message dans la session
                        $_SESSION['message_keyword_success'] = "Votre mot de passe a été mis a jour avec succès.";
                    }
                    else
                    {
                        // Stocker le message dans la session
                        $_SESSION['message_keyword_fail'] = "Echec de modification du mot de passe";
                    }
                }
            }
        }

        // Redirection
        header("location: ../profile/settings.php");
        exit();
    }
?>