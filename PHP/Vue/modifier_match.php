<?php
session_start();

// Si la variable 'auth' n'existe pas ou n'est pas vraie, on dégage l'intrus
if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    header("Location: Connexion.php");
    exit();
}
require_once '../modele/connexionBD.php';
require_once '../modele/DaoMatch.php';
require_once '../modele/Match.php'; // On inclut la classe Match_

$connectionBD = new ConnectionBD();
$pdo = $connectionBD->getConnection();
$matchDAO = new MatchDAO();

// On récupère l'ID du match
$idMatch = $_GET['id'] ?? $_POST['id_match'] ?? null;

if (!$idMatch) {
    header("Location: afficher_matches.php");
    exit();
}

$match = $matchDAO->findById($idMatch);

if (!$match) {
    die("Match introuvable.");
}

// TRAITEMENT DU FORMULAIRE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_modifier'])) {
    $nouvelleDate = $_POST['date_match'];
    $nouvelleHeure = $_POST['heure_match'];
    $nouveauResultat = $_POST['resultat_match'];

    // Création de l'objet avec les 6 arguments du constructeur
    // Ordre : ID, Date, Heure, Adversaire, Résultat, Lieu
    $objetMatch = new Match_(
        $idMatch, 
        $nouvelleDate, 
        $nouvelleHeure, 
        $match['Nom_adversaire'], 
        $nouveauResultat,
        $match['lieu_rencontre']
    );

    // Mise à jour via le DAO
    $matchDAO->updateInfo($objetMatch, $nouvelleDate, $nouvelleHeure, $nouveauResultat);
    
    header("Location: afficher_matches.php?status=updated");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le match</title>
    <link rel="stylesheet" href="CSS/modifierMatch.css">
</head>
<body>
    <?php include 'nav.php'; ?>
    
    <h2>Modifier le match : <?= htmlspecialchars($idMatch) ?></h2>

    <form action="" method="POST" class="form-container">
        <input type="hidden" name="id_match" value="<?= htmlspecialchars($idMatch) ?>">

        <p>
            <label>Adversaire :</label><br>
            <input type="text" value="<?= htmlspecialchars($match['Nom_adversaire']) ?>" disabled class="input-disabled">
        </p>

        <p>
            <label>Date du match :</label><br>
            <input type="date" name="date_match" value="<?= $match['DATE_'] ?>" required>
        </p>

        <p>
            <label>Heure :</label><br>
            <input type="time" name="heure_match" value="<?= substr($match['HEURE'], 0, 5) ?>" required>
        </p>

        <p>
            <label>Résultat du match :</label><br>
            <select name="resultat_match">
                <option value="A venir" <?= ($match['resultat'] == 'A venir') ? 'selected' : '' ?>>Match à venir</option>
                <option value="Victoire" <?= ($match['resultat'] == 'Victoire') ? 'selected' : '' ?>>Victoire</option>
                <option value="Défaite" <?= ($match['resultat'] == 'Défaite') ? 'selected' : '' ?>>Défaite</option>
                <option value="Nul" <?= ($match['resultat'] == 'Nul') ? 'selected' : '' ?>>Match Nul</option>
            </select>
        </p>

        <p>
            <label>Lieu :</label><br>
            <input type="text" value="<?= htmlspecialchars($match['lieu_rencontre']) ?>" disabled class="input-disabled">
        </p>

        <button type="submit" name="btn_modifier" class="btn-form-submit">
            Enregistrer les modifications
        </button>
        
        <div style="text-align: center; margin-top: 15px;">
            <a href="afficher_matches.php" class="link-annuler">Annuler</a>
        </div>
    </form>

    <?php include 'footer.php'; ?>
</body>
</html>