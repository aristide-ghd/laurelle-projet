<?php 
    include('connexion.php');
    $req = "SELECT * FROM clients";
    $reponse = $bdd -> query($req);
    $donnee = $reponse -> fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/tab_cli.css">
    <title>Page Client</title>
</head>
<body>
    <?php include 'navbar/en_tete.php'; ?>
    <section>
        <h1>Liste des clients avec qui vous communiquez</h1>
        <table>
            <thead>
                <tr>
                    <th>Matricule Client</th>
                    <th>Nom du Client</th>
                    <th>Adresse du Client</th>
                    <th>Coordonnées du Client</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($donnee as $liste){
                ?>
                <tr>
                    <td><?= $liste['idClient'] ?></td>
                    <td><?= $liste['NomClient'] ?></td>
                    <td><?= $liste['AdresseClient'] ?></td>
                    <td><?= $liste['CoordonneesClient'] ?></td>
                    <td>
                        <button class="btn1">
                            <a href="modif_form_client.php?id=<?= $liste['idClient'] ?>">Modifier</a>
                        </button>
                        <button class="btn2">
                            <a href="modif_form_client.php?id=<?= $liste['idClient'] ?>"
                                onclick= "return confirm('Voulez-vous supprimez cet enregistrement?')">Supprimer</a>
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