<?php
require_once '../Modele/connexionBD.php';
require_once '../Modele/DaoJoueur.php';
require_once '../Modele/Joueur.php';

$dao = new JoueurDAO();             

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Joueur introuvable");
}

$joueurData = $dao->select(new Joueur($id, '', '', '', '', 0, 0, '', ''));
if (!$joueurData) {
    die("Joueur non trouvé");
}
$joueurData = $joueurData[0];

$erreur = "";
$valeurs = [
    'taille' => $joueurData['taille'],
    'poids' => $joueurData['poids'],
    'statut' => $joueurData['statut'],
    'poste' => $joueurData['poste_preferer']
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $valeurs['taille'] = $_POST['taille'] ?? $joueurData['taille'];
    $valeurs['poids'] = $_POST['poids'] ?? $joueurData['poids'];
    $valeurs['statut'] = $_POST['statut'] ?? $joueurData['statut'];
    $valeurs['poste'] = $_POST['poste'] ?? $joueurData['poste_preferer'];

    $taille = floatval($valeurs['taille']);
    $poids = floatval($valeurs['poids']);

    if ($taille < 1.40 || $taille > 2.30) {
        $erreur = "⚠️ La taille doit être comprise entre 1.40 m et 2.30 m.";
    } elseif ($poids < 40 || $poids > 180) {
        $erreur = "⚠️ Le poids doit être compris entre 40 kg et 180 kg.";
    } elseif (empty($valeurs['statut']) || empty($valeurs['poste'])) {
        $erreur = "⚠️ Tous les champs doivent être remplis.";
    } else {
        $joueur = new Joueur(
            $id,
            $joueurData['nom'],
            $joueurData['prenom'],
            $joueurData['numero_licence'],
            $joueurData['date_naissance'],
            $taille,
            $poids,
            $valeurs['statut'],
            $valeurs['poste']
        );

        // Mise à jour via DAO
        try {
            $dao->updateInfo($joueur, $valeurs['statut'], $valeurs['poste'], $taille, $poids);
            header("Location: afficher_joueurs.php");
            exit;
        } catch (PDOException $e) {
            $erreur = "Erreur lors de la mise à jour : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le joueur</title>
    <link rel="stylesheet" href="CSS/ajouterJoueur.css">
</head>
<body>

<nav>
    <ul>
        <li><a href="menuPrincipale.php">Menu</a></li>
        <li><a href="afficher_joueurs.php">Joueurs</a></li>
    </ul>
</nav>

<h1>Modifier le joueur</h1>

<div class="form-container">
    <form method="post">

        <label>Nom</label>
        <input type="text" value="<?= htmlspecialchars($joueurData['nom']) ?>" readonly>

        <label>Prénom</label>
        <input type="text" value="<?= htmlspecialchars($joueurData['prenom']) ?>" readonly>

        <label>Numéro de licence</label>
        <input type="text" value="<?= htmlspecialchars($joueurData['numero_licence']) ?>" readonly>

        <label>Date de naissance</label>
        <input type="date" value="<?= htmlspecialchars($joueurData['date_naissance']) ?>" readonly>

        <hr>

        <label>Taille (en m)</label>
        <input type="number" name="taille" step="0.01" min="0" value="<?= htmlspecialchars($valeurs['taille']) ?>">

        <label>Poids (en kg)</label>
        <input type="number" name="poids" step="0.1" min="0" value="<?= htmlspecialchars($valeurs['poids']) ?>">

        <label>Statut</label>
        <select name="statut" required>
            <option value="">-- Sélectionner --</option>
            <option value="Actif" <?= $valeurs['statut'] === "Actif" ? "selected" : "" ?>>Actif</option>
            <option value="Inactif" <?= $valeurs['statut'] === "Inactif" ? "selected" : "" ?>>Inactif</option>
        </select>

        <label>Poste préféré</label>
        <select name="poste" required>
            <option value="">-- Sélectionner --</option>
            <option value="meneur" <?= $valeurs['poste'] === "meneur" ? "selected" : "" ?>>Meneur</option>
            <option value="arriere" <?= $valeurs['poste'] === "arriere" ? "selected" : "" ?>>Arrière</option>
            <option value="ailier" <?= $valeurs['poste'] === "ailier" ? "selected" : "" ?>>Ailier</option>
            <option value="ailier fort" <?= $valeurs['poste'] === "ailier fort" ? "selected" : "" ?>>Ailier fort</option>
            <option value="pivot" <?= $valeurs['poste'] === "pivot" ? "selected" : "" ?>>Pivot</option>
        </select>

        <p style="color:red; font-weight:bold;"><?= htmlspecialchars($erreur) ?></p>

        <input type="submit" value="Modifier le joueur">
    </form>
</div>

<div class="links">
    <a href="afficher_joueurs.php">Retour à la liste</a>
    <a href="menuPrincipale.php">Retour à l'accueil</a>
</div>

</body>
</html>
