<?php
session_start();

if(!isset($_SESSION['username'])){
    header("location:../Connexion.php");
}
else if($_SESSION['usertype']=='user'){
    header("location:Connexion.php");
}

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="../style.css"> 
</head>
<body>
    <!-- L'en-tete -->
    <?php include('headerAdmin.php'); ?>

    <div class="Accueil">
        <div class="pres">
            <h1>JEUX & JOUEURS AU MEME ENDROIT</h1>
            <h3>Le plus grand magasin de jeux video du Mans !</h3>
            <a class="accueil-connexion" href="CatalogueAdmin.php">AJOUTEZ UN JEU !</a>
        </div>
        <div class="carousel">
            <img class="premiere img-carousel" src="../Images\Jeux\ACO.jpg">
            <img class="deuxieme img-carousel" src="../Images\Jeux\FH5.jpg">
            <img class="troisieme img-carousel" src="../Images\Jeux\Inscryption.jpg">
        </div>
    </div>

    <script src="../carousel.js"></script>
</body>
</html>
