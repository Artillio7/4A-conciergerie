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

$ID = $_GET['jeu'];

$sql = "SELECT * FROM game WHERE ID_Game ='".$ID."'";
$result = mysqli_query($bdd, $sql);
$ligne = mysqli_fetch_array($result);

$Nom = $ligne['Name'];
$Age = $ligne['Age'];
$Type = $ligne['Type'];
$Abstarct = $ligne['Abstract'];

$sql = "SELECT * FROM stock WHERE ID_Game ='".$ID."'";
$result = mysqli_query($bdd, $sql);
$stock = mysqli_fetch_array($result);
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
            <img src='../Images/Jeux/<?php echo $ligne['Image'] ?>'>
            <div class="editerJeux">
                <div class="editerDetails">
                    <p>Titre: <input type="text" name="nom" form="formEditer" value="<?php echo htmlentities($Nom);?>" required minlength="1" required></p>
                    <p>Age: <input type="number" name="age" form="formEditer" value="<?php echo htmlentities($Age);?>" min="3" max="18" required></p>
                    <p>Catégorie: <input type="text" name="categorie" form="formEditer" value="<?php echo htmlentities($Type);?>" required minlength="1" required></p>
                    <p><textarea name="resume" form="formEditer"><?php echo htmlentities($Abstarct);?></textarea></p>
                    <p id="editerMulti">Multijoueur:&nbsp<select name="multi" form="formEditer" required>
                        <option value="oui" <?php if(null != ($ligne['Multijoueur']=="oui")) {echo'selected';} ?>>Oui</option>
                        <option value="non" <?php if(null != ($ligne['Multijoueur']=="non")) {echo'selected';} ?>>Non</option>
                    </select></p>
                </div>
                <div class="boutonSupprimer">
                    <button id='boutonOuvrirPopup'>ENREGISTRER</button>
                </div>
            </div>
    </div>

    <div class="popupReserver" id="popupReserver">
        <div class="popupHeader">
            <div>MODIFIER LE JEU :</div>
            <button id="boutonFermerPopup">&times</button>
        </div>
        <div class="popupForm">
            <form id="formEditer" action="formulaire_editerJeuAdmin.php" method="GET">
                <div>ETES VOUS SUR DE VOULOIR MODIFIER LE JEU</div>
                <input name="idJeu" type="hidden" value="<?php echo $ID;?>">
                <input class="" type="submit" name="submit" value="MODIFIER">
            </form>
        </div>
    </div>
    <div id="popupFond"></div>

<script src="../user/popupReserver.js"></script>
</body>
</html>
