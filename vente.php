<?php
    include("connexion.php");
    $req = " SELECT * FROM ventes ";
    $reponse = $bdd -> query($req);
    $donnee = $reponse -> fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tab_ven.css">
    <title>Page Vente</title>
</head>
<body>
<?php include 'navbar/navbar.php'; ?>

    <section>
        <h1>Voici ci-joint une liste des ventes effectuées</h1>
        <table>
            <thead>
                <tr>
                    <th>Matricule Vente</th>
                    <th>Date de Vente</th>
                    <th>Quantité Vendue</th>
                    <th>Montant Total</th>
                    <th>Matricule Produit</th>
                    <th>Matricule Client</th>
                    <th>Matricule Mode de Paiement</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($donnee as $liste){  
                ?>
                <tr>
                    <td><?= $liste['idVente'] ?></td>
                    <td><?= $liste['DateVente'] ?></td>
                    <td><?= $liste['QuantiteVendue'] ?></td>
                    <td><?= $liste['MontantTotal'] ?></td>
                    <td><?= $liste['idProduit'] ?></td>
                    <td><?= $liste['idClient'] ?></td>
                    <td><?= $liste['idModePaiement'] ?></td>
                    <td>
                        <button class="btn1">
                            <a href="modif_form_vente.php?id=<?= $liste['idVente'] ?>">Modifier</a>
                        </button>
                        <button class="btn2">
                            <a href="modif_form_vente.php?id=<?= $liste['idVente'] ?>"
                                onclick="return confirm('Voulez-vous supprimez cet enregistrement?')">Supprimer</a>
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