<?php
    include('connexion.php');
    $type = "";
    $mat = $_GET['id'];
    $req = "SELECT * FROM enregistrement Where idenreg = $mat";
    $reponse = $bdd -> query($req);
    $donnee = $reponse -> fetchAll();

    foreach($donnee as $enreg)
    {
        $type = $enreg['typenreg'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <style>
        .title, nav /*nom de l'entreprise et la navigation des liens au niveau de l'entête */
        {
            display: inline-flex;
            flex-wrap: wrap;
        }
        .title a /*lien pour le nom de l'entreprise */
        {
            color: white;
            text-decoration: none;
        }
        li /*disposition de la liste non numeroté pour les liens */
        {
            display: inline-flex;
            flex-wrap: wrap;
            margin-left: 30px;
        }
        .trans
        {
            text-decoration: none;
            font-weight: bold;
            color: white;
        }
        .evene /*lien evenements */
        {
            text-decoration: none;
            font-weight: bold;
            color: orange;
        }
        .gestion /*lien gestion */
        {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        .gestion:hover, .trans:hover /*au survol du lien gestion */
        {
            color: orange;
        }
        header /*l'en-tete */
        {
            background-color: #333;
            width: 100%;
            margin-top: -8px;
            padding-bottom: 10px;
            padding-right: 16px;
            margin-left: -8px;
        }
        .title /*le nom de l'entreprise */
        {
            border: 0px solid black;
            margin-left: 15%;
        }
        nav /*la navigation des liens de l'entete */
        {
            border: 0px solid black;
            margin-left: 13%;
        }
        body /*le corps de la page */
        {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f4f4;
        }


        form /*formulaire de modification */
        {
            margin-left: 23%;
            width: 800px;
        }
        fieldset /*le cadran du formulaire */
        {
            padding: 0px 20px 20px 20px;
            margin-bottom: 10px;
            border: 1px solid #df3f3f;
        }
        label /*le nom des champs du formulaire */
        {
            width: 200px;
            display: inline-block;
            vertical-align: top;
            margin: 6px;
        }
        .modif /*le titre du formulaire */
        {
            margin-left: 24%;
            margin-top: 3%;
        }
        .modif,legend /*titre et sous-titre du formulaire */
        {
            color: #df3f3f;
            font-weight: bold;
        }
        input,option,select
        {
            background-color: #fff3f3;
        }
        input,select
        {
            background-color: #fff3f3;
            padding: 3px;
            border: 1px solid #f5c5f5;
            border-radius: 5px;
            width: 250px;
            box-shadow: 1px 2px #c0c0c0 inset;
        }
        select
        {
            margin-top: 10px;
        }
        input[type=submit],input[type=reset] /*boutton de validation et de suppression */
        {
            width: 100px;
            margin-left: 5px;
            box-shadow: 1px 1px 1px #d83f3d;
            cursor: pointer;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <header>
        <h1 class="title"><a href="index.html">Homechip's Laure</a></h1>
        <nav>
            <ul>
                <li ><a href="index.html" class="trans">Transactions</a></li>
                <li ><a href="page1.php" class="evene">Evènements financiers</a></li>
                <li ><a href="page2.php" class="gestion">Gestion financière</a></li>
            </ul>
        </nav>
    </header>

    <h2 class="modif">Modification d'une transaction</h2>
    <form action="valider_modif.php" method="post">
        <fieldset>
            <legend>Transactions</legend>
            <br>
            <label for="">Matricule :</label>
            <input type="text" name="s_numero" value="<?= $enreg['idenreg']?>">
            <br><br>
            <label for="">Date :</label>
            <input type="date" name="s_date" value="<?= $enreg['datenreg']?>" >
            <br><br>
            <label for="">Description :</label>
            <input type="text" name="s_description" value="<?= $enreg['descriptionenreg']?>" >
            <br><br>
            <label for="">Type :</label>
            <select name="s_type" id="" required>
                <option value="depenses">Dépenses</option>
                <option value="recettes">Recettes</option>
            </select>
            <br><br>
            <label for="">Montant :</label>
            <input type="number" name="s_montant" value="<?= $enreg['montantenreg']?>">
            <br><br>
            <label for="">Catégorie :</label>
            <input type="text" name="s_categorie" value="<?= $enreg['categorienreg']?>">
        </fieldset>
        <br>
        <input type="submit" value="Enregistrer">
        <input type="submit" value="Annuler">
    </form>
</body>
</html>