<?php
    include("connexion.php");
    $req = " SELECT * FROM depenses ";
    $reponse = $bdd -> query($req);
    $donnee = $reponse -> fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/tab_dep.css">
    <title>Page Depense</title>
</head>
<body>
    <?php include 'navbar/en_tete.php'; ?>
    <section>
        <h1>Vos dépenses s'affichent ici</h1>
        <table>
            <thead>
                <tr>
                    <th>Matricule Depense</th>
                    <th>Montant de Dépense</th>
                    <th>Date de Dépense</th>
                    <th>Description de Dépense</th>
                    <th>Matricule Mode de Paiement</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($donnee as $liste){  
                ?>
                <tr>
                    <td><?= $liste['idDepense'] ?></td>
                    <td><?= $liste['MontantDepense'] ?></td>
                    <td><?= $liste['DateDepense'] ?></td>
                    <td><?= $liste['DescriptionDepense'] ?></td>
                    <td><?= $liste['idModePaiement'] ?></td>
                    <td>
                        <button class="btn1">
                            <a href="modif_form_depense.php?id=<?= $liste['idDepense'] ?>">Modifier</a>
                        </button>
                        <button class="btn2">
                            <a href="modif_form_depense.php?id=<?= $liste['idDepense'] ?>"
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