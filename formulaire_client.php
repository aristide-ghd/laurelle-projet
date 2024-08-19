<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form_cli.css">
    <title>Formulaire des clients</title>
</head>
<body>
    <?php include 'navbar/en_tete.php'; ?>
    <section>
        <h1 class="ajout">Ajouter une transaction</h1>
        <form action="valider_transaction.php" method="post">
            <fieldset>
                <legend>Client</legend>
                <label for="">Nom du Client :</label>
                <input type="text" name="s_nomclient" class="nom">
                <br><br>
                <label for="">Adresse du client :</label>
                <input type="text" name="s_adresseclient" class="adresse">
                <br><br>
                <label for="">Coordonnées du Client :</label>
                <input type="text" name="s_coordonneesclient" class="coordonnees">
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