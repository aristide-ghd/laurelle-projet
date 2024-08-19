<?php
    include("connexion.php");
    $matmdp = $_GET['id'];
    $req1 = "SELECT * FROM modepaiement where idModePaiement = $matmdp";
    $reponse1 = $bdd -> query($req1);
    $donnee1 = $reponse1 -> fetchAll();

    foreach($donnee1 as $liste)
    {
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form_mdp.css">
    <title>Modification du Mode de Paiement</title>
</head>
<body>
    <?php include 'navbar/en_tete.php'; ?>
    <section>
        <h1 class="ajout">Ajouter une transaction</h1>
        <form action="valider_modif_form.php" method="post">
            <fieldset>
                <legend>Mode de Paiement</legend>
                <label for="">Matricule Mode Paiement :</label>
                <input type="text" name="s_numero" class="matmdp" value= "<?= $liste['idModePaiement'] ?>">
                <br><br>
                <label for="">Nom Mode de Paiement :</label>
                <input type="text" name="s_nom_modepaiement" class="nom_mode" value= "<?= $liste['NomModePaiement'] ?>">
            </fieldset>
            <br>
            <input type="submit" value="Ajouter">
            <input type="reset" value="Annuler">
        </form>
    </section>
    <div class="footer">
        <p>Copyright © 2024 Homechip's Laure | Tous droits réservés <br>
            Design by: <a href="https://ari-luxury.com">Ari-Luxury</a>
        </p>
    </div>
</body>
</html>