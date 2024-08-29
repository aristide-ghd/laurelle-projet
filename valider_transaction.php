<?php 
    include("connexion.php");
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
    $nom_modepaiement = $_POST['s_nom_modepaiement'];
    $montantrecette = $_POST['s_montantrecette'];
    $devisemontantrecette = $_POST['s_devisemontantrecette'];
    $daterecette = $_POST['s_daterecette'];
    $descriptionrecette = $_POST['s_descriptionrecette'];
    $montantdepense = $_POST['s_montantdepense'];
    $devisemontantdepense = $_POST['s_devisemontantdepense'];
    $datedepense = $_POST['s_datedepense'];
    $descriptiondepense = $_POST['s_descriptiondepense'];

    // Concaténation du prix, du cout et du montant avec la devise
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
        $req = "INSERT INTO produits values(0, '$nom', '$description', '$prixventefinal', '$coutunitfinal')";
        if($bdd -> query($req) == true)
        {
            echo "Transaction effectué avec succès";
            header('location:produit.php');
        }
        else
        {
            echo "Echec de transaction";
        }
    }

    if(empty($nomcli)||empty($adressecli)||empty($coordonneescli))
    {
        echo "<script>alert('Veuillez remplir tous les champs')</script>";
    }
    else
    {
        $req1 = "INSERT INTO clients values(0, '$nomcli', '$adressecli', '$coordonneescli')";
        if($bdd -> query($req1) == true)
        {
            echo "Transaction effectué avec succès";
            header('location:client.php');
        }
        else
        {
            echo "Echec de transaction";
        }
    }

    if(empty($datevente)||empty($quantitevendue)||empty($montanttotal)||empty($devisemontanttotal)||empty($produit)||empty($client)||empty($modepaiement))
    {
        echo "<script>alert('Veuillez remplir tous les champs')</script>";
    }
    else
    {
        $req2 = "INSERT INTO ventes values(0, '$datevente', '$quantitevendue', '$montanttotalfinal', '$produit', '$client', '$modepaiement')";
        if($bdd -> query($req2) == true)
        {
            echo "Transaction effectué avec succès";
            header('location:vente.php');
        }
        else
        {
            echo "Echec de transaction";
        }
    }

    if(empty($montantrecette)||empty($devisemontantrecette)||empty($daterecette)||empty($descriptionrecette)||empty($modepaiement))
    {
        echo "<script>alert('Veuillez remplir tous les champs')</script>";
    }
    else
    {
        $req3 = "INSERT INTO recettes values(0, '$montantrecettefinal', '$daterecette', '$descriptionrecette', '$modepaiement')";
        if($bdd -> query($req3) == true)
        {
            echo "Transaction effectué avec succès";
            header('location:recette.php');
        }
        else
        {
            echo "Echec de transaction";
        }
    }

    if(empty($montantdepense)||empty($devisemontantdepense)||empty($datedepense)||empty($descriptiondepense)||empty($modepaiement))
    {
        echo "<script>alert('Veuillez remplir tous les champs')</script>";
    }
    else
    {
        $req4 = "INSERT INTO depenses values(0, '$montantdepensefinal', '$datedepense', '$descriptiondepense', '$modepaiement')";
        if($bdd -> query($req4) == true)
        {
            echo "Transaction effectué avec succès";
            header('location:depense.php');
        } 
        else
        {
            echo "Echec de transaction";
        }
    }

    if(empty($nom_modepaiement))
    {
        echo "<script>alert('Veuillez remplir tous les champs')</script>";
    }
    else
    {
        $req5 = "INSERT INTO modepaiement values(0, '$nom_modepaiement')";
        if($bdd -> query($req5) == true)
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