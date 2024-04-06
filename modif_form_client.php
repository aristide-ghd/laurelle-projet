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
    <link rel="stylesheet" href="form_cli.css">
    <title>Modifications des clients</title>
</head>
<body>
    <header>
        <nav>
            <div class="title">
                <a href="index.html">Homechip's Laure</a>
            </div>
            <div class="block_navigation">
                <ul class="navigation">
                    <li ><a href="index.html" class="accueil">Accueil</a></li>
                    <li >
                        <a href="#" class="trans">Transactions<span class="arrow-down"></span></a>
                        <ul class="liste_transaction">
                            <li id="form_prod"><a href="formulaire_produit.html">Formulaire Produits</a></li><br>
                            <li id="form_cli"><a href="formulaire_client.html">Formulaire Clients</a></li><br>
                            <li id="form_ven"><a href="formulaire_vente.php">Formulaire Ventes</a></li><br>
                            <li id="form_rec"><a href="formulaire_recette.php">Formulaire Recettes</a></li><br>
                            <li id="form_dep"><a href="formulaire_depense.php">Formulaire Dépenses</a></li><br>
                            <li id="form_mdp"><a href="formulaire_mdp.html">Formulaire Mode de Paiement</a></li><br>
                        </ul>
                    </li>   
                    <li >
                        <a href="#" class="evene">Evènements financiers</a><span id="arrow-down"></span>
                        <ul class="liste_evenement">
                            <li><a href="produit.php">Produits</a></li><br>
                            <li><a href="client.php">Clients</a></li><br>
                            <li><a href="vente.php">Ventes</a></li><br>
                            <li><a href="recette.php">Recettes</a></li><br>
                            <li><a href="depense.php">Dépenses</a></li><br>
                            <li><a href="mdp.php">Mode de Paiement</a></li><br>
                        </ul>
                    </li>
                    <li ><a href="gestion.html" class="gestion">Gestion financière</a></li>
                </ul>
            </div> 
        </nav>
    </header>
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