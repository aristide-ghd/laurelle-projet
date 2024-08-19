<?php
    include("connexion.php");
    $req = " SELECT * FROM produits ORDER BY idProduit";
    $reponse = $bdd -> query($req);
    $donnee = $reponse -> fetchAll();

    $req1 = " SELECT * FROM clients ORDER BY idClient";
    $reponse1 = $bdd -> query($req1);
    $donnee1 = $reponse1 -> fetchAll();

    $req2 = " SELECT * FROM modepaiement ORDER BY idModePaiement";
    $reponse2 = $bdd -> query($req2);
    $donnee2 = $reponse2 -> fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form_ven.css">
    <title>Formulaire des ventes</title>
</head>
<body>
    <?php include 'navbar/en_tete.php'; ?>
    <section>
        <h1 class="ajout">Ajouter une transaction</h1>
        <form action="valider_transaction.php" method="post">
            <fieldset>
                <legend>Vente</legend>
                <label for="">Date de Vente :</label>
                <input type="date" name="s_datevente" class="date">
                <br><br>
                <label for="">Quantité Vendue :</label>
                <input type="text" name="s_quantitevendue" class="quantite">
                <br><br>
                <label for="">Montant Total :</label>
                <input type="text" name="s_montanttotal" class="montant">
                <br><br>
                <label for="">Produit :</label>
                <select name="s_produit" id="listproduit">
                    <?php
                        foreach ($donnee as $listeproduit){
                    ?>
                    <option value="<?= $listeproduit['idProduit'] ?>">
                        <?= $listeproduit['NomProduit'] ?>
                    </option>
                    <?php
                        }
                    ?>
                </select>
                <br><br>
                <label for="">Client :</label>
                <select name="s_client" id="listclient">
                    <?php
                        foreach ($donnee1 as $listeclient){
                    ?>
                    <option value="<?= $listeclient['idClient'] ?>">
                        <?= $listeclient['NomClient'] ?>
                    </option>
                    <?php
                        }
                    ?>
                </select>
                <br><br>
                <label for="">Mode de Paiement :</label>
                <select name="s_modepaiement" id="listmode">
                    <?php
                        foreach ($donnee2 as $listemode){
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