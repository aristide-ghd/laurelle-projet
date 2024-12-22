<?php
    // Activer l'affichage des erreurs
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include("../session_start_verify.php"); // Fichier pour verifier la connexion_user avec la session

    include("../sign_in.php"); // Connexion a la base de donnée

    include("../db_connected_verify.php"); // Vérification de la connexion à la base de données



    // ----------------------------------=======================================================================-------------------------
    // Condition a la soumission du formulaire produit pour la mise a jour

    if (isset($_POST['update_form_produit']))
    {
        // Recuperation des données via le formulaire
        // Utilisation de trim pour eliminer les espaces inutiles dans les entrées
        $idProduit = trim($_POST['s_numero']);
        $nom = trim($_POST['s_nomproduit']);
        $description = trim($_POST['s_descriptionproduit']);
        $prix = trim($_POST['s_prixvente']);
        $deviseprixvente = trim($_POST['s_deviseprixvente']);
        $cout = trim($_POST['s_coutunit']);
        $devisecoutunit = trim($_POST['s_devisecoutunit']);


        if (empty($nom) || empty($description) || empty($prix) || empty($deviseprixvente) || empty($cout) || empty($devisecoutunit))
        {
            // Stocker le message dans la session
            $_SESSION['message_produit_input'] = "Veuillez remplir tous les champs pour la mise a jour";
        }
        else
        {
            $prixventefinal = $prix . ' ' . $deviseprixvente;
            $coutunitfinal = $cout . ' ' . $devisecoutunit;


            $query = "UPDATE produits SET NomProduit = :NomProduit, DescriptionProduit = :DescriptionProduit, PrixVente = :PrixVente, CoutUnitaire = :CoutUnitaire WHERE idProduit = :idProduit";
            $stmt = $bdd -> prepare($query);

            // Execution de la requete
            $success = $stmt -> execute([
                'idProduit' => $idProduit,
                'NomProduit' => $nom,
                'DescriptionProduit' => $description,
                'PrixVente' => $prixventefinal,
                'CoutUnitaire' => $coutunitfinal
            ]);

            // Verification si la mise a jour a reussi
            if ($success)
            {
                // Stocker le message dans la session
                $_SESSION['message_produit_success'] = "Mise a jour effectué avec succès. Vous serez redirigé dans quelques instants";
            }
            else
            {
                // Stocker le message dans la session
                $_SESSION['message_produit_fail'] = "Echec de la mise à jour du produit";
            }
        }

        // Redirection 
        header("location: ../modif_formulaire/modif_form_prod.php?id=" . $idProduit);
        // Arret du script
        exit();
    }


    // ------------------------------------------=============================================================----------------------------------
    // Condition a la soumission du formulaire fournisseur pour la mise a jour

    if (isset($_POST['update_form_fournisseur']))
    {
        // Recuperation des données via le formulaire
        // Utilisation de trim pour eliminer les espaces inutiles dans les entrées
        $idFournisseur = trim($_POST['s_numero']);
        $nomfournisseur = trim($_POST['s_nomfournisseur']);
        $adressefournisseur = trim($_POST['s_adressefournisseur']);
        $coordonneesfournisseur = trim($_POST['s_coordonneesfournisseur']);

        if (empty($nomfournisseur) || empty($adressefournisseur) || empty($coordonneesfournisseur))
        {
            // Stocker le message dans la session
            $_SESSION['message_fournisseur_input'] = "Veuillez remplir tous les champs pour la mise a jour";
        }
        else
        {
            $query = "UPDATE fournisseurs SET NomFournisseur = :NomFournisseur, AdresseFournisseur = :AdresseFournisseur, CoordonneesFournisseur = :CoordonneesFournisseur WHERE idFournisseur = :idFournisseur";
            $stmt = $bdd -> prepare($query);

            // Execution de la requete
            $success = $stmt -> execute([
                'idFournisseur' => $idFournisseur,
                'NomFournisseur' => $nomfournisseur,
                'AdresseFournisseur' => $adressefournisseur,
                'CoordonneesFournisseur' => $coordonneesfournisseur
            ]);

            // Verification si la mise a jour a reussi
            if ($success)
            {
                // Stocker le message dans la session
                $_SESSION['message_fournisseur_success'] = "Mise à jour effectuée avec succès. Vous serez redirigé dans quelques instants";
            }
            else
            {
                // Stocker le message dans la session
                $_SESSION['message_fournisseur_fail'] = "Echec de la mise à jour du fournisseur";
            }
        }

        // Redirection
        header("location: ../modif_formulaire/modif_form_fournisseur.php?id=" . $idFournisseur);
        // Arret du script
        exit();
    }
    

    // ---------------------------------------===================================================---------------------------------------------------------------
    // Condition a la soumission du formulaire de vente pour la mise a jour

    if (isset($_POST['update_form_vente']))
    {
        // Recuperation des données via le formulaire
        // Utilisation de trim pour eliminer les espaces inutiles dans les entrées
        $idVente = trim($_POST['s_numero']);
        $datevente = trim($_POST['s_datevente']);
        $quantitevendue = trim($_POST['s_quantitevendue']);
        $montanttotal = trim($_POST['s_montanttotal']);
        $devisemontanttotal = trim($_POST['s_devisemontanttotal']);
        $produit = trim($_POST['s_produit']);
        $modepaiement = trim($_POST['s_modepaiement']);


        if (empty($datevente) || empty($quantitevendue) || empty($montanttotal) || empty($devisemontanttotal) || empty($produit) || empty($modepaiement))
        {
            // Stocker le message dans la session
            $_SESSION['message_vente_input'] = "Veuillez remplir tous les champs pour la mise à jour";
        }
        else
        {
            $montanttotalfinal = $montanttotal . ' ' . $devisemontanttotal;


            $query = "UPDATE ventes SET DateVente = :DateVente, QuantiteVendue = :QuantiteVendue, MontantTotal = :MontantTotal, 
            idProduit = :idProduit, idModePaiement = :idModePaiement WHERE idVente = :idVente";
            $stmt = $bdd -> prepare($query);

            // Execution de la requete
            $success = $stmt -> execute([
                'idVente' => $idVente,
                'DateVente' => $datevente,
                'QuantiteVendue' => $quantitevendue,
                'MontantTotal' => $montanttotalfinal,
                'idProduit' => $produit,
                'idModePaiement' => $modepaiement
            ]);

            // Verification si la mise a jour a reussi
            if ($success)
            {
                // Stocker le message dans la session
                $_SESSION['message_vente_success'] = "Mise à jour effectuée avec succès. Vous serez redirigé dans quelques instants";
            }
            else
            {
                // Stocker le message dans la session
                $_SESSION['message_vente_fail'] = "Echec de mise à jour de la vente";
            }
        }

        // Redirection
        header("location: ../modif_formulaire/modif_form_vente.php?id=" . $idVente);
        // Arret du script
        exit();
    }
    

    // ---------------------------------===================================-------------------------------------------------------------------------
    // Condition a la soumission du formulaire recette pour la mise a jour

    if (isset($_POST['update_form_recette']))
    {
        // Recuperation des données via le formulaire
        // Utilisation de trim pour eliminer les espaces inutiles dans les entrées
        $idRecette = trim($_POST['s_numero']);
        $montantrecette = $_POST['s_montantrecette'];
        $devisemontantrecette = $_POST['s_devisemontantrecette'];
        $daterecette = $_POST['s_daterecette'];
        $descriptionrecette = $_POST['s_descriptionrecette'];
        $modepaiement = trim($_POST['s_modepaiement']);


        if (empty($montantrecette) || empty($devisemontantrecette) || empty($daterecette) || empty($descriptionrecette) || empty($modepaiement))
        {
            // Stocker le message dans la session
            $_SESSION['message_recette_input'] = "Veuillez remplir tous les champs pour la mise a jour";
        }
        else
        {
            $montantrecettefinal = $montantrecette . ' ' . $devisemontantrecette;


            $query = "UPDATE recettes SET MontantRecette = :MontantRecette, DateRecette = :DateRecette, DescriptionRecette = :DescriptionRecette, idModePaiement = :idModePaiement WHERE idRecette = :idRecette";
            $stmt = $bdd -> prepare($query);

            // Execution de la requete
            $success = $stmt -> execute([
                'idRecette' => $idRecette,
                'MontantRecette' => $montantrecettefinal,
                'DateRecette' => $daterecette,
                'DescriptionRecette' => $descriptionrecette,
                'idModePaiement' => $modepaiement
            ]);

            //Verification si la mise a jour a reussi
            if ($success)
            {
                // Stocker le message dans la session
                $_SESSION['message_recette_success'] = "Mise a jour effectuée avec succès. Vous serez redirigé dans quelques instants.";
            }
            else
            {
                // Stocker le message dans la session
                $_SESSION['message_recette_fail'] = "Echec de mise a jour de la recette";
            }
        }
    

        // Redirection
        header("location: ../modif_formulaire/modif_form_recette.php?id=" . $idRecette);
        // Arret du script
        exit();
    }


    // --------------------------------------------=================================------------------------------------------------------------
    // Condition a la soumission d formulaire de depense pour la mise a jour

    if (isset($_POST['update_form_depense']))
    {
        // Recuperation des données via le formulaire
        // Utilisation de trim pour eliminer les espaces inutiles dans les entrées
        $idDepense = trim($_POST['s_numero']);
        $montantdepense = trim($_POST['s_montantdepense']);
        $devisemontantdepense = trim($_POST['s_devisemontantdepense']);
        $datedepense = trim($_POST['s_datedepense']);
        $descriptiondepense = trim($_POST['s_descriptiondepense']);
        $modepaiement = trim($_POST['s_modepaiement']);


        if (empty($montantdepense) || empty($devisemontantdepense) || empty($datedepense) || empty($descriptiondepense) || empty($modepaiement))
        {
            // Stocker le message dans la session
            $_SESSION['message_depense_input'] = "Veuillez remplir tous les champs pour la mise a jour";
        }
        else
        {
            $montantdepensefinal = $montantdepense . ' ' . $devisemontantdepense;

            
            $query = "UPDATE depenses SET MontantDepense = :MontantDepense, DateDepense = :DateDepense, DescriptionDepense = :DescriptionDepense, idModePaiement = :idModePaiement WHERE idDepense = :idDepense";
            $stmt = $bdd -> prepare($query);

            // Execution de la requete
            $success = $stmt -> execute([
                'idDepense' => $idDepense,
                'MontantDepense' => $montantdepensefinal,
                'DateDepense' => $datedepense,
                'DescriptionDepense' => $descriptiondepense,
                'idModePaiement' => $modepaiement
            ]);

            // Verification si la mise a jour a reussi
            if($success)
            {
                // Stocker le message dans la session
                $_SESSION['message_depense_success'] = "Mise à jour effectuée avec succès. Vous serez redirigé dans quelques instants";
            } 
            else
            {
                // Stocker le message dans la session
                $_SESSION['message_depense_fail'] = "Echec de mise a jour de la dépense";
            }
        }


        // Redirection
        header("location: ../modif_formulaire/modif_form_depense.php?id=" . $idDepense);
        // Arret du script
        exit();
    }


    // -------------------------------------------===============================================================------------------------------------------
    // Condition a la soumission du formulaire du mode de paiement pour la mise a jour

    if(isset($_POST['update_form_mdp']))
    {
        // Recuperation des données via le formulaire
        // Utilisation de trim pour eliminer les espaces inutiles dans les entrées
        $idModePaiement = trim($_POST['s_numero']);
        $nom_modepaiement = trim($_POST['s_nom_modepaiement']);

        if (empty($nom_modepaiement))
        {
            // Stocker le message dans la session
            $_SESSION['message_mdp_input'] = "Veuillez remplir tous les champs pour la mise a jour";
        }
        else
        {
            $query = "UPDATE modepaiement SET NomModePaiement = :NomModePaiement WHERE idModePaiement = :idModePaiement";
            $stmt = $bdd -> prepare($query);

            // Execution de la requete
            $success = $stmt -> execute([
                'idModePaiement' => $idModePaiement,
                'NomModePaiement' => $nom_modepaiement
            ]);

            // Verification si la mise a jour a reussi
            if($success)
            {
                // Stocker le message dans la session
                $_SESSION['message_mdp_success'] = "Mise a jour effectuée avec succès. Vous serez redirigez dans quelques instants";
            }
            else
            {
                // Stocker le message dans la session
                $_SESSION['message_mdp_fail'] = "Echec de mise a jour du mode de paiement";
            }
        }
    }


    // Redirection
    header("location: ../modif_formulaire/modif_form_mdp.php?id=" . $idModePaiement);
    // Arret du script
    exit();
?>