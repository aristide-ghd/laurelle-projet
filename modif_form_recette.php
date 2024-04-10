<?php
    include("connexion.php");
    $matrec = $_GET['id'];
    $req1 = "SELECT * FROM recettes where idRecette = $matrec";
    $reponse1 = $bdd -> query($req1);
    $donnee1 = $reponse1 -> fetchAll();

    foreach($donnee1 as $liste)
    {
        $mdp = $liste['idModePaiement'];
    }

    $req = " SELECT * FROM modepaiement ORDER BY idModePaiement";
    $reponse = $bdd -> query($req);
    $donnee = $reponse -> fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form_rec.css">
    <title>Modification des recettes</title>
</head>
<body>
<?php include 'navbar/navbar.php'; ?>

    <section>
        <h1 class="ajout">Ajouter une transaction</h1>
        <form action="valider_modif_form.php" method="post">
            <fieldset>
                <legend>Recette</legend>
                <label for="">Matricule Recette :</label>
                <input type="text" name="s_numero" class="matrec" value= "<?= $liste['idRecette'] ?>">
                <br><br>
                <label for="">Montant de Recette :</label>
                <input type="text" name="s_montantrecette" class="montant" value= "<?= $liste['MontantRecette'] ?>">
                <br><br>
                <label for="">Date de Recette :</label>
                <input type="date" name="s_daterecette" class="date" value= "<?= $liste['DateRecette'] ?>">
                <br><br>
                <label for="">Description de Recette :</label>
                <input type="text" name="s_descriptionrecette" class="description" value= "<?= $liste['DescriptionRecette'] ?>">
                <br><br>
                <label for="">Mode de Paiement :</label>
                <select name="s_modepaiement" id="listmode">
                    <?php
                            foreach ($donnee as $listemode)
                            {
                                if($listemode['idModePaiement'] == $mdp)
                                {?>
                                    <option selected value="<?= $listemode['idModePaiement'] ?>">
                                                            <?= $listemode['NomModePaiement'] ?>
                                    </option>
                    <?php       }
                                else
                                {?>
                                    <option value="<?= $listemode['idModePaiement'] ?>">
                                                    <?= $listemode['NomModePaiement'] ?>
                                    </option>
                    <?php       }
                            }?>
                </select>
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