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
        <input type="text" id="Nom" name="Nom" ><br><br>
        <label for="Prenom">Prenom : </label>
        <input type="text" id="Prenom" name="Prenom" ><br><br>
        <label for="NumLicence">Numéro de licence</label>
        <input type="text" id="NumLicence" name="NumLicence" ><br><br>
        <label for="DateNaissance">Date de naissance : </label>
        <input type="Date" id="DateNaiss" name="DateNaiss" ><br><br>
        <label for="Taille">Taille : </label>
        <input type="text" id="Taille" name="Taille"><br><br>
        <label for="Poids">Poids : </label>
        <input type="text" id="Poids" name="Poids" ><br><br>
        <label for="Status">Status</label>
        <input type="text" id="Status" name="Status" ><br><br>
        <label for="PostePrf">poste préféré</label>
        <input type="text" id="PostePrf" name="PostePrf"><br><br>
        <form action="menuPrincipale.php" method="GET">
        <input type="" value="">
</form>
        <input type="submit" value="Vider">
        <form action="menuPrincipale.php" method="GET">
            <input type="submit" value="Accueil">
        </form>
</body>
</html>

<?php

$user = 'ETU';
	$pass = 'PHPKenny2025*';
    if (!empty ($_POST["Id_Joueur"]) && !empty($_POST["Nom"]) && !empty($_POST["Prenom"]) && !empty($_POST["NumLicence"]) 
        && !empty($_POST["DateNaiss"]) && !empty($_POST["Taille"]) && !empty($_POST["Poids"])
        && !empty($_POST["Status"]) && !empty($_POST["PostePrf"])) {

        
            $Id_Joueur = $_POST["Id_Joueur"];
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

        $check = $linkpdo->prepare("SELECT * FROM contact WHERE NumLicence = :numLicence ");
		$check->execute(['numLicence' => $numLicence]);

		if ($check->rowCount() > 0) {
			echo " Ce contact existe déjà dans la base.";
		} else {
            $res = $linkpdo->prepare('insert into joueur (Id_Joueur, nom,prenom,numéro_licence, date_naissance, taille, poids,statut, poste_préferer)
			values(:Id_Joueur, :nom, :prenom, :numéro_licence, :date_naissance, :taille, :poids, :statut, :poste_préferer)');

            ///Exécution de la requête
			 $res->execute(array('id_contact' => $id_contact,
			'Id_Joueur'=> $Id_Joueur ,
            'nom'=>  $nom,
			'prenom'=>$prenom,
			'adresse'=>$adresse,
			'numLicence' => $numLicence,
			'DateNaissance' => $DateNaiss,
			'Taille' => $Taille,
            'poids' => $poids,
            'statuts' => $status,
            'post' => $poste )); 
        	echo "Contact ajouté";

		}
	}

?>
       