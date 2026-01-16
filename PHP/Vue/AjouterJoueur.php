<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/ajouterJoueur.css">
</head>
<body>

<nav>
    <ul>
        <li><a href="menuPrincipale.php">Menu</a></li>
        <li><a href="afficher_joueurs.php">Joueurs</a></li>
    </ul>   
</nav>

<h1>Ajouter un joueur</h1>

<div class="form-container">
    <form method="post">

        <label>ID Joueur</label>
        <input type="text" name="Id_joueur">

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
        <input type="text" name="statut">

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
require_once '../Modele/connexionBD.php';
require_once '../Modele/DaoJoueur.php';



$connectionBD = new ConnectionBD();
$pdo = $connectionBD->getConnection();

$erreur = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
     if (
        !empty($_POST["Id_joueur"]) &&
        !empty($_POST["nom"]) &&
        !empty($_POST["prenom"]) &&
        !empty($_POST["licence"]) &&
        !empty($_POST["date_naissance"]) &&
        !empty($_POST["taille"]) &&
        !empty($_POST["poids"]) &&
        !empty($_POST["statut"]) &&
        !empty($_POST["poste"])
    ) {

        // Vérifier si l'ID existe déjà
        $check = $pdo->prepare("SELECT 1 FROM joueur WHERE Id_Joueur = ?");
        $check->execute([$_POST["Id_joueur"]]);
        if ($check->fetch()) {
            $erreur = "⚠️ Cet ID joueur existe déjà.";
        } else {
            $joueur = new Joueur(
            $_POST["Id_joueur"],
            $_POST["nom"],
            $_POST["prenom"],
            $_POST["licence"],
            $_POST["date_naissance"],
            $_POST["taille"],
            $_POST["poids"],
            $_POST["statut"],
            $_POST["poste"]
        );

        $dao = new JoueurDAO();
        $dao->insert($joueur);

            header("Location: afficher_joueurs.php");
            exit;
        }
    } else {
        $erreur = "⚠️ Tous les champs sont obligatoires.";
    }
}
?>
       