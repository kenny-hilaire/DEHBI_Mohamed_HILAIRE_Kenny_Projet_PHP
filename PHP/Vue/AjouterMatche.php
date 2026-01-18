<?php
session_start();

// Si la variable 'auth' n'existe pas ou n'est pas vraie, on dégage l'intrus
if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    header("Location: connexion.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>>Ajouter un Match</title>
    <link rel="stylesheet" href="CSS/ajouterMatch.css">
</head>
<body>
    <?php include 'nav.php'; ?>

    <form action="../Controleur/ajouterMatch.php" method="POST" class="form-ajout">
        <label class="form-title">Ajouter un match</label><br><br>

        <label for="IdM">Identifiant du match (ex: M001) :</label>
        <input type="text" id="IdM" name="IdM" required>

        <label for="DateM">Date de match :</label>
        <input type="Date" id="DateM" name="DateM" required>

        <label for="HeureM">Heure de match : </label>
        <input type="time" id="HeureM" name="HeureM" required>
        
        <label for="Adv">Adversaire : </label> 
        <input type="text" id="Adv" name="Adv" required>
        
        <label for="LieuM">Lieu de match : </label>
        <input type="text" id="LieuM" name="LieuM" required>
        
        <label for="Result">Résultat (optionnel) : </label>
        <input type="text" id="Result" name="Result">
        
        <div class="form-buttons">
            <input type="submit" value="Ajouter" class="btn-submit-ajout">
            
            <input type="reset" value="Vider" class="btn-reset">
            
            <a href="menuPrincipale.php">
                <button type="button" class="btn-home">Accueil</button>
            </a>
        </div>
    </form>

    <?php include 'footer.php'; ?>
</body>
</html>