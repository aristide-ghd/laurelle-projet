<?php 
    // Activer l'affichage des erreurs
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start(); //Initialiser la session

    // Vérification si l'utilisateur est connecté
    if(!isset($_SESSION['logged_in'])) {
        // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
        header("Location: ../index.php");
        exit;
    }

    $motDePasse = $_SESSION['motDePasse']; // Recuperation du mot de passe dentreprise dans la session
    $id_entreprise = $_SESSION['id_entreprise']; // Recuperation d'id de lentreprise dans la session

    include("../connexion.php"); // Connexion a la base de donnée

    // Déclaration des messages a afficher
    $message_keyword_input = "";
    $message_keyword_current = "";
    $message_keyword_same = "";
    $message_keyword_success = "";

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
            $message_keyword_input = "Veuillez remplir tous les champs.";

            // Stocker le message dans la session
            $_SESSION['message_keyword_input'] = $message_keyword_input;

            // Redirection
            header("location: ../profile/settings.php");
            exit();
        }
        else
        {
            // Requete pour utiliser le mot de passe stocké dans la base de donnée en fonction de l'id de lentreprise
            $query = "SELECT motDePasse FROM entreprise WHERE id_entreprise = :id_entreprise";
            $stmt = $bdd -> prepare($query);
            $stmt -> bindParam(':id_entreprise', $id_entreprise, PDO::PARAM_INT);
            $stmt -> execute();
            $donnee = $stmt -> fetch(PDO::FETCH_ASSOC);

            // Vérification si le mot de passe actuel est incorrect
            if (!password_verify($current_password, $donnee['motDePasse']))
            {
                $message_keyword_current = "Votre mot de passe actuel est incorrect.";

                // Stocker le message dans la session
                $_SESSION['message_keyword_current'] = $message_keyword_current;

                // Redirection
                header("location: ../profile/settings.php");
                exit();
            }
            else
            {
                // Verification si les nouveaux mots de passe sont identiques
                if($new_password != $confirm_password)
                {
                    $message_keyword_same = "Les mots de passe nouvellement définis ne correspondent pas.";

                    // Stocker le message dans la session
                    $_SESSION['message_keyword_same'] = $message_keyword_same;

                    // Redirection
                    header("location: ../profile/settings.php");
                    exit();
                }
                else
                {
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                    // Requete pour enregistrer le nouveau mot de passe dans la base de donnée
                    $req = "UPDATE entreprise
                    SET motDePasse = '$hashed_password'
                    WHERE id_entreprise = '$id_entreprise' ";

                    if($bdd -> query($req) == true)
                    {
                        $message_keyword_success = "Votre mot de passe a été mis a jour avec succès.";

                        // Stocker le message dans la session
                        $_SESSION['message_keyword_success'] = $message_keyword_success;

                        // Redirection
                        header("location: ../profile/settings.php");
                        exit();
                    }
                    else
                    {
                        $message_keyword_fail = "Echec de modification du mot de passe";

                        // Stocker le message dans la session
                        $_SESSION['message_keyword_fail'] = $message_keyword_fail;

                        // Redirection
                        header("location: ../profile/settings.php");
                        exit();
                    }
                }
            }
        }
    }
?>