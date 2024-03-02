<?php
include('connexion.php');

$id = $_POST['s_numero'];
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
            $req = "UPDATE enregistrement 
            set datenreg = '$date', 
            descriptionenreg = '$description', 
            typenreg = '$type', 
            montantenreg = '$montant', 
            categorienreg = '$categorie'
            where idenreg = $id";
            if($bdd -> query($req) == true)
            {
                    echo "<script>alert('Modification effectuée avec succès')</script>";
                    header ("location: page1.php");
            }
            else
            {
                echo "<script>alert('Echec de modification de l etudiant')</script";
            }
    }

?>