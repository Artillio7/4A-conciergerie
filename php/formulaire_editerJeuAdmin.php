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

//Editer un jeu
$ID = $_GET['idJeu'];
$Nom = $_GET['nom'];
$Age = $_GET['age'];
$Type = $_GET['categorie'];
$Abstarct = $_GET['resume'];
$Multi = $_GET['multi'];
    
//Changer les info du jeu dans la BDD
$bdd->query("UPDATE game SET Name = '".$Nom."', Age = ".$Age.", Type = '".$Type."', Abstract = '".$Abstarct."', Multijoueur = '".$Multi."' WHERE ID_Game = ".$ID);

header("location:catalogueAdmin.php");
?>
