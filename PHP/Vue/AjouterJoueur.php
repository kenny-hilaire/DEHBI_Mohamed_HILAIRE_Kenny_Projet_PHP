<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action=""  method="post">
        <label for="joueur">Ajouter un jour de match :</label><br><br>

        <label for="Id_Joueur">ID Joueur : </label>
        <input type="text" id="Id_Joueur" name="Id_Joueur" required><br><br>

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
        <input type="reset" value="Vider">
        <a href="afficher_joueurs.php">
            <button type="button">Retour à la liste</button>
        </a>
            <a href="menuPrincipale.php">
            <button type="button">Retour à l'acceuil</button>
        </a>

</body>
</html>

<?php
$pdo = new PDO(
    "mysql:host=localhost;dbname=php_projet;charset=utf8",
    "root",
    "",
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

$erreur = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (
        !empty($_POST["Id_Joueur"]) &&
        !empty($_POST["Nom"]) &&
        !empty($_POST["Prenom"]) &&
        !empty($_POST["NumLicence"]) &&
        !empty($_POST["DateNaiss"]) &&
        !empty($_POST["Taille"]) &&
        !empty($_POST["Poids"]) &&
        !empty($_POST["Status"]) &&
        !empty($_POST["PostePrf"])
    ) {

        // Vérifier si l'ID existe déjà
        $check = $pdo->prepare("SELECT 1 FROM joueur WHERE Id_Joueur = ?");
        $check->execute([$_POST["Id_Joueur"]]);

        if ($check->fetch()) {
            $erreur = "⚠️ Cet ID joueur existe déjà.";
        } else {

            $sql = "INSERT INTO joueur
            (Id_Joueur, nom, prenom, numero_licence, date_naissance, taille, poids, statut, poste_preferer)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $_POST["Id_Joueur"],
                $_POST["Nom"],
                $_POST["Prenom"],
                $_POST["NumLicence"],
                $_POST["DateNaiss"],
                $_POST["Taille"],
                $_POST["Poids"],
                $_POST["Status"],
                $_POST["PostePrf"]
            ]);

            header("Location: afficher_joueurs.php");
            exit;
        }
    } else {
        $erreur = "⚠️ Tous les champs sont obligatoires.";
    }
}
?>
       