<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>>Ajouter un Match</title>
</head>
<body>
    <form action="../controleur/ajouterMatch.php" method="POST">
        <label for="matche">Ajouter un match :</label><br><br>

        <label for="IdM">Identifiant du match (ex: M001) :</label>
        <input type="text" id="IdM" name="IdM" required><br><br>

        <label for="DateM">Date de match :</label>
        <input type="Date" id="DateM" name="DateM" required><br><br>

        <label for="HeureM">Heure de matche : </label>
        <input type="time" id="HeureM" name="HeureM" required><br><br>
        
        <label for="Adnv">Adversaire : </label> 
        <input type="text" id="Adv" name="Adv" required><br><br>
        
        <label for="Lieu">Lieu de matche : </label>
        <input type="text" id="LieuM" name="LieuM" required><br><br>
        
        <label for="Result">Résultat de matches : </label>
        <input type="text" id="Result" name="Result"><br><br>
        
        <input type="submit" value="Ajouter">
        <input type="reset" value="Vider">
        <a href="menuPrincipale.php"><button type="button">Accueil</button></a>    </form>
</body>
</html>