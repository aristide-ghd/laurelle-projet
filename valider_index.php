<?php
    include('connexion.php');

    $date = $_POST['s_date'];
    $description = $_POST['s_description'];
    $type = $_POST['s_type'];
    $montant = $_POST['s_montant'];
    $categorie = $_POST['s_categorie'];

    if(empty($date)||empty($description)||empty($type)||empty($montant)||empty($categorie))
    {
        echo "<script>alert('Veuillez remplir tous les champs')</script>";
    }
    else
    {
        $req = "INSERT INTO enregistrement values (0, '$date', '$description', '$type', '$montant', '$categorie')";
        if($bdd -> query($req) == true)
        {
            echo "Transaction ajoutée avec succès";
            header('location:page1.php');
        }
        else
        {
            echo "Echec d\'ajout";
        }
    }
?>