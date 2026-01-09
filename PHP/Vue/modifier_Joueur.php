<?php
require_once '../modele/connexionBD.php'; 

$connectionBD = new ConnectionBD();
$pdo = $connectionBD->getConnection();

// récupérer l'id
$id = $_GET['id'] ?? null;
if (!$id) {
    die("Joueur introuvable");
}

// récupérer le joueur
$sql = "SELECT * FROM joueur WHERE Id_Joueur = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$joueur = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$joueur) {
    die("Joueur non trouvé");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/modifier_Joueur.css">
</head>
<body>
   <nav>
    <ul>
        <li><a href="afficher_joueurs.php">Joueurs</a></li>
        <li><a href="menu.php">Menu</a></li>
    </ul>
</nav>

<h1>Modifier le joueur</h1>

    <div class="form-container">
        <form action="" method="post">

            <input type="hidden" name="id" value="<?= $joueur['Id_Joueur'] ?>">

            <label>Nom</label>
            <input type="text" value="<?= $joueur['nom'] ?>" readonly>

            <label>Prénom</label>
            <input type="text" value="<?= $joueur['prenom'] ?>" readonly>

            <label>Numéro licence</label>
            <input type="text" value="<?= $joueur['numero_licence'] ?>" readonly>

            <label>Date naissance</label>
            <input type="date" value="<?= $joueur['date_naissance'] ?>" readonly>

            <hr>

            <label>Taille</label>
            <input type="number" step="0.01" name="taille" value="<?= $joueur['taille'] ?>">

            <label>Poids</label>
            <input type="number" step="0.01" name="poids" value="<?= $joueur['poids'] ?>">

            <label>Statut</label>
            <input type="text" name="statut" value="<?= $joueur['statut'] ?>">

            <label>Poste préféré</label>
            <input type="text" name="poste_preferer" value="<?= $joueur['poste_preferer'] ?>">

            <input type="submit" name="action" value="Valider">
            <input type="submit" name="action" value="Annuler">

        </form>
    </div>

    
</body>
</html>


<?php

$connectionBD = new ConnectionBD();
$pdo = $connectionBD->getConnection();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action'])) {

    if ($_POST['action'] === "Valider") {

        $id = $_POST['id'];
        $nouveauStatut = $_POST['statut'];
        $nouveauPostePref = $_POST['poste_preferer'];
        $nouvelleTaille = (float) $_POST['taille'];
        $nouveauPoids = (float) $_POST['poids'];

        $sql = "UPDATE joueur 
                SET statut = ?, poste_preferer = ?, taille = ?, poids = ?
                WHERE Id_Joueur = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $nouveauStatut,
            $nouveauPostePref,
            $nouvelleTaille,
            $nouveauPoids,
            $id
        ]);

        header("Location: afficher_joueurs.php");
        exit();
    }
    elseif ($_POST['action'] === "Annuler") {
        header("Location: afficher_joueurs.php");
        exit();
    }
}
?>

