<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <!-- L'en-tete -->
    <?php include('header.php'); ?>

    <!-- Le corp de la page -->
    <form class="connexion" action="formulaire_connexion.php" method="POST">
        <div>
            <p>SE CONNECTER</p>
            <h4>
            <?php
            error_reporting(0);
            session_start();
            session_destroy();
            echo $_SESSION['connexionMessage'];
            ?>
            </h4>
            <input type="text" name="username" placeholder="Nom" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">CONNEXION</button>
        </div>
    </form>
</body>
</html>