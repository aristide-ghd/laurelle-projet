<?php
    include('connexion.php');
    $req= "SELECT * FROM produits";
    $reponse= $bdd -> query($req);
    $donnee= $reponse -> fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/tab_prod.css">
    <title>Page Produit</title>
</head>
<body>
    <?php include 'navbar/en_tete.php'; ?>
    <section>
        <h1>Voici une liste de vos produits</h1>
        <table>
            <thead>
                <tr>
                    <th>Matricule Produit</th>
                    <th>Nom du produit</th>
                    <th>Description du Produit</th>
                    <th>Prix de Vente</th>
                    <th>Cout Unitaire</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($donnee as $liste){ 
                ?>
                <tr>
                    <td><?= $liste['idProduit'] ?></td>
                    <td><?= $liste['NomProduit'] ?></td>
                    <td><?= $liste['DescriptionProduit'] ?></td>
                    <td><?= $liste['PrixVente'] ?></td>
                    <td><?= $liste['CoutUnitaire'] ?></td>
                    <td>
                        <button class="btn1">
                            <a href="modif_form_prod.php?id=<?= $liste['idProduit'] ?>">Modifier</a>
                        </button>
                        <button class="btn2">
                            <a href="modif_form_prod.php?id=<?= $liste['idProduit'] ?>"
                                onclick="return confirm('Voulez-vous supprimez ce enregistrement?')">Supprimer</a>
                        </button>
                    </td>
                </tr>
                <?php 
                    }
                ?>
            </tbody>
        </table>
    </section>
    <div class="footer">
        <p>Copyright © 2024 Homechip's Laure | Tous droits réservés <br>
            Design by: <a href="https://ari-luxury.com">Ari-Luxury</a>
        </p>
    </div>
</body>
</html>