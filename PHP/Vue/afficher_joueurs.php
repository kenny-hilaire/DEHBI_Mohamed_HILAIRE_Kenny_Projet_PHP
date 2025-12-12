<?php

$pdo = new PDO("mysql:host=localhost;dbname=php_projet;charset=utf8", "root", "");

$sql = "SELECT Id_Joueur, nom, prenom, numero_licence, date_naissance, taille, poids, statut, poste_preferer FROM joueur";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$Joueur = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des joueurs</title>
</head>

<body>

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
                <a href="ModifierJoueur.php?id=<?= $j['Id_Joueur'] ?>">✏️ Modifier</a>
                <a href="SupprimerJoueur.php?id=<?= $j['Id_Joueur'] ?>">🗑 Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>

    <br>

    <input type="submit" name="action" value="Ajouter un joueur">
    <input type="submit" name="action" value="Modifier un joueur">
    <input type="submit" name="action" value="Supprimer un joueur">

</form>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    switch ($_POST['action']) {

        case "Ajouter un joueur":
            header("Location: AjouterJoueur.php");
            exit();

        case "Modifier un joueur":
            header("Location: Modifier_Joueur.php");
            exit();

        case "Supprimer un joueur":
            header("Location: SupprimerJoueur.php");
            exit();
    }
}
?>

</body>
</html>
