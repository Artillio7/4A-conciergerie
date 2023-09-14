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

//Charger info sur l'emprunt
$IDJEU = $_GET['jeu'];
$IDUSER = $_GET['user'];
$date = date("Y-m-j");

//Mettre la date de retour dans la bdd
$bdd->query("UPDATE booking SET ReturnDate = '".$date."' WHERE ID_Game = ".$IDJEU." AND ID_Member = ".$IDUSER);

//Ajouter un jeu dans le stock
$sql = "SELECT * FROM stock WHERE ID_Game ='".$IDJEU."'";
$result = mysqli_query($bdd, $sql);
$stock = mysqli_fetch_array($result);

$cptStock = $stock['Available'] + 1;
$bdd->query("UPDATE stock SET Available = '".$cptStock."' WHERE ID_Game = ".$IDJEU);

header("location:historiqueAdmin.php?user=".$IDUSER);

?>
