<?php
    // Activer l'affichage des erreurs
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include("../session_start_verify.php"); // Fichier pour verifier la connexion_user avec la session

    include("../sign_in.php"); // Connexion a la base de donnée

    include("../db_connected_verify.php"); // Vérification de la connexion à la base de données


    // ----------------------------------=======================================================================-------------------------
    // Condition a la soumission du formulaire produit

    if (isset($_POST['submit_form_produit']))
    {
        // Recuperation des données via le formulaire
        // Utilisation de trim pour eliminer les espaces inutiles dans les entrées
        $nom = trim($_POST['s_nomproduit']);
        $description = trim($_POST['s_descriptionproduit']);
        $prix = trim($_POST['s_prixvente']);
        $deviseprixvente = trim($_POST['s_deviseprixvente']);
        $cout = trim($_POST['s_coutunit']);
        $devisecoutunit = trim($_POST['s_devisecoutunit']);


        if (empty($nom) || empty($description) || empty($prix) || empty($deviseprixvente) || empty($cout) || empty($devisecoutunit))
        {
            // Stocker le message dans la session
            $_SESSION['message_produit_input'] = "Veuillez remplir tous les champs correctement";
        }
        else
        {
            $prixventefinal = $prix . ' ' . $deviseprixvente;
            $coutunitfinal = $cout . ' ' . $devisecoutunit;


            $query = "INSERT INTO produits VALUES (:idProduit, :NomProduit, :DescriptionProduit, :PrixVente, :CoutUnitaire)";
            $stmt = $bdd -> prepare($query);

            // Execution de la requete
            $success = $stmt -> execute([
                'idProduit' => 0,
                'NomProduit' => $nom,
                'DescriptionProduit' => $description,
                'PrixVente' => $prixventefinal,
                'CoutUnitaire' => $coutunitfinal
            ]);

            // Verification si linsertion a reussi
            if ($success)
            {
                // Stocker le message dans la session
                $_SESSION['message_produit_success'] = "Enregistrement effectué avec succès. Veuillez consultez la liste de vos produit";
            }
            else
            {
                // Stocker le message dans la session
                $_SESSION['message_produit_fail'] = "Echec d'enregistrement du produit";
            }
        }

        // Redirection 
        header("location: ../formulaire/formulaire_produit.php");
        // Arret du script
        exit();
    }

    // ------------------------------------------=============================================================----------------------------------
    // Condition a la soumission du formulaire fournisseur

    if (isset($_POST['submit_form_fournisseur']))
    {
        // Recuperation des données via le formulaire
        // Utilisation de trim pour eliminer les espaces inutiles dans les entrées
        $nomfournisseur = trim($_POST['s_nomfournisseur']);
        $adressefournisseur = trim($_POST['s_adressefournisseur']);
        $coordonneesfournisseur = trim($_POST['s_coordonneesfournisseur']);

        if (empty($nomfournisseur) || empty($adressefournisseur) || empty($coordonneesfournisseur))
        {
            // Stocker le message dans la session
            $_SESSION['message_fournisseur_input'] = "Veuillez remplir tous les champs correctement";
        }
        else
        {
            $query = "INSERT INTO fournisseurs VALUES (:idFournisseur, :NomFournisseur, :AdresseFournisseur, :CoordonneesFournisseur)";
            $stmt = $bdd -> prepare($query);

            // Execution de la requete
            $success = $stmt -> execute([
                'idFournisseur' => 0,
                'NomFournisseur' => $nomfournisseur,
                'AdresseFournisseur' => $adressefournisseur,
                'CoordonneesFournisseur' => $coordonneesfournisseur
            ]);

            // Verification si linsertion a reussi
            if ($success)
            {
                // Stocker le message dans la session
                $_SESSION['message_fournisseur_success'] = "Enregistrement effectué avec succès. Consultez la liste de vos fournisseurs";
            }
            else
            {
                // Stocker le message dans la session
                $_SESSION['message_fournisseur_fail'] = "Echec de l'enregistrement du fournisseur";
            }
        }

        // Redirection
        header("location: ../formulaire/formulaire_fournisseur.php");
        // Arret du script
        exit();
    }
    
    // ---------------------------------------===================================================---------------------------------------------------------------
    // Condition a la soumission du formulaire de vente

    if (isset($_POST['submit_form_vente']))
    {
        // Recuperation des données via le formulaire
        // Utilisation de trim pour eliminer les espaces inutiles dans les entrées
        $datevente = trim($_POST['s_datevente']);
        $quantitevendue = trim($_POST['s_quantitevendue']);
        $montanttotal = trim($_POST['s_montanttotal']);
        $devisemontanttotal = trim($_POST['s_devisemontanttotal']);
        $produit = trim($_POST['s_produit']);
        $modepaiement = trim($_POST['s_modepaiement']);


        if (empty($datevente) || empty($quantitevendue) || empty($montanttotal) || empty($devisemontanttotal) || empty($produit) || empty($modepaiement))
        {
            // Stocker le message dans la session
            $_SESSION['message_vente_input'] = "Veuillez remplir tous les champs correctement";
        }
        else
        {
            $montanttotalfinal = $montanttotal . ' ' . $devisemontanttotal;


            $query = "INSERT INTO ventes VALUES (:idVente, :DateVente, :QuantiteVendue, :MontantTotal, :idProduit, :idModePaiement)";
            $stmt = $bdd -> prepare($query);

            // Execution de la requete
            $success = $stmt -> execute([
                'idVente' => 0,
                'DateVente' => $datevente,
                'QuantiteVendue' => $quantitevendue,
                'MontantTotal' => $montanttotalfinal,
                'idProduit' => $produit,
                'idModePaiement' => $modepaiement
            ]);

            // Verification si linsertion a reussi
            if ($success)
            {
                // Stocker le message dans la session
                $_SESSION['message_vente_success'] = "Enregistrement effectué avec succès. Veuillez consultez la liste de vos ventes";
            }
            else
            {
                // Stocker le message dans la session
                $_SESSION['message_vente_fail'] = "Echec de l'enregistrement de la vente";
            }
        }

        // Redirection
        header("location: ../formulaire/formulaire_vente.php");
        // Arret du script
        exit();
    }
    
    // ---------------------------------===================================-------------------------------------------------------------------------
    // Condition a la soumission du formulaire recette

    if (isset($_POST['submit_form_recette']))
    {
        // Recuperation des données via le formulaire
        // Utilisation de trim pour eliminer les espaces inutiles dans les entrées
        $montantrecette = $_POST['s_montantrecette'];
        $devisemontantrecette = $_POST['s_devisemontantrecette'];
        $daterecette = $_POST['s_daterecette'];
        $descriptionrecette = $_POST['s_descriptionrecette'];
        $modepaiement = trim($_POST['s_modepaiement']);


        if (empty($montantrecette) || empty($devisemontantrecette) || empty($daterecette) || empty($descriptionrecette) || empty($modepaiement))
        {
            // Stocker le message dans la session
            $_SESSION['message_recette_input'] = "Veuillez remplir tous les champs correctement";
        }
        else
        {
            $montantrecettefinal = $montantrecette . ' ' . $devisemontantrecette;


            $query = "INSERT INTO recettes VALUES (:idRecette, :MontantRecette, :DateRecette, :DescriptionRecette, :idModePaiement)";
            $stmt = $bdd -> prepare($query);

            // Execution de la requete
            $success = $stmt -> execute([
                'idRecette' => 0,
                'MontantRecette' => $montantrecettefinal,
                'DateRecette' => $daterecette,
                'DescriptionRecette' => $descriptionrecette,
                'idModePaiement' => $modepaiement
            ]);

            //Verification si linsertion a reussi
            if ($success)
            {
                // Stocker le message dans la session
                $_SESSION['message_recette_success'] = "Enregistrement effectué avec succès. Consultez la liste de vos recettes";
            }
            else
            {
                // Stocker le message dans la session
                $_SESSION['message_recette_fail'] = "Echec de l'enregistrement de la recette";
            }
        }
    

        // Redirection
        header("location: ../formulaire/formulaire_recette.php");
        // Arret du script
        exit();
    }

    // --------------------------------------------=================================------------------------------------------------------------
    // Condition a la soumission d formulaire de depense 

    if (isset($_POST['submit_form_depense']))
    {
        // Recuperation des données via le formulaire
        // Utilisation de trim pour eliminer les espaces inutiles dans les entrées
        $montantdepense = trim($_POST['s_montantdepense']);
        $devisemontantdepense = trim($_POST['s_devisemontantdepense']);
        $datedepense = trim($_POST['s_datedepense']);
        $descriptiondepense = trim($_POST['s_descriptiondepense']);
        $modepaiement = trim($_POST['s_modepaiement']);


        if (empty($montantdepense) || empty($devisemontantdepense) || empty($datedepense) || empty($descriptiondepense) || empty($modepaiement))
        {
            // Stocker le message dans la session
            $_SESSION['message_depense_input'] = "Veuillez remplir tous les champs correctement";
        }
        else
        {
            $montantdepensefinal = $montantdepense . ' ' . $devisemontantdepense;

            
            $query = "INSERT INTO depenses VALUES (:idDepense, :MontantDepense, :DateDepense, :DescriptionDepense, :idModePaiement)";
            $stmt = $bdd -> prepare($query);

            // Execution de la requete
            $success = $stmt -> execute([
                'idDepense' => 0,
                'MontantDepense' => $montantdepensefinal,
                'DateDepense' => $datedepense,
                'DescriptionDepense' => $descriptiondepense,
                'idModePaiement' => $modepaiement
            ]);

            // Verification si linsertion a reussi
            if($success)
            {
                // Stocker le message dans la session
                $_SESSION['message_depense_success'] = "Enregistrement effectué avec succès. Consultez la liste de vos dépenses";
            } 
            else
            {
                // Stocker le message dans la session
                $_SESSION['message_depense_fail'] = "Echec de l'enregistrement de la dépense";
            }
        }


        // Redirection
        header("location: ../formulaire/formulaire_depense.php");
        // Arret du script
        exit();
    }

    // --------------------------------- ----------===============================================================-----------------------------------
    // Condition a la soumission du formulaire du mode de paiement

    if(isset($_POST['submit_form_mdp']))
    {
        // Recuperation des données via le formulaire
        // Utilisation de trim pour eliminer les espaces inutiles dans les entrées
        $nom_modepaiement = trim($_POST['s_nom_modepaiement']);

        if (empty($nom_modepaiement))
        {
            // Stocker le message dans la session
            $_SESSION['message_mdp_input'] = "Veuillez remplir le champ correctement.";
        }
        else
        {
            $query = "INSERT INTO modepaiement VALUES (:idModePaiement, :NomModePaiement)";
            $stmt = $bdd -> prepare($query);

            // Execution de la requete
            $success = $stmt -> execute([
                'idModePaiement' => 0,
                'NomModePaiement' => $nom_modepaiement
            ]);

            // Verification si linsertion a reussi
            if($success)
            {
                // Stocker le message dans la session
                $_SESSION['message_mdp_success'] = "Enregistrement effectué avec succès. Consultez la liste de vos modes de paiement";
            }
            else
            {
                // Stocker le message dans la session
                $_SESSION['message_mdp_fail'] = "Echec de l'enregistrement du mode de paiement";
            }
        }
    }


    // Redirection
    header("location: ../formulaire/formulaire_mdp.php");
    // Arret du script
    exit();
?>