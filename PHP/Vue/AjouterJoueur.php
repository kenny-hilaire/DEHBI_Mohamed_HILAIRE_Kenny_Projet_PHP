<?php
session_start();

// Si la variable 'auth' n'existe pas ou n'est pas vraie, on dégage l'intrus
if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    header("Location: Connexion.php");
    exit();
}
require_once '../modele/connexionBD.php';
require_once '../modele/DaoJoueur.php';
require_once '../modele/Joueur.php';

$connectionBD = new ConnectionBD();
$pdo = $connectionBD->getConnection();

// Initialisation des variables
$erreur = "";
$valeurs = [
    'Id_joueur' => '',
    'nom' => '',
    'prenom' => '',
    'licence' => '',
    'date_naissance' => '',
    'taille' => '',
    'poids' => '',
    'statut' => '',
    'poste' => ''
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    foreach ($valeurs as $champ => &$val) {
        if (isset($_POST[$champ])) {
            $val = $_POST[$champ];
        }
    }

    // Vérification champs obligatoires
    if (
        !empty($valeurs["Id_joueur"]) &&
        !empty($valeurs["nom"]) &&
        !empty($valeurs["prenom"]) &&
        !empty($valeurs["licence"]) &&
        !empty($valeurs["date_naissance"]) &&
        !empty($valeurs["taille"]) &&
        !empty($valeurs["poids"]) &&
        !empty($valeurs["statut"]) &&
        !empty($valeurs["poste"])
    ) {
        $taille = floatval($valeurs["taille"]);
        $poids  = floatval($valeurs["poids"]);

        if ($taille < 1.40 || $taille > 2.30) {
            $erreur = "⚠️ La taille doit être comprise entre 1.40 m et 2.30 m.";
        } elseif ($poids < 40 || $poids > 180) {
            $erreur = "⚠️ Le poids doit être compris entre 40 kg et 180 kg.";
        } else {
            // Vérifier si l'ID existe déjà
            $check = $pdo->prepare("SELECT 1 FROM Joueur WHERE Id_Joueur = ?");
            $check->execute([$valeurs["Id_joueur"]]);
            if ($check->fetch()) {
                $erreur = "⚠️ Cet ID joueur existe déjà.";
            } else {
                $joueur = new Joueur(
                    $valeurs["Id_joueur"],
                    $valeurs["nom"],
                    $valeurs["prenom"],
                    $valeurs["licence"],
                    $valeurs["date_naissance"],
                    $taille,
                    $poids,
                    $valeurs["statut"],
                    $valeurs["poste"]
                );
                $dao = new JoueurDAO();
                $dao->insert($joueur);

                header("Location:afficher_joueurs.php");
                exit;
            }
        }
    } else {
        $erreur = "⚠️ Tous les champs sont obligatoires.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un joueur</title>
    <link rel="stylesheet" href="CSS/ajouterJoueur.css">
</head>
<body>
    <?php include 'nav.php'; ?>
<h1>Ajouter un joueur</h1>

<div class="form-container">
    <form method="post">

        <label>ID Joueur</label>
        <input type="text" name="Id_joueur" value="<?= htmlspecialchars($valeurs['Id_joueur']) ?>">

        <label>Nom</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($valeurs['nom']) ?>">

        <label>Prénom</label>
        <input type="text" name="prenom" value="<?= htmlspecialchars($valeurs['prenom']) ?>">

        <label>Numéro de licence</label>
        <input type="text" name="licence" value="<?= htmlspecialchars($valeurs['licence']) ?>">

        <label>Date de naissance</label>
        <input type="date" name="date_naissance" value="<?= htmlspecialchars($valeurs['date_naissance']) ?>">

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

        <input type="submit" value="Ajouter le joueur">
    </form>
</div>

<div class="links">
    <a href="afficher_joueurs.php">Retour à la liste</a>
    <a href="menuPrincipale.php">Retour à l'accueil</a>
</div>
<?php include 'footer.php'; ?>

</body>
</html>
