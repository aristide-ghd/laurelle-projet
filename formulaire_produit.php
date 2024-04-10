<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form_prod.css">
    <title>Formulaire des produits</title>
</head>
<body>
<?php include 'navbar/navbar.php'; ?>

    <section>
        <h1 class="ajout">Ajouter une transaction</h1>
        <form action="valider_transaction.php" method="post">
            <fieldset>
                <legend>Produit</legend>
                <label for="">Nom du Produit :</label>
                <input type="text" name="s_nomproduit" class="nom">
                <br><br>
                <label for="">Description du Produit :</label>
                <input type="text" name="s_descriptionproduit" class="description">
                <br><br>
                <label for="">Prix de vente :</label>
                <input type="text" name="s_prixvente" class="prix">
                <br><br>
                <label for="">Cout unitaire :</label>
                <input type="text" name="s_coutunit" class="cout">
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