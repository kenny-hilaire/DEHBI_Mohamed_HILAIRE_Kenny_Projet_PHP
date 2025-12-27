<?php
require_once '../modele/connexionBD.php'; 
require_once '../modele/DaoJoueur.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    switch ($_POST['action']) {

        case "Ajouter un joueur":
            header("Location: AjouterJoueur.php");
            exit();
        case "retour au menu":
            header("Location: menuPrincipale.php");
            exit();
    }
}
$connectionBD = new ConnectionBD();
$pdo = $connectionBD->getConnection();
$daoJoueur = new JoueurDAO();
$Joueur = $daoJoueur->obtenirTous();

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des joueurs</title>
       <link rel="stylesheet" href="Listejoueurs.css">
</head>

<body>
    <nav>
        <ul>
            <li><a href="menuPrincipale.php">Accueil</a></li>
            <li><a href="afficher_matches.php">🏀Liste de match</a></li>
            <li><a href ="afficher_joueurs.php">👤Joueur</a></li>
            <li><a href ="statistique.php">📊Statistique</a></li>
            <li>
                <input type="submit" name="Deconnexion" value="Deconnexion">  
            </li>  
        </ul>
    </nav>

    <form method="POST">

    <table border="1" style="border-collapse: collapse;" width="900px">
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Numéro licence</th>
            <th>Date naissance</th>
            <th>Taille</th>
            <th>Poids</th>
            <th>Statut</th>
            <th>Poste préféré</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($Joueur as $j): ?>
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