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

    $id_entreprise = $_SESSION['id_entreprise']; // Recupération d'id de lentreprise dans la session

    include('../connexion.php'); // Connexion a la base de donnée

    // Declaration des variables pour les messages a afficher
    $message_identity_input = "";                               
    $message_email_input = "";                                       
    $message_phone_input = "";                                    
    $message_country_input = "";                                  
    $message_name_entreprise_input = "";                 
    $message_name_produit_input = "";                        
    $message_address_entreprise_input = "";           

    $message_identity_success = ""; 
    $message_email_success = "";
    $message_phone_success = ""; 
    $message_country_success = "";
    $message_name_entreprise_success = ""; 
    $message_name_produit_success = "";
    $message_address_entreprise_success = "";

    $message_identity_error = ""; 
    $message_email_error = "";
    $message_phone_error = "";
    $message_country_error = "";
    $message_name_entreprise_error = "";
    $message_name_produit_error = "";
    $message_address_entreprise_error = "";

    // -----------------------NOM ET PRENOM ------------------------------------------
    if(isset($_POST['submit_identity']))
    {
        // Récupération des données du formulaire
        // Utilisation de trim pour eliminer les espaces inutiles dans les entrées
        $firstname = trim($_POST['s_firstname']);
        $lastname = trim($_POST['s_lastname']);

        // Vérification que les champs ne sont pas vides
        if (empty($firstname) || empty($lastname))
        {
            $message_identity_input = "Veuillez remplir tous les champs";

            // Stocke le message dans la session
            $_SESSION['message_identity_input'] = $message_identity_input;

            // Redirection
            header("location: ../modif_infos_entreprise/identity.php");
            exit();
        }
        else
        {
            // Requête pour mettre à jour les informations de l'entreprise
            $req = "UPDATE entreprise
            SET Nom = '$lastname', Prenom = '$firstname'
            WHERE id_entreprise = '$id_entreprise' ";
            
            if ($bdd -> query($req) == true)
            {
                $message_identity_success = "Modification effectuée avec succès. Veuillez patientez pendant que nous vous redirigeons";

                // Stocke le message dans la session
                $_SESSION['message_identity_success'] = $message_identity_success;

                // Redirection
                header ("location: ../modif_infos_entreprise/identity.php");
                exit();
            }
            else
            {
                $message_identity_error = "Echec de modification";
                
                // Stocke le message dans la session
                $_SESSION['message_identity_error'] = $message_identity_error;

                // Redirection
                header ("location: ../modif_infos_entreprise/identity.php");
                exit();
            }
        }
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
            $message_email_input = "Veuillez remplir le champ";

            // Stocke le message dans la session
            $_SESSION['message_email_input'] = $message_email_input;

            // Redirection
            header("location: ../modif_infos_entreprise/email.php");
            exit();
        }
        else
        {
            // Requête pour mettre à jour les informations de l'entreprise
            $req1 = "UPDATE entreprise
            SET Email = '$email'
            WHERE id_entreprise = '$id_entreprise' ";

            if ($bdd -> query($req1) == true)
            {
                $message_email_success = "Modification effectuée avec succès. Veuillez patientez pendant que nous vous redirigeons";

                // Stocke le message dans la session
                $_SESSION['message_email_success'] = $message_email_success;

                // Redirection
                header ("location: ../modif_infos_entreprise/email.php");
                exit();
            }
            else
            {
                $message_email_error = "Echec de modification";
                
                // Stocke le message dans la session
                $_SESSION['message_email_error'] = $message_email_error;

                // Redirection
                header ("location: ../modif_infos_entreprise/email.php");
                exit();
            }
        }
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
            $message_phone_input = "Veuillez remplir le champ";

            // Stocke le message dans la session
            $_SESSION['message_phone_input'] = $message_phone_input;

            // Redirection
            header("location: ../modif_infos_entreprise/phone.php");
            exit();
        }
        else
        {
            // Requête pour mettre à jour les informations de l'entreprise
            $req2 = "UPDATE entreprise
            SET Telephone = '$telephone'
            WHERE id_entreprise = '$id_entreprise' ";

            if ($bdd -> query($req2) == true)
            {
                $message_phone_success = "Modification effectuée avec succès. Veuillez patientez pendant que nous vous redirigeons";

                // Stocke le message dans la session
                $_SESSION['message_phone_success'] = $message_phone_success;

                // Redirection
                header("location: ../modif_infos_entreprise/phone.php");
                exit();
            }
            else
            {
                $message_phone_error = "Echec de modification";
                
                // Stocke le message dans la session
                $_SESSION['message_phone_error'] = $message_phone_error;

                // Redirection
                header ("location: ../modif_infos_entreprise/phone.php");
                exit();
            }
        }
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
            $message_country_input = "Veuillez remplir le champ";

            // Stocke le message dans la session
            $_SESSION['message_country_input'] = $message_country_input;

            // Redirection
            header("location: ../modif_infos_entreprise/country.php");
            exit();
        }
        else
        {
            // Requête pour mettre à jour les informations de l'entreprise
            $req3 = "UPDATE entreprise
            SET Pays = '$country'
            WHERE id_entreprise = '$id_entreprise' ";

            if ($bdd -> query($req3) == true)
            {
                $message_country_success = "Modification effectuée avec succès. Veuillez patientez pendant que nous vous redirigeons";

                // Stocke le message dans la session
                $_SESSION['message_country_success'] = $message_country_success;

                // Redirection
                header("location: ../modif_infos_entreprise/country.php");
                exit();
            }
            else
            {
                $message_country_error = "Echec de modification";
                
                // Stocke le message dans la session
                $_SESSION['message_country_error'] = $message_country_error;

                // Redirection
                header ("location: ../modif_infos_entreprise/country.php");
                exit();
            }
        }
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
            $message_name_entreprise_input = "Veuillez remplir le champ";

            // Stocke le message dans la session
            $_SESSION['message_name_entreprise_input'] = $message_name_entreprise_input;

            // Redirection
            header("location: ../modif_infos_entreprise/name_enterprise.php");
            exit();
        }
        else
        {
            // Requête pour mettre à jour les informations de l'entreprise
            $req4 = "UPDATE entreprise
            SET nomEntreprise = '$nom_entreprise'
            WHERE id_entreprise = '$id_entreprise' ";

            if ($bdd -> query($req4) == true)
            {
                $message_name_entreprise_success = "Modification effectuée avec succès. Veuillez patientez pendant que nous vous redirigeons";

                // Stocke le message dans la session
                $_SESSION['message_name_entreprise_success'] = $message_name_entreprise_success;

                // Redirection
                header("location: ../modif_infos_entreprise/name_enterprise.php");
                exit();
            }
            else
            {
                $message_name_entreprise_error = "Echec de modification";
                
                // Stocke le message dans la session
                $_SESSION['message_name_entreprise_error'] = $message_name_entreprise_error;

                // Redirection
                header ("location: ../modif_infos_entreprise/name_enterprise.php");
                exit();
            }
        }
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
            $message_name_produit_input = "Veuillez remplir le champ";

            // Stocke le message dans la session
            $_SESSION['message_name_produit_input'] = $message_name_produit_input;

            // Redirection
            header("location: ../modif_infos_entreprise/name_produit.php");
            exit();
        }
        else
        {
            // Requête pour mettre à jour les informations de l'entreprise
            $req5 = "UPDATE entreprise
            SET Produit = '$produit'
            WHERE id_entreprise = '$id_entreprise' ";

            if ($bdd -> query($req5) == true)
            {
                $message_name_produit_success = "Modification effectuée avec succès. Veuillez patientez pendant que nous vous redirigeons";

                // Stocke le message dans la session
                $_SESSION['message_name_produit_success'] = $message_name_produit_success;

                // Redirection
                header("location: ../modif_infos_entreprise/name_produit.php");
                exit();
            }
            else
            {
                $message_name_produit_error = "Echec de modification";
                
                // Stocke le message dans la session
                $_SESSION['message_name_produit_error'] = $message_name_produit_error;

                // Redirection
                header ("location: ../modif_infos_entreprise/name_produit.php");
                exit();
            }
        }
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
            $message_address_entreprise_input = "Veuillez remplir le champ";

            // Stocke le message dans la session
            $_SESSION['message_address_entreprise_input'] = $message_address_entreprise_input;

            // Redirection
            header("location: ../modif_infos_entreprise/address_enterprise.php");
            exit();
        }
        else
        {
            // Requête pour mettre à jour les informations de l'entreprise
            $req6 = "UPDATE entreprise
            SET adresseEntreprise = '$adresse_entreprise'
            WHERE id_entreprise = '$id_entreprise' ";

            if ($bdd -> query($req6) == true)
            {
                $message_address_entreprise_success = "Modification effectuée avec succès. Veuillez patientez pendant que nous vous redirigeons";

                // Stocke le message dans la session
                $_SESSION['message_address_entreprise_success'] = $message_address_entreprise_success;

                // Redirection
                header("location: ../modif_infos_entreprise/address_enterprise.php");
                exit();
            }
            else
            {
                $message_address_entreprise_error = "Echec de modification";
                
                // Stocke le message dans la session
                $_SESSION['message_address_entreprise_error'] = $message_address_entreprise_error;

                // Redirection
                header ("location: ../modif_infos_entreprise/address_enterprise.php");
                exit();
            }
        }
    }
?>