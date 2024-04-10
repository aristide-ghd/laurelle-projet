<?php
    include("connexion.php");
    $req = " SELECT * FROM recettes ";
    $reponse = $bdd -> query($req);
    $donnee = $reponse -> fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tab_rec.css">
    <title>Page Recette</title>
</head>
<body>
<?php include 'navbar/navbar.php'; ?>

    <section>
        <h1>Liste de vos recettes</h1>
        <table>
            <thead>
                <tr>
                    <th>Matricule Recette</th>
                    <th>Montant de Recette</th>
                    <th>Date de Recette</th>
                    <th>Description de Recette</th>
                    <th>Matricule Mode de Paiement</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($donnee as $liste){  
                ?>
                <tr>
                    <td><?= $liste['idRecette'] ?></td>
                    <td><?= $liste['MontantRecette'] ?></td>
                    <td><?= $liste['DateRecette'] ?></td>
                    <td><?= $liste['DescriptionRecette'] ?></td>
                    <td><?= $liste['idModePaiement'] ?></td>
                    <td>
                        <button class="btn1">
                            <a href="modif_form_recette.php?id=<?= $liste['idRecette'] ?>">Modifier</a>
                        </button>
                        <button class="btn2">
                            <a href="modif_form_recette.php?id=<?= $liste['idRecette'] ?>"
                                onclick="return confirm('Voulez-vous supprimer cet enregistrement?')">Supprimer</a>
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