<?php
$Server = "localhost";
//$User = "e2103710";
//$Pwd = "Kve544gv";
$User = "root";
$Pwd = "";
$DB = "e2103710";

$bdd = mysqli_connect($Server, $User, $Pwd, $DB);
    if(!$bdd)
        echo "Connexion à la base impossible";

$sql = "SELECT * FROM member";
$result = mysqli_query($bdd, $sql);

$recherche = "";
if(isset($_GET['search'])){
    $recherche = htmlspecialchars($_GET['search']);
    $result = $bdd->query('SELECT * FROM member WHERE Name LIKE "%'.$recherche.'%" OR FirstName LIKE "%'.$recherche.'%" OR Adress LIKE "%'.$recherche.'%"');
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
    <form method='GET'>
        <div class="searchbar">
            <img src="../images/banniere/searchbar.svg" class="icon"/>
            <input type="text" name="search" placeholder="Rechercher par nom, prénom ou email" value="<?= $recherche ?>">
        </div>
    </form>

    <div>
    
    </div>
    <div class="utilisateursHeader">
        <div class='nomUtilisateurs'>Nom/Prénom:</div>
        <div class='nomUtilisateurs'>Adresse mail:</div>
    </div> 
    <div class="utilisateurs">
    <a id='boutonEditer' href='ajouterCompteAdmin.php'>Ajouter</a>
    <?php
    while($Data = mysqli_fetch_array($result)){
        echo "<a class='utilisateursLigne' href='historiqueAdmin.php?user=".$Data['ID_Member']."'>";
        echo "<div class='nomUtilisateurs'>".$Data['Name']." ".$Data['FirstName']."</div>";
        echo "<div class='nomUtilisateurs'>".$Data['Adress']."</div>";
        echo "</a>";
    }
    ?>
    </div> 
</body>
</html>