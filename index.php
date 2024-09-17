<?php
    session_start(); //Initialiser la session 
    include("connexion.php");
    $message = "";
    
    if(isset($_POST['valider']))
    {
        $nom = $_POST['s_name'];
        $mdp = $_POST['s_motdepasse'];
        if(empty($nom)||empty($mdp))
        {
            $message = "Veuillez remplir tous les champs";
        }
        else
        {
            $req = "SELECT * FROM entreprise WHERE namebusiness = '$nom' AND motdepasse = '$mdp'";
            $reponse = $bdd -> query($req);
            $donnee = $reponse -> fetchAll();
            
            if(!$donnee)
            {
                $message = "Paramètre de connexion invalide";
            }
            else
            {
                // Connexion réussie
                $_SESSION['logged_in'] = true;
                $_SESSION['user_name'] = $nom; //stockage du nom de l'utilisateur
                header("location: home.php");
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css/login.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>Page de connexion</title>
    <style>
        body {
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            font-family: 'Roboto', sans-serif;
        }
        .card {
            border: none;
            border-radius: 20px;
        }
        .card-body {
            background-color: #f8f9fa;
            border-radius: 20px;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
            border-radius: 50px;
            transition: background-color 0.3s ease-in-out;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .form-control {
            border-radius: 50px;
            padding: 15px;
        }
        .form-label {
            font-weight: bold;
        }
        .text-danger {
            font-size: 2rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container d-lg-flex d-md-block d-sm-block mt-5 my-md-4 py-lg-5 py-md-0 my-sm-4 justify-content-center">
        <div class="card shadow-lg p-3 mb-5 bg-body-tertiary rounded">
            <div class="row g-0">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <img class="img-fluid rounded-start h-100" src="image/connect.jpg" alt="Image de connexion">
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 d-flex align-items-center">
                    <div class="card-body p-5">
                        <h2 class="text-danger text-center mb-4"><i class="fas fa-sign-in-alt me-2"></i>Connectez-vous</h2>
                        <form action="index.php" method="post"> 
                            <?php if($message != ""): ?>
                                <div class="alert alert-danger" role="alert">
                                    <i class="fas fa-exclamation-triangle"></i> <?php echo $message; ?>
                                </div>
                            <?php endif; ?>
                            <fieldset>
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom de l'entreprise:</label>
                                    <input class="form-control" type="text" name="s_name" id="nom" placeholder="Entrez le nom" required>
                                </div>
                                <div class="mb-4">
                                    <label for="motdepasse" class="form-label">Mot de passe:</label>
                                    <input class="form-control" type="password" name="s_motdepasse" id="motdepasse" placeholder="Entrez votre mot de passe" required>
                                </div>
                            </fieldset>
                            <button class="btn btn-danger col-12" type="submit" name="valider"><i class="fas fa-lock me-2"></i>Se connecter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>