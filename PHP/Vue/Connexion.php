<?php
session_start();

// Identifiants autorisés
$user = "HLKDH";
$passwd = "PhpProject2025";

$error = "";

if (isset($_POST['Connexion'])) {
    if (!empty($_POST['Identifiant']) && !empty($_POST['Mot_de_passe'])) {

        if ($_POST['Identifiant'] === $user && $_POST['Mot_de_passe'] === $passwd) {
            $_SESSION['auth'] = true;
            $_SESSION['login'] = $_POST['Identifiant'];

            // Redirection vers le menu principal
            header("Location:menuPrincipale.php");
            exit;
        } else {
            $error = "Identifiant ou mot de passe incorrect";
        }

    } else {
        $error = "Veuillez remplir tous les champs";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de connexion</title>
    <link rel="stylesheet" href="CSS/connec.css">
</head>
<body>
     <header>
        <nav>
        </nav>
        <div class="container">
                <h1>Connectez vous</h1>
                <form method="post">
            <label>Identifiant</label><br>
            <input type="text" name="Identifiant"><br><br>
            <label>Mot de passe</label><br>
            <input type="password" name="Mot_de_passe"><br><br>
            <input type="submit" name="Connexion" value="Connecter">
        </form>

        </div>
    </header>
</body>
</html>


