<?php
session_start();

// Si la variable 'auth' n'existe pas ou n'est pas vraie, on dégage l'intrus
if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    header("Location: Connexion.php");
    exit();
}
require_once '../modele/DaoJoueur.php';

// Vérification ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: afficher_joueurs.php');
    exit;
}

$id = $_GET['id'];
$dao = new JoueurDAO();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmer'])) {
    echo "ID à supprimer = " . $id;
    $dao->delete($id);
    header('Location: afficher_joueurs.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer joueur</title>
    <link rel="stylesheet" href="CSS/supprimer_joueur.css">
</head>
    <body>
        <?php include 'nav.php'; ?>
        <h1>Supprimer un joueur</h1>

        <div class="confirm-card">
            <p class="warning-text">
                ⚠️ Voulez-vous vraiment supprimer ce joueur ?
            </p>

            <form method="post" class="confirm-actions">
                <input type="submit" name="confirmer" value="Oui, supprimer" class="btn-danger">
                <a href="afficher_joueurs.php" class="btn-cancel">Annuler</a>
            </form>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>
