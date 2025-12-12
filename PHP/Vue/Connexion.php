<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de connexion</title>
    <link rel="stylesheet" href="connexion.css">
</head>
<body>
     <header>
        <nav>
            Page de connexion
        </nav>
    <div class="container">
            <h1>Connectez vous</h1>
            <label>Idientifiant</label>
            <input type="text" name="Identifiant" ><br>
            <label>Mot de passe</label>
            <input type="text" name="Mot_de_passe" ><br><br>
            <form action="menuPrincipale.php" method="get">
            <input type="submit" name="Connexion" ><br>
</form>

    </div>
    </header>

    <?php
     session_start();

    //mot de passe et identifiants autorisé
    $user = "hilaire";
    $passwd = "PhpProject2025*";

     if (!empty ($_POST['Idientifiant']) && !empty($_POST['Mot_de_passe']) && isset($_POST['Connexion'])){
        if ($_POST['Idientifiant'] == $user && $_POST['Mot_de_passe'] == $passwd){
            $_SESSION['auth'] = true;
            $_SESSION['log'] = $_POST['Idientifiant'];
        } else{
            $error = 'oups, vos identifiants sont invalidies, réesayez';
        } 
    }

    ?>
