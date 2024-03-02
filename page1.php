<?php
    include('connexion.php');
    $req = "SELECT * FROM enregistrement";
    $reponse = $bdd -> query($req);
    $donnee = $reponse -> fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="somme.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .title, nav
        {
            display: inline-flex;
            flex-wrap: wrap;
        }
        .title a
        {
            color: white;
            text-decoration: none;
        }
        li 
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
        .evene
        {
            text-decoration: none;
            font-weight: bold;
            color: orange;
        }
        .gestion
        {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        .trans:hover, .gestion:hover
        {
            color: orange;
        }
        header
        {
            background-color: #333;
            width: 100%;
            margin-top: -8px;
            padding-bottom: 10px;
            padding-right: 16px;
            margin-left: -8px;
        }
        .title
        {
            border: 0px solid black;
            margin-left: 15%;
        }
        nav 
        {
            border: 0px solid black;
            margin-left: 13%;
        }
        table
        {
            width: 700px;
            text-align: left;
            background-color: #fff;
            margin-left: 24%;
            margin-top: 3%;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        body
        {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f4f4;
        }
        th, td 
        {
            padding: 3px;
            border: 1px solid #ddd;
        }
        th 
        {
            background-color: #f2f2f2;
        }
        tbody a
        {
            text-decoration: none;
        }
        .btn{
            cursor: pointer;
            border:1px solid grey;
            width: 60px;
            height: 20px;
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
    <table>
        <thead>
            <tr>
                <th>Matricule</th>
                <th>Date</th>
                <th>Description</th>
                <th>Type</th>
                <th>Montant</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($donnee as $liste){
            ?>
            <tr>
                <td ><?= $liste['idenreg'] ?></td>
                <td><?= $liste['datenreg'] ?></td>
                <td><?= $liste['descriptionenreg'] ?></td>
                <td id="typedonnee"><?= $liste['typenreg'] ?></td>
                <td id="montant"><?= $liste['montantenreg'] ?></td>
                <td><?= $liste['categorienreg'] ?></td>
                <td>
                    <button>
                        <a href="modifier.php?id=<?= $liste['idenreg'] ?>">Modifier</a>
                    </button>
                    <button>
                        <a href="supprimer.php?id=<?= $liste['idenreg'] ?>"
                            onclick="return confirm('Voulez-vous supprimer cet enregistrement?')">Supprimer</a>
                    </button>
                </td>
            </tr>
            <?php
                }
            ?>
        </tbody>   
    </table>
</body>

</html>