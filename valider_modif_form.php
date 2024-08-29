<?php 
    include("connexion.php");
    $matricule = $_POST['s_numero'];
    $nom = $_POST['s_nomproduit'];
    $description = $_POST['s_descriptionproduit']; 
    $prix = $_POST['s_prixvente'];
    $deviseprixvente = $_POST['s_deviseprixvente'];
    $cout = $_POST['s_coutunit'];
    $devisecoutunit = $_POST['s_devisecoutunit'];
    $nomcli = $_POST['s_nomclient'];
    $adressecli = $_POST['s_adresseclient'];
    $coordonneescli = $_POST['s_coordonneesclient'];
    $datevente = $_POST['s_datevente'];
    $quantitevendue = $_POST['s_quantitevendue'];
    $montanttotal = $_POST['s_montanttotal'];
    $devisemontanttotal = $_POST['s_devisemontanttotal'];
    $produit = $_POST['s_produit'];
    $client = $_POST['s_client'];
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
            header ("location: produit.php");
        }
        else
        {
            echo "<script>alert('Echec de modification de l etudiant')</script";
        }
    }

    if(empty($matricule)||empty($nomcli)||empty($adressecli)||empty($coordonneescli))
    {
        echo "<script>alert('Veuillez remplir tous les champs')</script>";
    }
    else
    {
        $req = "UPDATE clients
        set NomClient = '$nomcli',
        AdresseClient = '$adressecli',
        CoordonneesClient = '$coordonneescli'
        where idClient = $matricule";
        if($bdd -> query($req) == true)
        {
            echo "<script>alert('Modification effectuée avec succès')</script>";
            header ("location: client.php");
        }
        else
        {
            echo "<script>alert('Echec de modification de l etudiant')</script";
        }
    }

    if(empty($matricule)||empty($datevente)||empty($quantitevendue)||empty($montanttotal)||empty($devisemontanttotal)||empty($produit)||empty($client)||empty($modepaiement))
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
        idClient = '$client',
        idModePaiement = '$modepaiement'
        where idVente = $matricule";
        if($bdd -> query($req) == true)
        {
            echo "<script>alert('Modification effectuée avec succès')</script>";
            header ("location: vente.php");
        }
        else
        {
            echo "<script>alert('Echec de modification de l etudiant')</script";
        }
    }

    if(empty($matricule)||empty($montantrecette)||empty($devisemontantrecette)||empty($daterecette)||empty($descriptionrecette)||empty($modepaiement))
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
            header ("location: recette.php");
        }
        else
        {
            echo "<script>alert('Echec de modification de l etudiant')</script";
        }
    }

    if(empty($matricule)||empty($montantdepense)||empty($devisemontantdepense)||empty($datedepense)||empty($descriptiondepense)||empty($modepaiement))
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
            header ("location: depense.php");
        }
        else
        {
            echo "<script>alert('Echec de modification de l etudiant')</script";
        }
    }

    if(empty($matricule)||empty($nom_modepaiement))
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
            header('location:mdp.php');
        }
        else
        {
            echo "Echec de transaction";
        }
    }
?>