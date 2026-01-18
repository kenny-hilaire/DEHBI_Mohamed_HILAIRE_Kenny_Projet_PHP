<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Calendrier des Matchs</title>
    <link rel="stylesheet" href="CSS/match.css">
</head>
<body>
     <nav>
        <ul>
            <li><a href="menuPrincipale.php">Accueil</a></li>
            <li><a href="afficher_matches.php">🏀Liste de match</a></li>
            <li><a href ="afficher_joueurs.php">👤Joueur</a></li>
            <li><a href ="statistique.php">📊Statistique</a></li>
            <li>
                <form action="deconnexion.php" method="post">
                    <input type="submit" name="Deconnexion" value="Deconnexion"> 
                </form>    
            </li>  
        </ul>
    </nav>

<h1>Calendrier des matchs</h1>

<?php 
require_once '../modele/connexionBD.php';
require_once '../modele/DaoMatch.php'; 

$connectionBD = new ConnectionBD();
$pdo = $connectionBD->getConnection();
$matchDAO = new MatchDAO(); 
$listeMatchs = $matchDAO->obtenirTous();

foreach ($listeMatchs as $match): ?>
<section class="match-card">
    <div class="match-date">
        <strong><?= date('D d M', strtotime($match['DATE_'])) ?></strong><br>
        <?= substr($match['HEURE'], 0, 5) ?>
    </div>

    <div class="match-opponent">
        VS <strong><?= htmlspecialchars($match['Nom_adversaire']) ?></strong>
    </div>

    <form action="" method="POST">
        <input type="hidden" name="id_match" value="<?= $match['Id_Match'] ?>">

        <input type="submit" name="action" value="Voir feuille du match">
        <input type="submit" name="action" value="Préparer la feuille de match">
        <input type="submit" name="action" value="Modifier le match">
        <input type="submit" name="action" value="Supprimer le match">
        <input type="submit" name="action" value="ajouter un match">

    </form>
</section>
<?php endforeach; ?>

<?php
       $matchDAO = new MatchDAO(); 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];
    $id_match = $_POST['id_match'];

    switch ($action) {
        case "Voir feuille du match":
            header("Location: VoirFeuilleMatch.php?id=" . $id_match);
            exit();

        case "Préparer la feuille de match":
            header("Location:PreparerFeuilleDeMatch.php?id=" . $id_match);
            exit();

        case "Modifier le match":
            header("Location: modifier_match.php?id=" . $id_match);
            exit();

        case "Supprimer le match":
            $matchDAO->delete($id_match); // Assure-toi que delete accepte l'ID
            header("Location: afficher_matches.php"); // Rafraîchir
            exit();
        
        case "ajouter un match":
             header("Location: AjouterMatche.php?id=" . $id_match);
            exit();
    }
}

$listeMatchs = $matchDAO->obtenirTous();
?>
