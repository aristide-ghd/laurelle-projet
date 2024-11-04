<?php 
    // Activer l'affichage des erreurs
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include("../session_start_verify.php"); // Fichier pour verifier la connexion_user avec la session

    $id_entreprise = $_SESSION['id_entreprise']; // Recupération d'id de lentreprise dans la session

    include('../connexion.php'); // Connexion a la base de donnée

    include("../db_connected_verify.php"); // Vérification de la connexion à la base de données


    // -----------------------NOM ET PRENOM ------------------------------------------
    if (isset($_POST['submit_identity']))
    {
        // Récupération des données du formulaire
        // Utilisation de trim pour eliminer les espaces inutiles dans les entrées
        $firstname = trim($_POST['s_firstname']);
        $lastname = trim($_POST['s_lastname']);

        // Vérification que les champs ne sont pas vides
        if (empty($firstname) || empty($lastname))
        {
            // Stocke le message dans la session
            $_SESSION['message_identity_input'] = "Veuillez remplir tous les champs";
        }
        else
        {
            // Requête pour mettre à jour les informations de l'entreprise
            $req = "UPDATE entreprise SET Nom = :nom, Prenom = :prenom WHERE id_entreprise = :id_entreprise ";
            $stmt = $bdd -> prepare($req);
            $stmt -> bindParam(':nom', $lastname, PDO::PARAM_STR);
            $stmt -> bindParam(':prenom', $firstname, PDO::PARAM_STR);
            $stmt -> bindParam(':id_entreprise', $id_entreprise, PDO::PARAM_INT);
            
            if ($stmt -> execute())
            {
                // Stocke le message dans la session
                $_SESSION['message_identity_success'] = "Modification effectuée avec succès. Veuillez patientez pendant que nous vous redirigeons";
            }
            else
            {
                // Stocke le message dans la session
                $_SESSION['message_identity_error'] = "Echec de modification";
            }
        }

        // Redirection
        header ("location: ../modif_infos_entreprise/identity.php");
        exit();
    }

    // ----------------------------- EMAIL -----------------------------------------
    if(isset($_POST['submit_email']))
    {
        // Récupération des données du formulaire
        // Utilisation de trim pour eliminer les espaces inutiles dans les entrées
        $email = trim($_POST['s_email']);

        // Vérification que les champs ne sont pas vides
        if (empty($email))
        {
            // Stocke le message dans la session
            $_SESSION['message_email_input'] = "Veuillez remplir le champ";
        }
        else
        {
            // Validation de l'email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
                // Stocke le message dans la sessio
                $_SESSION['message_email_validate'] = "Format d'email invalide";
            }
            else
            {
                // Requête pour mettre à jour les informations de l'entreprise
                $req = "UPDATE entreprise SET Email = :email WHERE id_entreprise = :id_entreprise ";
                $stmt = $bdd -> prepare($req);
                $stmt -> bindParam(':email', $email, PDO::PARAM_STR);
                $stmt -> bindParam(':id_entreprise', $id_entreprise, PDO::PARAM_INT);

                if ($stmt -> execute())
                {
                    // Stocke le message dans la session
                    $_SESSION['message_email_success'] = "Modification effectuée avec succès. Veuillez patientez pendant que nous vous redirigeons";
                }
                else
                {
                    // Stocke le message dans la session
                    $_SESSION['message_email_error'] = "Echec de modification";
                }
            }
        }

        // Redirection
        header("location: ../modif_infos_entreprise/email.php");
        exit();
    }

    // ---------------------------- TELEPHONE ----------------------------------------
    if(isset($_POST['submit_phone']))
    {
        // Récupération des données du formulaire
        // Utilisation de trim pour eliminer les espaces inutiles dans les entrées
        $telephone = trim($_POST['s_phone']); 

        // Vérification que les champs ne sont pas vides
        if (empty($telephone))
        {
            // Stocke le message dans la session
            $_SESSION['message_phone_input'] = "Veuillez remplir le champ";
        }
        else
        {
            // Requête pour mettre à jour les informations de l'entreprise
            $req = "UPDATE entreprise SET Telephone = :telephone WHERE id_entreprise = :id_entreprise ";
            $stmt = $bdd -> prepare($req);
            $stmt -> bindParam(':telephone', $telephone, PDO::PARAM_STR);
            $stmt -> bindParam(':id_entreprise', $id_entreprise, PDO::PARAM_INT);

            if ($stmt -> execute())
            {
                // Stocke le message dans la session
                $_SESSION['message_phone_success'] = "Modification effectuée avec succès. Veuillez patientez pendant que nous vous redirigeons";
            }
            else
            {
                // Stocke le message dans la session
                $_SESSION['message_phone_error'] = "Echec de modification";
            }
        }

        // Redirection
        header("location: ../modif_infos_entreprise/phone.php");
        exit();
    }

    // -------------------------- PAYS ------------------------------------------------
    if(isset($_POST['submit_country']))
    {
        // Récupération des données du formulaire
        // Utilisation de trim pour eliminer les espaces inutiles dans les entrées
        $country = trim($_POST['s_country']);

        // Vérification que les champs ne sont pas vides
        if (empty($country))
        {
            // Stocke le message dans la session
            $_SESSION['message_country_input'] = "Veuillez remplir le champ";
        }
        else
        {
            // Requête pour mettre à jour les informations de l'entreprise
            $req = "UPDATE entreprise SET Pays = :pays WHERE id_entreprise = :id_entreprise ";
            $stmt = $bdd -> prepare($req);
            $stmt -> bindParam(':pays', $country, PDO::PARAM_STR);
            $stmt -> bindParam(':id_entreprise', $id_entreprise, PDO::PARAM_INT);

            if ($stmt -> execute())
            {
                // Stocke le message dans la session
                $_SESSION['message_country_success'] = "Modification effectuée avec succès. Veuillez patientez pendant que nous vous redirigeons";
            }
            else
            {
                // Stocke le message dans la session
                $_SESSION['message_country_error'] = "Echec de modification";
            }
        }

        // Redirection
        header("location: ../modif_infos_entreprise/country.php");
        exit();
    }

    // --------------------------- NOM DE L'ENTREPRISE -----------------------------------
    if(isset($_POST['submit_name_entreprise']))
    {
        // Récupération des données du formulaire
        // Utilisation de trim pour eliminer les espaces inutiles dans les entrées
        $nom_entreprise = trim($_POST['s_nom_entreprise']);

        // Vérification que les champs ne sont pas vides
        if (empty($nom_entreprise))
        {
            // Stocke le message dans la session
            $_SESSION['message_name_entreprise_input'] = "Veuillez remplir le champ";
        }
        else
        {
            // Requête pour mettre à jour les informations de l'entreprise
            $req = "UPDATE entreprise SET nomEntreprise = :nomEntreprise WHERE id_entreprise = :id_entreprise ";
            $stmt = $bdd -> prepare($req);
            $stmt -> bindParam(':nomEntreprise', $nom_entreprise, PDO::PARAM_STR);
            $stmt -> bindParam(':id_entreprise', $id_entreprise, PDO::PARAM_INT);

            if ($stmt -> execute())
            {
                // Stocke le message dans la session
                $_SESSION['message_name_entreprise_success'] = "Modification effectuée avec succès. Veuillez patientez pendant que nous vous redirigeons";
            }
            else
            {
                // Stocke le message dans la session
                $_SESSION['message_name_entreprise_error'] = "Echec de modification";
            }
        }

        // Redirection
        header("location: ../modif_infos_entreprise/name_enterprise.php");
        exit();
    }
        
    // ------------------------ TYPE DE PRODUIT ------------------------------------------
    if(isset($_POST['submit_name_produit']))
    {
        // Récupération des données du formulaire
        // Utilisation de trim pour eliminer les espaces inutiles dans les entrées
        $produit = trim($_POST['s_produit']);

        // Vérification que les champs ne sont pas vides
        if (empty($produit))
        {
            // Stocke le message dans la session
            $_SESSION['message_name_produit_input'] = "Veuillez remplir le champ";
        }
        else
        {
            // Requête pour mettre à jour les informations de l'entreprise
            $req = "UPDATE entreprise SET Produit = :produit WHERE id_entreprise = :id_entreprise ";
            $stmt = $bdd -> prepare($req);
            $stmt -> bindParam(':produit', $produit, PDO::PARAM_STR);
            $stmt -> bindParam(':id_entreprise', $id_entreprise, PDO::PARAM_INT);

            if ($stmt -> execute())
            {
                // Stocke le message dans la session
                $_SESSION['message_name_produit_success'] = "Modification effectuée avec succès. Veuillez patientez pendant que nous vous redirigeons";
            }
            else
            {   
                // Stocke le message dans la session
                $_SESSION['message_name_produit_error'] = "Echec de modification";
            }
        }

        // Redirection
        header("location: ../modif_infos_entreprise/name_produit.php");
        exit();
    }

    // ------------------------------ADRESSE DE L'ENTREPRISE -------------------------------
    if(isset($_POST['submit_adresse_entreprise']))
    {
        // Récupération des données du formulaire
        // Utilisation de trim pour eliminer les espaces inutiles dans les entrées
        $adresse_entreprise = trim($_POST['s_adresse_entreprise']);

        // Vérification que les champs ne sont pas vides
        if (empty($adresse_entreprise))
        {
            // Stocke le message dans la session
            $_SESSION['message_address_entreprise_input'] = "Veuillez remplir le champ";
        }
        else
        {
            // Requête pour mettre à jour les informations de l'entreprise
            $req = "UPDATE entreprise SET adresseEntreprise = :adresseEntreprise WHERE id_entreprise = :id_entreprise ";
            $stmt = $bdd -> prepare($req);
            $stmt -> bindParam(':adresseEntreprise', $adresse_entreprise, PDO::PARAM_STR);
            $stmt -> bindParam(':id_entreprise', $id_entreprise, PDO::PARAM_INT);

            if ($stmt -> execute())
            {
                // Stocke le message dans la session
                $_SESSION['message_address_entreprise_success'] = "Modification effectuée avec succès. Veuillez patientez pendant que nous vous redirigeons";
            }
            else
            {
                // Stocke le message dans la session
                $_SESSION['message_address_entreprise_error'] = "Echec de modification";
            }
        }

        // Redirection
        header("location: ../modif_infos_entreprise/address_enterprise.php");
        exit();
    }
?>