<?php 
    // Activer l'affichage des erreurs
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start(); //Initialiser la session

    // Vérification si l'utilisateur est connecté
    if(!isset($_SESSION['logged_in'])) {
        // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
        header("Location: ../index.php");
        exit;
    }

    $motDePasse = $_SESSION['motDePasse'];
    $id_entreprise = $_SESSION['id_entreprise'];

    include("../connexion.php");

    //Utilisation de trim pour eliminer les espaces inutiles dans les entrées
    $current_password = trim($_POST['s_current_password']);
    $new_password = trim($_POST['s_new_password']);
    $confirm_password = trim($_POST['s_confirm_password']);

    //Vérification si les champs ne sont pas vides
    if (empty($current_password) || empty($new_password) || empty($confirm_password))
    {
        echo "<script>alert('Veuillez remplir tous les champs')</script>";
    }
    else
    {
        $req = "SELECT motDePasse FROM entreprise WHERE id_entreprise = :id_entreprise";
        $req = $bdd -> query($req);
        $req -> bindParam(':id_entreprise', $id_entreprise, PDO::PARAM_INT);
        $req -> execute();
        $donnee = $req -> fetch(PDO::FETCH_ASSOC);

        if (password_verify($current_password, $donnee['motDePasse']))
        {
            echo "<script>alert('')</script>";
        }
    }
?>