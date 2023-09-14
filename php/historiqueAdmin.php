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

$IDUser = $_GET['user'];

$sql = "SELECT game.Name AS NameGame, booking.*, member.* FROM game INNER JOIN booking ON game.ID_Game=booking.ID_Game INNER JOIN member ON member.ID_Member=booking.ID_Member WHERE member.ID_Member = ".$IDUser." ORDER BY ReturnDate";
$result = mysqli_query($bdd, $sql);

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
    <div class="empruntsHeader">
        <div class='nomJeuEmprunts'>Nom/Prénom:</div>
        <div class='nomJeuEmprunts'>Jeu:</div>
        <div class='empruntsDate'>Date emprunt:</div>
        <div class='empruntsDate'>Date Limite:</div>
        <div class='empruntsDate'>Date de rendu:</div>
        <div class='empruntsDate'>Statut:</div>
    </div> 

    <div class="emprunts">
    <?php
    while($Data = mysqli_fetch_array($result)){
        echo "<div class='empruntsLigne'>";
        echo "<div class='nomJeuEmprunts'>".$Data['Name']." ".$Data['FirstName']."</div>";
        echo "<div class='nomJeuEmprunts'>".$Data['NameGame']."</div>";
        echo "<div class='empruntsDate' id='dateBordure' >".$Data['Date']."</div>";
        $dateLimite = $Data['Date'];
        //Conversion de la date du type str au type time 
        $dateLimite = strtotime($dateLimite);
        //Ajout de 1 mois à la date
        $dateLimite = strtotime("+1 month", $dateLimite);
        //Conversion au bon format (Année - Mois - Jours)
        $dateLimite = date("Y-m-d", $dateLimite);
        echo "<div class='empruntsDate' id='dateBordure'>".$dateLimite."</div>";
        echo "<div class='empruntsDate'>".$Data['ReturnDate']."</div>";
        //Ajout du bouton "rendre" et de la date de rendu en fonction de si le jeu est rendu ou non
        if($Data['ReturnDate'] == ""){
            echo "<a class='empruntsDate' href='formulaire_rendreJeuAdmin.php?user=".$Data['ID_Member']."&jeu=".$Data['ID_Game']."' name='boutonEmprunt'>RENDRE</a>";
        }else{
            echo "<div class='empruntsDate' id='empruntRendu'>RENDU</div>";
        }
        echo "</div>";
    }
    ?>
    </div> 
</body>
</html>