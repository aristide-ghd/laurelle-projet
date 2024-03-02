<?php 
    $connexion= include("connexion.php");

    $req1 = "SELECT sum(montantenreg) as somme_depenses from enregistrement where typenreg='depenses'";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            color: white;
        }
        .gestion
        {
            color: orange;
            text-decoration: none;
            font-weight: bold;
        }
        .trans:hover, .evene:hover
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
        body
        {
            background-color: #f4f4f4;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
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
        <tr>
            <td>Type</td>
            <td>Total</td>
        </tr>
        <tr>
            <th>Recettes</th>
            <th>
            </th>
        </tr>
        
        <tr>
            <th>Dépenses</th>
            <th>
                <?php
                    
                ?>
            </th>
        </tr>
    </table>
</body>
</html>