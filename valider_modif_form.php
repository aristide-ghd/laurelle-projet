<?php 
    include("connexion.php");
    $matricule = $_POST['s_numero'];
    $nom = $_POST['s_nomproduit'];
    $description = $_POST['s_descriptionproduit']; 
    $prix = $_POST['s_prixvente'];
    $cout = $_POST['s_coutunit'];
    $nomcli = $_POST['s_nomclient'];
    $adressecli = $_POST['s_adresseclient'];
    $coordonneescli = $_POST['s_coordonneesclient'];
    $datevente = $_POST['s_datevente'];
    $quantitevendue = $_POST['s_quantitevendue'];
    $montanttotal = $_POST['s_montanttotal'];
    $produit = $_POST['s_produit'];
    $client = $_POST['s_client'];
    $modepaiement = $_POST['s_modepaiement'];
    $montantrecette = $_POST['s_montantrecette'];
    $daterecette = $_POST['s_daterecette'];
    $descriptionrecette = $_POST['s_descriptionrecette'];
    $montantdepense = $_POST['s_montantdepense'];
    $datedepense = $_POST['s_datedepense'];
    $descriptiondepense = $_POST['s_descriptiondepense'];
    $nom_modepaiement = $_POST['s_nom_modepaiement'];

    if(empty($matricule)||empty($nom)||empty($description)||empty($prix)||empty($cout))
    {
        echo "<script>alert('Veuillez remplir tous les champs')</script>";
    }
    else
    {
        $req = "UPDATE produits
        set NomProduit = '$nom',
        DescriptionProduit = '$description',
        PrixVente = '$prix',
        CoutUnitaire = '$cout'
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

    if(empty($matricule)||empty($datevente)||empty($quantitevendue)||empty($montanttotal)||empty($produit)||empty($client)||empty($modepaiement))
    {
        echo "<script>alert('Veuillez remplir tous les champs')</script>";
    }
    else
    {
        $req = "UPDATE ventes
        set DateVente = '$datevente',
        QuantiteVendue = '$quantitevendue',
        MontantTotal = '$montanttotal',
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

    if(empty($matricule)||empty($montantrecette)||empty($daterecette)||empty($descriptionrecette)||empty($modepaiement))
    {
        echo "<script>alert('Veuillez remplir tous les champs')</script>";
    }
    else
    {
        $req = "UPDATE recettes
        set MontantRecette = '$montantrecette',
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

    if(empty($matricule)||empty($montantdepense)||empty($datedepense)||empty($descriptiondepense)||empty($modepaiement))
    {
        echo "<script>alert('Veuillez remplir tous les champs')</script>";
    }
    else
    {
        $req = "UPDATE depenses
        set MontantDepense = '$montantdepense',
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