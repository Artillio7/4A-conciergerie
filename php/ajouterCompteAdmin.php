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

$type = "user";
if(isset($_POST['submit'])) {
    $nom = $_POST['nomUser'];
    $prenom = $_POST['prenomUser'];
    $email = $_POST['emailUser'];
    $password = $_POST['passwordUser'];
    $type = $_POST['typeUser'];

    $bdd->query("INSERT INTO member (Name, FirstName, Adress, usertype, password) VALUES ('".$nom."', '".$prenom."', '".$email."', '".$type."', '".$password."');");
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
    <form method="POST" enctype="multipart/form-data" >
        <div class="ajouterUtilisateur">
            <label>Nom: </label>
            <input type="text" name="nomUser" required minlength="1" required>
            <label>Prénom: </label>
            <input type="text" name="prenomUser" required minlength="1" required>
            <label>Mail: </label>
            <input type="email" name="emailUser" required minlength="1" required>
            <label>Mot de passe: </label>
            <input type="password" name="passwordUser" required>
            <label>Type de compte: </label>
            <select id="typeCompte" name="typeUser" required>
                <option value="user" <?php if(null != ($type=="user")) {echo'selected';} ?>>Utilisateur classique</option>
                <option value="admin" <?php if(null != ($type=="admin")) {echo'selected';} ?>>Admin</option>
            </select>
            <input id="boutonAjouterUtilisateur" type="submit" name="submit" value="AJOUTER UTILISATEUR">
        </div>
    </form>

</body>
</html>