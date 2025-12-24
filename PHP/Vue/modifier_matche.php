<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" methode="POST">
        <label for="matche">modifier le matche :</label><br><br>
        <label for="DateM">Date de matche :</label>
        <input type="Date" id="DateM" name="DateM" required><br><br>
        <label for="HeureM">Heure de matche : </label>
        <input type="time" id="HeureM" name="HeureM" required><br><br>
        <label for="Adnv">Adversaire : </label> 
        <input type="text" id="Adv" name="Adv" required><br><br>
        <label for="Lieu">Lieu de matche : </label>
        <input type="text" id="LieuM" name="LieuM" required><br><br>
        <label for="Result">Résultat de matches : </label>
        <input type="text" id="Result" name="Result" required><br><br>
        
        <input type="submit" value="Ajouter">
        <input type="submit" value="Vider">
        <input type="submit" value="Accueil">
        
    </form>
</body>
</html>

<?php
--"faudra mettre la possibilité d'évaluer chaque joueur dans cette page "
?>
