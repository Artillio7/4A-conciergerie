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

$Result = $bdd->query('SELECT * FROM Game');

$age = 19;
$recherche = "";
$categorie = "";
$multi = "";
if(isset($_GET['search']) || isset($_GET['age']) || isset($_GET['categorie'])){
    $recherche = htmlspecialchars($_GET['search']);
    $age = htmlspecialchars($_GET['age']);
    $categorie = htmlspecialchars($_GET['categorie']);
    if(isset($_GET['multi'])){
        $multi = htmlspecialchars($_GET['multi']);
        $Result = $bdd->query('SELECT * FROM Game WHERE Name LIKE "%'.$recherche.'%" AND Age <= '.$age.' AND Type LIKE "%'.$categorie.'%" AND Multijoueur LIKE "%'.$multi.'%";');
    }else{
        $Result = $bdd->query('SELECT * FROM Game WHERE Name LIKE "%'.$recherche.'%" AND Age <= '.$age.' AND Type LIKE "%'.$categorie.'%";');
    }
    
}

//Pagination
$resultatsParPage = 10;
$nbResult = mysqli_num_rows($Result);
$nbPage = ceil($nbResult/$resultatsParPage);

if(!isset($_GET['page'])){
    $page = 1;
} else{
    $page = $_GET['page'];
}
$premierResult = ($page-1)*$resultatsParPage;

$Result = $bdd->query('SELECT * FROM Game LIMIT ' . $premierResult . ',' . $resultatsParPage);

if(isset($_GET['search']) || isset($_GET['age']) || isset($_GET['categorie'])){
    $recherche = htmlspecialchars($_GET['search']);
    $age = htmlspecialchars($_GET['age']);
    $categorie = htmlspecialchars($_GET['categorie']);
    if(isset($_GET['multi'])){
        $multi = htmlspecialchars($_GET['multi']);
        $Result = $bdd->query('SELECT * FROM Game WHERE Name LIKE "%'.$recherche.'%" AND Age <= '.$age.' AND Type LIKE "%'.$categorie.'%" AND Multijoueur LIKE "%'.$multi.'%" LIMIT '. $premierResult.','.$resultatsParPage);
    }else{
        $Result = $bdd->query('SELECT * FROM Game WHERE Name LIKE "%'.$recherche.'%" AND Age <= '.$age.' AND Type LIKE "%'.$categorie.'%" LIMIT '. $premierResult.','.$resultatsParPage);
    }
    
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
    <div class="filtre">
        <form method="GET">
            <div class="searchbar">
                <img src="../images/banniere/searchbar.svg" class="icon"/>
                <input type="text" name="search" placeholder="Rechercher un jeu" value="<?= $recherche ?>">
            </div>
            <div class="filtre2">
                <select name="age" onchange="this.form.submit()">
                    <option value="19" <?php if(null != ($age=="19")) {echo'selected';} ?>>Tous les ages</option>
                    <option value="3" <?php if(null != ($age=="3")) {echo'selected';} ?>>3 ans</option>
                    <option value="7" <?php if(null != ($age=="7")) {echo'selected';} ?>>7 ans</option>
                    <option value="13" <?php if(null != ($age=="13")) {echo'selected';} ?>>13 ans</option>
                    <option value="16" <?php if(null != ($age=="16")) {echo'selected';} ?>>16 ans</option>
                    <option value="18" <?php if(null != ($age=="18")) {echo'selected';} ?>>18 ans</option>
                </select>
                <select name="categorie" onchange="this.form.submit()">
                    <option value="" <?php if($categorie=="") {echo'selected';} ?>>Toutes les catégories</option>
                    <?php
                    $liste = $bdd->query('SELECT DISTINCT Type FROM Game');
                    while ($ligne = mysqli_fetch_array($liste)){
                        if(null != ($categorie==$ligne['Type'])){
                            echo "<option value=".$ligne['Type']." selected>".$ligne['Type']."</option>";
                        }else{
                            echo "<option value=".$ligne['Type'].">".$ligne['Type']."</option>";
                        } 
                    }
                    ?>
                </select>
                <div class="checkbox">Multijoueur: <input type="checkbox" name="multi" onchange="this.form.submit()" value="oui" <?php if(strpos($multi, "oui") !== false) {echo'checked="checked"';} ?>></div>
            </div>
        </form>
    </div>

    <?php
    echo "<div class='resultatRechercheAdmin'>";
    echo "<a href='ajouterJeuAdmin.php'>+</a>";
    echo "<div class='resultatRecherche2'>";
        while ($Data = mysqli_fetch_array ($Result) ) 
        { 
            //Affichage de chaque jeux en fonction de si ils sont en reserve ou non
            $sql = "SELECT * FROM stock WHERE ID_Game ='".$Data['ID_Game']."'";
            $result = mysqli_query($bdd, $sql);
            $stock = mysqli_fetch_array($result);
            $Available = $stock['Available'];
            if($Available <= 0){
                echo "<a class=\"imageJeux\" href=\"detailsAdmin.php?jeu=".$Data['ID_Game']."\" style=\"background-image: url('../Images/jeux/".$Data['Image']."')\";><img id='imageStock' src='..\Images\Banniere\stock.png'></a>";
            }else{
                echo "<a class=\"imageJeux\" href=\"detailsAdmin.php?jeu=".$Data['ID_Game']."\" style=\"background-image: url('../Images/jeux/".$Data['Image']."')\";></a>";
            }
        }
    echo "</div></div>
        <div class='pagination'>";
        if($page>1){
            echo "<a href='CatalogueAdmin.php?page=". $page-1 ."&search=".$recherche."&age=".$age."&categorie=".$categorie."&multi=".$multi."'>&laquo;</a>";
        }else{
            echo "<a href='#'>&laquo;</a>";
        }
        for($i=1; $i<=$nbPage; $i++){
            if($i==$page){
                echo "<a class='pageActive'>". $i ."</a>";
            } else{
                echo "<a href='CatalogueAdmin.php?page=". $i ."&search=".$recherche."&age=".$age."&categorie=".$categorie."&multi=".$multi."'>".$i."</a>";
            }
        }
        if($page<$nbPage){
            echo "<a href='CatalogueAdmin.php?page=". $page+1 ."&search=".$recherche."&age=".$age."&categorie=".$categorie."&multi=".$multi."'>&raquo;</a>";
        }else{
            echo "<a href='#'>&raquo;</a>";
        }
        echo "</div>";

    mysqli_close($bdd);
    ?>
</body>
</html>
