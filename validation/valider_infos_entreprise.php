<?php 
    session_start();

    // Vérification si l'utilisateur est connecté
    if(!isset($_SESSION['logged_in'])) {
        // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
        header("Location: ../index.php");
        exit;
    }

    $id_entreprise = $_SESSION['id_entreprise'];

    include('../connexion.php');

    // Récupération des données du formulaire
    $firstname = $_POST['s_firstname'];
    $lastname = $_POST['s_lastname'];
    $email = $_POST['s_email'];
    $telephone = $_POST['s_phone']; 
    $country = $_POST['s_country'];
    $nom_entreprise = $_POST['s_nom_entreprise'];
    $produit = $_POST['s_produit'];
    $adresse_entreprise = $_POST['s_adresse_entreprise'];

    // --------------------------------NOM ET PRENOM -------------------------------
    // Vérification que les champs ne sont pas vides
    if (empty($firstname) || empty($lastname))
    {
        echo "<script>alert('Veuillez remplir tous les champs')</script>";
    }
    else
    {
        // Requête pour mettre à jour les informations de l'entreprise
        $req = "UPDATE entreprise
        SET Nom = '$lastname', Prenom = '$firstname'
        WHERE id_entreprise = '$id_entreprise' ";
        
        if ($bdd -> query($req) == true)
        {
            echo "<script>alert('Modification effectuée avec succès')</script>";
            header ("location: ../profile/account_info.php");
        }
        else
        {
            echo "<script>alert('Echec de modification')</script";
        }
    }

    // ----------------------------- EMAIL -----------------------------------------
    // Vérification que les champs ne sont pas vides
    if (empty($email))
    {
        echo "<script>alert('Veuillez remplir tous les champs')</script>";
    }
    else
    {
        // Requête pour mettre à jour les informations de l'entreprise
        $req1 = "UPDATE entreprise
        SET Email = '$email'
        WHERE id_entreprise = '$id_entreprise' ";

        if ($bdd -> query($req1) == true)
        {
            echo "<script>alert('Modification effectuée avec succès')</script>";
            header ("location: ../profile/account_info.php");
        }
        else
        {
            echo "<script>alert('Echec de modification')</script";
        }
    }

    // ---------------------------- TELEPHONE ----------------------------------------
    // Vérification que les champs ne sont pas vides
    if (empty($telephone))
    {
        echo "<script>alert('Veuillez remplir tous les champs')</script>";
    }
    else
    {
        // Requête pour mettre à jour les informations de l'entreprise
        $req2 = "UPDATE entreprise
        SET Telephone = '$telephone'
        WHERE id_entreprise = '$id_entreprise' ";

        if ($bdd -> query($req2) == true)
        {
            echo "<script>alert('Modification effectuée avec succès')</script>";
            header ("location: ../profile/account_info.php");
        }
        else
        {
            echo "<script>alert('Echec de modification')</script";
        }
    }

    // -------------------------- PAYS------------------------------------------------
    // Vérification que les champs ne sont pas vides
    if (empty($country))
    {
        echo "<script>alert('Veuillez remplir tous les champs')</script>";
    }
    else
    {
        // Requête pour mettre à jour les informations de l'entreprise
        $req3 = "UPDATE entreprise
        SET Pays = '$country'
        WHERE id_entreprise = '$id_entreprise' ";

        if ($bdd -> query($req3) == true)
        {
            echo "<script>alert('Modification effectuée avec succès')</script>";
            header ("location: ../profile/account_info.php");
        }
        else
        {
            echo "<script>alert('Echec de modification')</script";
        }
    }

    // --------------------------- NOM DE L'ENTREPRISE --------------------------------
    // Vérification que les champs ne sont pas vides
    if (empty($nom_entreprise))
    {
        echo "<script>alert('Veuillez remplir tous les champs')</script>";
    }
    else
    {
        // Requête pour mettre à jour les informations de l'entreprise
        $req4 = "UPDATE entreprise
        SET nomEntreprise = '$nom_entreprise'
        WHERE id_entreprise = '$id_entreprise' ";

        if ($bdd -> query($req4) == true)
        {
            echo "<script>alert('Modification effectuée avec succès')</script>";
            header ("location: ../profile/account_info.php");
        }
        else
        {
            echo "<script>alert('Echec de modification')</script";
        }
    }
    
    // ------------------------ TYPE DE PRODUIT ------------------------------------------
    // Vérification que les champs ne sont pas vides
    if (empty($produit))
    {
        echo "<script>alert('Veuillez remplir tous les champs')</script>";
    }
    else
    {
        // Requête pour mettre à jour les informations de l'entreprise
        $req5 = "UPDATE entreprise
        SET Produit = '$produit'
        WHERE id_entreprise = '$id_entreprise' ";

        if ($bdd -> query($req5) == true)
        {
            echo "<script>alert('Modification effectuée avec succès')</script>";
            header ("location: ../profile/account_info.php");
        }
        else
        {
            echo "<script>alert('Echec de modification')</script";
        }
    }

    // ------------------------------ADRESSE DE L'ENTREPRISE -------------------------------
    // Vérification que les champs ne sont pas vides
    if (empty($adresse_entreprise))
    {
        echo "<script>alert('Veuillez remplir tous les champs')</script>";
    }
    else
    {
        // Requête pour mettre à jour les informations de l'entreprise
        $req6 = "UPDATE entreprise
        SET adresseEntreprise = '$adresse_entreprise'
        WHERE id_entreprise = '$id_entreprise' ";

        if ($bdd -> query($req6) == true)
        {
            echo "<script>alert('Modification effectuée avec succès')</script>";
            header ("location: ../profile/account_info.php");
        }
        else
        {
            echo "<script>alert('Echec de modification')</script";
        }
    }
?>