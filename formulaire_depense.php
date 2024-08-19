<?php
    include("connexion.php");
    $req = " SELECT * FROM modepaiement ORDER BY idModePaiement";
    $reponse = $bdd -> query($req);
    $donnee = $reponse -> fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form_dep.css">
    <title>Formulaire des dépenses</title>
</head>
<body>
    <?php include 'navbar/en_tete.php'; ?>
    <section>
        <h1 class="ajout">Ajouter une transaction</h1>
        <form action="valider_transaction.php" method="post">
            <fieldset>
                <legend>Dépense</legend>
                <label for="">Montant de Dépense :</label>
                <input type="text" name="s_montantdepense" class="montant">
                <br><br>
                <label for="">Date de Dépense :</label>
                <input type="date" name="s_datedepense" class="date">
                <br><br>
                <label for="">Description de Dépense :</label>
                <input type="text" name="s_descriptiondepense" class="description">
                <br><br>
                <label for="">Mode de Paiement :</label>
                <select name="s_modepaiement" id="listmode">
                    <?php
                        foreach ($donnee as $listemode){
                    ?>
                    <option value="<?= $listemode['idModePaiement'] ?>">
                        <?= $listemode['NomModePaiement'] ?>
                    </option>
                    <?php
                        }
                    ?>
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