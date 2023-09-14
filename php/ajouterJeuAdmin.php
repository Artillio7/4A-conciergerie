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

$multi = "oui";
if(isset($_POST['submit'])) {
    $couverture = $_FILES['file']['name']; 
    $nomJeu = htmlentities($_POST['nomJeu']);
    $age = $_POST['age'];
    $categorie = htmlentities($_POST['categorie']);
    $resume =htmlentities($_POST['resume']);
    $multi = $_POST['multi'];
    $nbJeux = $_POST['nbJeux'];

    $bdd->query("INSERT INTO Game (Name, Age, Type, Abstract, Image, Multijoueur) VALUES ('".$nomJeu."', ".$age.", '".$categorie."', '".$resume."', '".$couverture."', '".$multi."')");

    $ID = "SELECT ID_Game FROM game WHERE Name ='".$nomJeu."'";
    $result = mysqli_query($bdd, $ID);
    $ligne = mysqli_fetch_array($result);
    $bdd->query("INSERT INTO Stock VALUES (".$ligne['ID_Game'].", ".$nbJeux.", ".$nbJeux.")");

    //Mettre l'image de couverture dans le serveur
    $cheminImage = "../images/jeux/" . basename($_FILES["file"]["name"]);
    move_uploaded_file($_FILES["file"]["tmp_name"], $cheminImage);

    header("location:catalogueAdmin.php");
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
            <div class="ajouterCouverture"><input type="file" id ="couvertureJeu" name="file" form="formEditer" accept=".jpg, .jpeg, .png" required></div>
            <div class="ajouterJeux">
                <div class="editerDetails">
                    <p>Titre: <input type="text" name="nomJeu" form="formEditer" required minlength="1" required></p>
                    <p>Age: <input type="number" name="age" form="formEditer" min="3" max="18" required></p>
                    <p>Catégorie: <input type="text" name="categorie" form="formEditer" required minlength="1" required></p>
                    <p><textarea name="resume" form="formEditer">Description du jeu...</textarea></p>
                    <p id="editerMulti">Multijoueur:&nbsp<select name="multi" form="formEditer" required>
                        <option value="oui" <?php if(null != ($multi=="oui")) {echo'selected';} ?>>Oui</option>
                        <option value="non" <?php if(null != ($multi=="non")) {echo'selected';} ?>>Non</option>
                    </select></p>
                    <p>Nombre de jeux: <input type="number" name="nbJeux" form="formEditer" min="1"required></p>
                </div>
                <div class="boutonSupprimer">
                    <button id='boutonOuvrirPopup'>AJOUTER</button>
                </div>
            </div>
    </div>

    <div class="popupReserver" id="popupReserver">
        <div class="popupHeader">
            <div>AJOUTER LE JEU :</div>
            <button id="boutonFermerPopup">&times</button>
        </div>
        <div class="popupForm">
            <form id="formEditer" method="POST" enctype="multipart/form-data">
                <div>ETES VOUS SUR DE VOULOIR AJOUTER LE JEU</div>
                <input name="idJeu" type="hidden" value="<?php echo $ID;?>">
                <input class="" type="submit" name="submit" value="AJOUTER">
            </form>
        </div>
    </div>
    <div id="popupFond"></div>

<script src="../user/popupReserver.js"></script>
</body>
</html>