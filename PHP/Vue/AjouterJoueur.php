<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action=""  methode="post">
        <label for="joueur">Ajouter un jour de match :</label><br><br>
        <label for="Nom">NOM : </label>
        <input type="text" id="Nom" name="Nom" required><br><br>
        <label for="Prenom">Prenom : </label>
        <input type="text" id="Prenom" name="Prenom" required><br><br>
        <label for="NumLicence">Numéro de licence</label>
        <input type="text" id="NumLicence" name="NumLicence" required><br><br>
        <label for="DateNaissance">Date de naissance : </label>
        <input type="Date" id="DateNaiss" name="DateNaiss" required><br><br>
        <label for="Taille">Taille : </label>
        <input type="text" id="Taille" name="Taille" required><br><br>
        <label for="Poids">Poids : </label>
        <input type="text" id="Poids" name="Poids" required><br><br>
        <label for="Status">Status</label>
        <input type="text" id="Status" name="Status" required><br><br>
        <label for="PostePrf">poste préféré</label>
        <input type="text" id="PostePrf" name="PostePrf" required><br><br>
        <input type="submit" value="Ajouter">
        <input type="submit" value="Vider">
        <form action="menuPrincipale.php" method="">
            <input type="submit" value="Accueil">
        </form>
</body>
</html>

<?php

$user = 'ETU';
	$pass = 'PHPKenny2025*';
    if (!empty($_POST["Nom"]) && !empty($_POST["Prenom"]) && !empty($_POST["NumLicence"]) 
        && !empty($_POST["DateNaiss"]) && !empty($_POST["Taille"]) && !empty($_POST["Poids"])
        && !empty($_POST["Status"]) && !empty($_POST["PostePrf"])){

            $nom = $_POST["Nom"];
            $prenom = $_POST["Prenom"];
            $numLicence = $_POST["NumLicence"];
            $DateNaiss = $_POST["DateNaiss"];
            $Taille = $_POST["Taille"];
            $poids = $_POST["Poids"];
            $status = $_POST["Status"];
            $poste = $_POST["PostePrf"];

            try {
			$linkpdo = new PDO("mysql:host=localhost;dbname=basketball;charset=utf8", $user, $pass);
		}
		//2. capture erreur eventuelles
		catch (Exception $e){
		die('Erreur : ' . $e->getMessage());
		}
        }