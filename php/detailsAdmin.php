<?php
if(isset($_GET['jeu'])){
    $Server = "localhost";
    //$User = "e2103710";
    //$Pwd = "Kve544gv";
    $User = "root";
    $Pwd = "";
    $DB = "e2103710";

    $bdd = mysqli_connect($Server, $User, $Pwd, $DB);
        if(!$bdd)
            echo "Connexion à la base impossible";

    $ID = $_GET['jeu'];

    $sql = "SELECT * FROM game WHERE ID_Game ='".$ID."'";
    $result = mysqli_query($bdd, $sql);
    $ligne = mysqli_fetch_array($result);

    $sql = "SELECT * FROM stock WHERE ID_Game ='".$ID."'";
    $result = mysqli_query($bdd, $sql);
    $stock = mysqli_fetch_array($result);

    //Supprimer un jeu
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['submit'])){
        //Supprimer le jeu des reservations
        $bdd->query("DELETE FROM booking WHERE ID_Game = ".$ID);
        //Supprimer le jeu des stock
        $bdd->query("DELETE FROM stock WHERE ID_Game = ".$ID);
        //Supprimer le jeu de la table game
        $bdd->query("DELETE FROM game WHERE ID_Game = ".$ID);

        header("location:catalogueAdmin.php");
    }
    
}else{
    header("location:CatalogueAdmin.php");
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Catalogue</title>
    <link rel="stylesheet" href="../style.css"> 
</head>
<body>
    <!-- L'en-tete -->
    <?php include('headerAdmin.php'); ?>

    <!-- Le corp de la page -->
    <div class="ficheJeu">
        <div>
            <?php echo "<a id='boutonEditer' href='editerJeuAdmin.php?jeu=".$ID."'>EDITER</a>"; ?>
            <img src='../Images/Jeux/<?php echo $ligne['Image'] ?>'>
        </div>
        <div class="detailsJeux">
            <div class="details1">
                <h1><?php echo $ligne['Name'] ?></h1>
                <p>Catégorie: <?php echo $ligne['Type'] ?></p>
                <p>Multijoueur: <?php echo $ligne['Multijoueur'] ?></p>
                <p><?php echo $ligne['Abstract'] ?></p>
            </div>
            <div class="details2">
                <p>Jeux en stock: <?php echo $stock['Available'] ?></p>
                <button id='boutonOuvrirPopup'>SUPPRIMER</button>
            </div>
        </div>
    </div>

    <div class="popupReserver" id="popupReserver">
        <div class="popupHeader">
            <div>SUPPRIMER LE JEU :</div>
            <button id="boutonFermerPopup">&times</button>
        </div>
        <div class="popupForm">
            <form method="POST">
                <div>ETES VOUS SUR DE VOULOIR SUPPRIMER LE JEU</div>
                <input class="" type="submit" name="submit" value="SUPPRIMER">
            </form>
        </div>
    </div>
    <div id="popupFond"></div>

<script src="../user/popupReserver.js"></script>
</body>
</html>
