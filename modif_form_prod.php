<?php
    include('connexion.php');
    $matprod = $_GET['id'];
    $req = "SELECT * FROM produits where idProduit= $matprod";
    $reponse = $bdd -> query($req);
    $donnee = $reponse -> fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form_prod.css">
    <title>Modification des produits</title>
</head>
<body>
    <?php include 'navbar/en_tete.php'; ?>
    <section>
        <h1 class="ajout">Ajouter une transaction</h1>
        <form action="valider_modif_form.php" method="post">
            <fieldset>
                <legend>Produit</legend>
                <?php
                    foreach($donnee as $liste){ 
                ?>
                <label for="">Matricule Produit :</label>
                <input type="text" name="s_numero" class="matprod" value= "<?= $liste['idProduit'] ?>">
                <br><br>
                <label for="">Nom du Produit :</label>
                <input type="text" name="s_nomproduit" class="nom" value= "<?= $liste['NomProduit'] ?>">
                <br><br>
                <label for="">Description du Produit :</label>
                <input type="text" name="s_descriptionproduit" class="description" value= "<?= $liste['DescriptionProduit'] ?>">
                <br><br>
                <label for="">Prix de vente :</label>
                <input type="text" name="s_prixvente" class="prix" value= "<?= $liste['PrixVente'] ?>">
                <br><br>
                <label for="">Cout unitaire :</label>
                <input type="text" name="s_coutunit" class="cout" value= "<?= $liste['CoutUnitaire'] ?>">
                <?php
                    }
                ?>
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