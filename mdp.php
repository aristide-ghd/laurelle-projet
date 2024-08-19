<?php
    include("connexion.php");
    $req = " SELECT * FROM modepaiement ";
    $reponse = $bdd -> query($req);
    $donnee = $reponse -> fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/tab_mdp.css">
    <title>Page Mode de Paiement</title>
</head>
<body>
    <?php include 'navbar/en_tete.php'; ?>
    <section>
        <table>
            <thead>
                <tr>
                    <th>Matricule Mode de Paiement</th>
                    <th>Nom Mode de Paiement</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($donnee as $liste){  
                ?>
                <tr>
                    <td><?= $liste['idModePaiement'] ?></td>
                    <td><?= $liste['NomModePaiement'] ?></td>
                    <td>
                        <button class="btn1">
                            <a href="modif_form_mdp.php?id=<?= $liste['idModePaiement'] ?>">Modifier</a>
                        </button>
                        <button class="btn2">
                            <a href="modif_form_mdp.php?id=<?= $liste['idModePaiement'] ?>"
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