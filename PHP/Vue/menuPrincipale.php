<?php
session_start();
    
if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true ){
    header("Location: Connexion.php"); // ou index.php selon ton nom de page
    exit;
}

// si c'est la 1er fois que je viens mon compteur vaut 0
if (!isset($_SESSION['cpt1'])) {
    $_SESSION['cpt1'] = 0;
}
else {
    $_SESSION['cpt1']++;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion d'une équipe de sport</title>
    <link rel="stylesheet" href="CSS/menuPrincipale.css">
</head>
<body>
    <h1> Content de vous revoir coach, à vous de jouer maintenant!!</h1>
    <section class="menu">
        <div class= "feuilleMatch">
            <img src="PHOTO/feuilleMatch.jpg" alt="Liste/feuilleMatch" class="mp">
            <h3>Acceder à la LISTES des matchs svp</h3>   
            <form action="afficher_matches.php" method="GET">
                <input type="submit" value="Acceder">
            </form>        
        </div>
        <div class="listeJoueur">
        <img src="PHOTO/team.jpg" alt="Liste joueurs" class="mp">
            <h3>Acceder à votre liste de joueur</h3>
            <form action="afficher_joueurs.php" method="GET">
                <input type="submit" value="Acceder">
            </form>
        </div>
        <div class="statistique">
            <img src="PHOTO/stat.jpg" alt="stat joueurs" class="mp">
            <h3>Statistique de l'equipe</h3>
             <form action="statistique.php" method="GET">
                <input type="submit" value="Acceder">
            </form>
        </div>
</section>
</body>
</html>
<?php

?>

