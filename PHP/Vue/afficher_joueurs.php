
<?php
require_once '../modele/DaoJoueur.php';

/* Gestion des actions du formulaire */
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case "Ajouter un joueur":
            header("Location: AjouterJoueur.php");
            exit;

        case "retour au menu":
            header("Location: menuPrincipale.php");
            exit;
    }
}

/* Récupération des joueurs */
$daoJoueur = new JoueurDAO();
$joueurs = $daoJoueur->obtenirTous();

$daoJoueur = new JoueurDAO();
$joueurs = $daoJoueur->obtenirTous();
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des joueurs</title>
    <link rel="stylesheet" href="CSS/afficher_joueurs.css">
</head>
<body>

<nav>
    <ul>
        <li><a href="menuPrincipale.php">Accueil</a></li>
        <li><a href="afficher_matches.php">🏀 Liste de match</a></li>
        <li><a href="afficher_joueurs.php">👤 Joueurs</a></li>
        <li><a href="statistique.php">📊 Statistique</a></li>
    </ul>
</nav>

<form method="POST">

<table border="1" width="900">
    <tr>
        <th>Id</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Licence</th>
        <th>Date naissance</th>
        <th>Taille</th>
        <th>Poids</th>
        <th>Statut</th>
        <th>Poste préféré</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($joueurs as $j): ?>
    <tr>
        <td><?= htmlspecialchars($j['Id_Joueur']) ?></td>
        <td><?= htmlspecialchars($j['nom']) ?></td>
        <td><?= htmlspecialchars($j['prenom']) ?></td>
        <td><?= htmlspecialchars($j['numero_licence']) ?></td>
        <td><?= htmlspecialchars($j['date_naissance']) ?></td>
        <td><?= htmlspecialchars($j['taille']) ?></td>
        <td><?= htmlspecialchars($j['poids']) ?></td>
        <td><?= htmlspecialchars($j['statut']) ?></td>
        <td><?= htmlspecialchars($j['poste_preferer']) ?></td>
        <td>
            <a href="modifier_Joueur.php?id=<?= $j['Id_Joueur'] ?>">✏️ Modifier</a>
            <a href="SupprimerJoueur.php?id=<?= $j['Id_Joueur'] ?>">🗑 Supprimer</a>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

<br>

<input type="submit" name="action" value="Ajouter un joueur">
<input type="submit" name="action" value="retour au menu">

</form>

</body>
</html>
