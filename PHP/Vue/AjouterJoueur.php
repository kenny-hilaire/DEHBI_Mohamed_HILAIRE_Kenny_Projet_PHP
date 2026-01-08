<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="ajouterJoueur.css">
</head>
<body>
 <link rel="stylesheet" href="css/ajouter_joueur.css">

<nav>
    <ul>
        <li><a href="menu.php">Menu</a></li>
        <li><a href="afficher_joueur.php">Joueurs</a></li>
    </ul>
</nav>

<h1>Ajouter un joueur</h1>

<div class="form-container">
    <form method="post">

        <label>ID Joueur</label>
        <input type="text" name="id_joueur">

        <label>Nom</label>
        <input type="text" name="nom">

        <label>Prénom</label>
        <input type="text" name="prenom">

        <label>Numéro de licence</label>
        <input type="text" name="licence">

        <label>Date de naissance</label>
        <input type="date" name="date_naissance">

        <label>Taille</label>
        <input type="number" name="taille">

        <label>Poids</label>
        <input type="number" name="poids">

        <label>Status</label>
        <input type="text" name="status">

        <label>Poste préféré</label>
        <input type="text" name="poste">

        <input type="submit" value="Ajouter le joueur">
    </form>
</div>

<div class="links">
    <a href="afficher_joueurs.php">Retour à la liste</a>
    <a href="menuPrincipale.php">Retour à l'accueil</a>
</div>


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
       