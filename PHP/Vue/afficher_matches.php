<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Calendrier des Matchs</title>
    <link rel="stylesheet" href="match.css">
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
        VS <strong><?= $match['Nom_adversaire'] ?></strong>
    </div>

    <div class="match-location">
        📍 <?= $match['lieu_rencontre'] ?>
    </div>

    <div class="match-result">
        Résultat : <?= $match['resultat'] ?? 'À venir' ?>
    </div>

    <input type="submit" name="action" value="Voir feuille du match">
        <input type="submit" name="action" value="Préparer la feuille de match">
        <input type="submit" name="action" value="Modifier le match">
        <input type="submit" name="action" value="Supprimer le match">

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $action = $_POST['action'];

                switch ($action) {
                    case "Voir feuille du match":
                        header("Location: VoirFeuilleMatch.php");
                        exit();

                    case "Préparer la feuille de match":
                        header("Location: PreparerFeuilleMatch.php");
                        exit();

                    case "Modifier le match":
                        header("Location: modifier_match.php");
                        exit();

                    case "Supprimer le match":
                        $matchDAO->delete($match);
                        exit();

                }
            }
        ?>

    </form>

</section>
<input type="submit" name="action" value="Ajouter un match">

<?php endforeach; ?>

</body>
</html>


