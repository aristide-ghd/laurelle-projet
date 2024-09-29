<?php 
    include("../connexion.php");
    $matricule = $_POST['s_numero'];
    $nom = $_POST['s_nomproduit'];
    $description = $_POST['s_descriptionproduit']; 
    $prix = $_POST['s_prixvente'];
    $deviseprixvente = $_POST['s_deviseprixvente'];
    $cout = $_POST['s_coutunit'];
    $devisecoutunit = $_POST['s_devisecoutunit'];
    $nomfournisseur = $_POST['s_nomfournisseur'];
    $adressefournisseur = $_POST['s_adressefournisseur'];
    $coordonneesfournisseur = $_POST['s_coordonneesfournisseur'];
    $datevente = $_POST['s_datevente'];
    $quantitevendue = $_POST['s_quantitevendue'];
    $montanttotal = $_POST['s_montanttotal'];
    $devisemontanttotal = $_POST['s_devisemontanttotal'];
    $produit = $_POST['s_produit'];
    $modepaiement = $_POST['s_modepaiement'];
    $montantrecette = $_POST['s_montantrecette'];
    $devisemontantrecette = $_POST['s_devisemontantrecette'];
    $daterecette = $_POST['s_daterecette'];
    $descriptionrecette = $_POST['s_descriptionrecette'];
    $montantdepense = $_POST['s_montantdepense'];
    $devisemontantdepense = $_POST['s_devisemontantdepense'];
    $datedepense = $_POST['s_datedepense'];
    $descriptiondepense = $_POST['s_descriptiondepense'];
    $nom_modepaiement = $_POST['s_nom_modepaiement'];

    // Concaténation du prix et du cout avec la devise
    $prixventefinal = $prix . ' ' . $deviseprixvente;
    $coutunitfinal = $cout . ' ' . $devisecoutunit;

    $montanttotalfinal = $montanttotal . ' ' . $devisemontanttotal;
    $montantrecettefinal = $montantrecette . ' ' . $devisemontantrecette;
    $montantdepensefinal = $montantdepense . ' ' . $devisemontantdepense;

    if(empty($nom)||empty($description)||empty($prix)||empty($deviseprixvente)||empty($cout)||empty($devisecoutunit))
    {
        echo "<script>alert('Veuillez remplir tous les champs')</script>";
    }
    else
    {
        $req = "UPDATE produits
        set NomProduit = '$nom',
        DescriptionProduit = '$description',
        PrixVente = '$prixventefinal',
        CoutUnitaire = '$coutunitfinal'
        where idProduit = $matricule";
        if($bdd -> query($req) == true)
        {
            echo "<script>alert('Modification effectuée avec succès')</script>";
            header ("location: ../dashbord/produit.php");
        }
        else
        {
            echo "<script>alert('Echec de modification du produit')</script";
        }
    }

    if(empty($nomfournisseur)||empty($adressefournisseur)||empty($coordonneesfournisseur))
    {
        echo "<script>alert('Veuillez remplir tous les champs')</script>";
    }
    else
    {
        $req = "UPDATE fournisseurs
        set NomFournisseur = '$nomfournisseur',
        AdresseFournisseur = '$adressefournisseur',
        CoordonneesFournisseur = '$coordonneesfournisseur'
        where idFournisseur = $matricule";
        if($bdd -> query($req) == true)
        {
            echo "<script>alert('Modification effectuée avec succès')</script>";
            header ("location: ../dashbord/fournisseur.php");
        }
        else
        {
            echo "<script>alert('Echec de modification du fournisseur')</script";
        }
    }

    if(empty($datevente)||empty($quantitevendue)||empty($montanttotal)||empty($devisemontanttotal)||empty($produit)||empty($modepaiement))
    {
        echo "<script>alert('Veuillez remplir tous les champs')</script>";
    }
    else
    {
        $req = "UPDATE ventes
        set DateVente = '$datevente',
        QuantiteVendue = '$quantitevendue',
        MontantTotal = '$montanttotalfinal',
        idProduit = '$produit',
        idModePaiement = '$modepaiement'
        where idVente = $matricule";
        if($bdd -> query($req) == true)
        {
            echo "<script>alert('Modification effectuée avec succès')</script>";
            header ("location: ../dashbord/vente.php");
        }
        else
        {
            echo "<script>alert('Echec de modification dune vente')</script";
        }
    }

    if(empty($montantrecette)||empty($devisemontantrecette)||empty($daterecette)||empty($descriptionrecette)||empty($modepaiement))
    {
        echo "<script>alert('Veuillez remplir tous les champs')</script>";
    }
    else
    {
        $req = "UPDATE recettes
        set MontantRecette = '$montantrecettefinal',
        DateRecette = '$daterecette',
        DescriptionRecette = '$descriptionrecette',
        idModePaiement = '$modepaiement'
        where idRecette = $matricule";
        if($bdd -> query($req) == true)
        {
            echo "<script>alert('Modification effectuée avec succès')</script>";
            header ("location: ../dashbord/recette.php");
        }
        else
        {
            echo "<script>alert('Echec de modification de la recette')</script";
        }
    }

    if(empty($montantdepense)||empty($devisemontantdepense)||empty($datedepense)||empty($descriptiondepense)||empty($modepaiement))
    {
        echo "<script>alert('Veuillez remplir tous les champs')</script>";
    }
    else
    {
        $req = "UPDATE depenses
        set MontantDepense = '$montantdepensefinal',
        DateDepense = '$datedepense',
        DescriptionDepense = '$descriptiondepense',
        idModePaiement = '$modepaiement'
        where idDepense = $matricule";
        if($bdd -> query($req) == true)
        {
            echo "<script>alert('Modification effectuée avec succès')</script>";
            header ("location: ../dashbord/depense.php");
        }
        else
        {
            echo "<script>alert('Echec de modification de la depense')</script";
        }
    }

    if(empty($nom_modepaiement))
    {
        echo "<script>alert('Veuillez remplir tous les champs')</script>";
    }
    else
    {
        $req = "UPDATE modepaiement
        set NomModePaiement = '$nom_modepaiement'
        where idModePaiement = $matricule";
        if($bdd -> query($req) == true)
        {
            echo "Transaction effectué avec succès";
            header('location: ../dashbord/mdp.php');
        }
        else
        {
            echo "Echec de modification dun mode de paiement";
        }
    }
?>