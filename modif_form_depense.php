<?php
    include("connexion.php");
    $matdep = $_GET['id'];
    $req1 = "SELECT * FROM depenses where idDepense = $matdep";
    $reponse1 = $bdd -> query($req1);
    $donnee1 = $reponse1 -> fetchAll();

    foreach($donnee1 as $liste)
    {
        $mdp = $liste['idModePaiement'];
    }

    $req = " SELECT * FROM modepaiement ORDER BY idModePaiement";
    $reponse = $bdd -> query($req);
    $donnee = $reponse -> fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form_dep.css">
    <title>Modifications des dépenses</title>
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
                <legend>Dépense</legend>
                <label for="">Matricule Dépense :</label>
                <input type="text" name="s_numero" class="matdep" value= "<?= $liste['idDepense'] ?>">
                <br><br>
                <label for="">Montant de Dépense :</label>
                <input type="text" name="s_montantdepense" class="montant" value= "<?= $liste['MontantDepense'] ?>">
                <br><br>
                <label for="">Date de Dépense :</label>
                <input type="date" name="s_datedepense" class="date" value= "<?= $liste['DateDepense'] ?>">
                <br><br>
                <label for="">Description de Dépense :</label>
                <input type="text" name="s_descriptiondepense" class="description" value= "<?= $liste['DescriptionDepense'] ?>">
                <br><br>
                <label for="">Mode de Paiement :</label>
                <select name="s_modepaiement" id="listmode">
                    <?php
                            foreach ($donnee as $listemode)
                            {
                                if($listemode['idModePaiement'] == $mdp)
                                {?>
                                    <option selected value="<?= $listemode['idModePaiement'] ?>">
                                                            <?= $listemode['NomModePaiement'] ?>
                                    </option>
                    <?php       }
                                else
                                {?>
                                    <option value="<?= $listemode['idModePaiement'] ?>">
                                                    <?= $listemode['NomModePaiement'] ?>
                                    </option>
                    <?php       }
                            }?>
                </select>
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