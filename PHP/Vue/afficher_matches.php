<?php
session_start();

// Si la variable 'auth' n'existe pas ou n'est pas vraie, on dégage l'intrus
if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    header("Location: Connexion.php");
    exit();
}
// --- 1. TRAITEMENT DES ACTIONS (TOUT EN HAUT) ---
require_once '../modele/connexionBD.php';
require_once '../modele/DaoMatch.php'; 
require_once '../modele/DaoParticipe.php'; 

$connectionBD = new ConnectionBD();
$pdo = $connectionBD->getConnection();
$matchDAO = new MatchDAO(); 
$participeDAO = new ParticipeDAO(); 

// On traite l'action AVANT d'afficher le moindre HTML
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];
    $id_match = $_POST['id_match'] ?? null;

    switch ($action) {
        case "Voir feuille du match":
            header("Location: VoirFeuilleMatch.php?id=" . $id_match);
            exit();
        case "Préparer la feuille de match":
            header("Location: PreparerFeuilleDeMatch.php?id=" . $id_match);
            exit();
        case "Modifier le match":
            header("Location: modifier_match.php?id=" . $id_match);
            exit();
        case "Supprimer le match":
            if ($id_match) {
                $matchDAO->delete($id_match);
                // On redirige vers la même page avec un paramètre de succès
                header("Location: afficher_matches.php?delete_success=1");
                exit();
            }
        case "ajouter un match":
            header("Location: AjouterMatche.php"); 
            exit();
    }
}

// Récupération de la liste pour l'affichage plus bas
$listeMatchs = $matchDAO->obtenirTous();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Calendrier des Matchs</title>
    <link rel="stylesheet" href="CSS/listeMatch.css">
</head>
<body>
    <?php include 'nav.php'; ?>
    
    <h1>Calendrier des matchs</h1>

    <?php foreach ($listeMatchs as $match): 
        $dejaPrepare = $participeDAO->existeDeja($match['Id_Match']);
    ?>
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

            <?php if ($dejaPrepare): ?>
                <input type="button" value="Préparer la feuille de match" 
                       onclick="alert('Vous avez déjà préparé la feuille de ce match. Consultez-la pour la modifier.');"
                       style="background-color: #ccc; cursor: not-allowed;">
            <?php else: ?>
                <input type="submit" name="action" value="Préparer la feuille de match">
            <?php endif; ?>

            <input type="submit" name="action" value="Modifier le match">
            <input type="submit" name="action" value="Supprimer le match">
            <input type="submit" name="action" value="ajouter un match">
        </form>
    </section>
    <?php endforeach; ?>
    <?php include 'footer.php'; ?>

</body>
</html>