<?php
    include('connexion.php');
    $matcli = $_GET['id'];
    $req = "SELECT * FROM clients where idClient= $matcli";
    $reponse = $bdd -> query($req);
    $donnee = $reponse -> fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form_cli.css">
    <title>Modifications des clients</title>
</head>
<body>
    <?php include 'navbar/en_tete.php'; ?>
    <section>
        <h1 class="ajout">Ajouter une transaction</h1>
        <form action="valider_modif_form.php" method="post">
            <fieldset>
                <legend>Client</legend>
                <?php
                    foreach($donnee as $liste){
                ?>
                <label for="">Matricule Client :</label>
                <input type="text" name="s_numero" class="matclient" value= "<?= $liste['idClient'] ?>">
                <br><br>
                <label for="">Nom du Client :</label>
                <input type="text" name="s_nomclient" class="nom" value= "<?= $liste['NomClient'] ?>">
                <br><br>
                <label for="">Adresse du client :</label>
                <input type="text" name="s_adresseclient" class="adresse" value= "<?= $liste['AdresseClient'] ?>">
                <br><br>
                <label for="">Coordonnées du Client :</label>
                <input type="text" name="s_coordonneesclient" class="coordonnees" value= "<?= $liste['CoordonneesClient'] ?>">
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