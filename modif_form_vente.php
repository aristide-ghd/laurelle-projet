<?php
    include("connexion.php");
    $matvente = $_GET['id'];
    $req3 = "SELECT * FROM ventes where idVente = $matvente";
    $reponse3 = $bdd -> query($req3);
    $donnee3 = $reponse3 -> fetchAll();

    foreach($donnee3 as $liste)
    {
        $produit = $liste['idProduit'];
        $client = $liste['idClient'];
        $mdp = $liste['idModePaiement'];
    }

    $req = " SELECT * FROM produits ORDER BY idProduit";
    $reponse = $bdd -> query($req);
    $donnee = $reponse -> fetchAll();

    $req1 = " SELECT * FROM clients ORDER BY idClient";
    $reponse1 = $bdd -> query($req1);
    $donnee1 = $reponse1 -> fetchAll();

    $req2 = " SELECT * FROM modepaiement ORDER BY idModePaiement";
    $reponse2 = $bdd -> query($req2);
    $donnee2 = $reponse2 -> fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form_ven.css">
    <title>Modification des ventes</title>
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
                <legend>Vente</legend>
                <label for="">Matricule Vente :</label>
                <input type="text" name="s_numero" class="matvente" value= "<?= $liste['idVente'] ?>">
                <br><br>
                <label for="">Date de Vente :</label>
                <input type="date" name="s_datevente" class="date" value= "<?= $liste['DateVente'] ?>">
                <br><br>
                <label for="">Quantité Vendue :</label>
                <input type="text" name="s_quantitevendue" class="quantite" value= "<?= $liste['QuantiteVendue'] ?>">
                <br><br>
                <label for="">Montant Total :</label>
                <input type="text" name="s_montanttotal" class="montant" value= "<?= $liste['MontantTotal'] ?>">
                <br><br>
                <label for="">Produit :</label>
                <select name="s_produit" id="listproduit">
                    <?php
                            foreach ($donnee as $listeproduit)
                            {
                                if($listeproduit['idProduit'] == $produit)
                                {?>
                                    <option selected value="<?= $listeproduit['idProduit'] ?>">
                                                            <?= $listeproduit['NomProduit'] ?>
                                    </option>
                    <?php       }
                                else
                                {?>
                                    <option value="<?= $listeproduit['idProduit'] ?>">
                                                    <?= $listeproduit['NomProduit'] ?>
                                    </option>
                    <?php       }
                            }?>
                </select>
                <br><br>
                <label for="">Client :</label>
                <select name="s_client" id="listclient">
                    <?php
                            foreach ($donnee1 as $listeclient)
                            {
                                if($listeclient['idClient'] == $client)
                                {?>
                                    <option selected value="<?= $listeclient['idClient'] ?>">
                                                            <?= $listeclient['NomClient'] ?>
                                    </option>
                    <?php       }
                                else
                                {?>
                                    <option value="<?= $listeclient['idClient'] ?>">
                                                    <?= $listeclient['NomClient'] ?>
                                    </option>
                    <?php       }
                            }?>
                </select>
                <br><br>
                <label for="">Mode de Paiement :</label>
                <select name="s_modepaiement" id="listmode">
                    <?php
                            foreach ($donnee2 as $listemode)
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