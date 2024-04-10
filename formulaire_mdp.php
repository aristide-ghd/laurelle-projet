<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form_mdp.css">
    <title>Formulaire du Mode de Paiement</title>
</head>
<body>
  
<?php include 'navbar/navbar.php'; ?>

  
    <section>
        <h1 class="ajout">Ajouter une transaction</h1>
        <form action="valider_transaction.php" method="post">
            <fieldset>
                <legend>Mode de Paiement</legend>
                <label for="">Nom Mode de Paiement :</label>
                <input type="text" name="s_nom_modepaiement" class="nom_mode">
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