<?php

$pdo = new PDO("mysql:host=localhost;dbname=php_projet;charset=utf8","root","",[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);


if (!isset($_GET['id'])) {
    die("ID du joueur manquant.");
}

$id = $_GET['id'];


if (isset($_POST['confirmer'])) {

    $sql = "DELETE FROM joueur WHERE Id_Joueur = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header("Location: afficher_joueurs.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer joueur</title>
    <link rel="stylesheet" href="supprimer_joueur.css">
</head>
<body>


<h1>Supprimer un joueur</h1>

<div class="confirm-card">
    <p class="warning-text"> Voulez-vous vraiment supprimer ce joueur ?</p>

    <form method="post" class="confirm-actions">
        <input type="submit" name="confirmer" value="Oui, supprimer" class="btn-danger">
        <a href="afficher_joueurs.php" class="btn-cancel">Annuler</a>
    </form>
</div>

</body>
</html>
