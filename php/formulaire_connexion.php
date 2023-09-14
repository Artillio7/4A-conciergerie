<?php
error_reporting(0);
session_start();

$Server = "localhost";
//$User = "e2103710";
//$Pwd = "Kve544gv";
$User = "root";
$Pwd = "";
$DB = "e2103710";

$data = mysqli_connect($Server, $User, $Pwd, $DB);
    if(!$data)
        echo "Connexion à la base impossible";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = $_POST["username"];
    $pass = $_POST["password"];

    $sql = "SELECT * FROM member WHERE Name ='".$name."' AND password='".$pass."' ";
    $result = mysqli_query($data, $sql);
    $row = mysqli_fetch_array($result);

    $IDM = $row['ID_Member'];

    if($row["usertype"]=="user"){
        $_SESSION['username'] = $name;
        $_SESSION['usertype'] = "user";
        $_SESSION['ID_Membre'] = $IDM;
        header("location:/ludotheque/user/AccueilUser.php");
    }
    else if($row["usertype"]=="admin"){
        $_SESSION['username'] = $name;
        $_SESSION['usertype'] = "admin";
        $_SESSION['ID_Membre'] = $IDM;
        header("location:/ludotheque/admin/AccueilAdmin.php");
    }
    else{
        $message = "Nom d'utilisateur ou mot de passe incorrect";
        $_SESSION['connexionMessage'] = $message;
        $_SESSION['ID_Membre'] = $IDM;
        header("location:Connexion.php");
    }
}

mysqli_close($data);
?>