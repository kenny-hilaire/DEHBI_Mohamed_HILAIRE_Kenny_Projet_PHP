<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Feuille de Match</title>
    <link rel="stylesheet" href="CSS/VoirFeuilleMatch.css">

</head>
<body>
    <?php include 'nav.php';     
session_start();

// Si la variable 'auth' n'existe pas ou n'est pas vraie, on dégage l'intrus
if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    header("Location: Connexion.php");
    exit();
}
    require_once '../modele/connexionBD.php';
    require_once '../modele/DaoMatch.php'; 
    require_once '../modele/DaoJoueur.php';
    require_once '../modele/DaoParticipe.php';
    require_once '../modele/DaoCommentaire.php';
    require_once '../modele/Participe.php';
    require_once '../modele/Commentaire.php';

    $connectionBD = new ConnectionBD();
    $pdo = $connectionBD->getConnection();
    $daoParticipe = new ParticipeDAO();
    $matchDAO = new MatchDAO();
    $daoComm = new CommentaireDAO();

    $idMatch = $_GET['id'] ?? $_POST['id_match'] ?? null;
    if (!$idMatch) die("Match non défini");

    $match = $matchDAO->findById($idMatch);
    $dateMatch = $match['DATE_'];

    // --- TRAITEMENT DU UPDATE ---
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_update'])) {
        $ids = $_POST['id_joueur']; 
        $postes = $_POST['poste'];
        $evals = $_POST['evaluation'];
        $statuts = $_POST['statut'];
        $notes = $_POST['commentaire'];

        for ($i = 0; $i < count($ids); $i++) {
            // Update participation
            $objetP = new Participe($ids[$i], $idMatch, $postes[$i], $evals[$i], $statuts[$i], "");
            $daoParticipe->updateInfo($objetP, $postes[$i], $statuts[$i], $evals[$i]);

            // Update ou Insert Commentaire
            if (!empty($notes[$i])) {
                $check = $pdo->prepare("SELECT Id_Commentaire FROM Commentaire WHERE Id_Joueur = ? AND date_comm = ?");
                $check->execute([$ids[$i], $dateMatch]);
                $exist = $check->fetch();

            if ($exist) {
                $daoComm->updateParJoueurEtDate($ids[$i], $dateMatch, $notes[$i]);
            } else {
                // Plus besoin de uniqid('C') !
                // On passe 0 ou null comme premier argument
                $newComm = new Commentaire(0, $notes[$i], $dateMatch, $ids[$i]);
                $daoComm->insert($newComm);
            }
            }
        }
        echo "<p>✅ Modifications et commentaires enregistrés !</p>";
    }

    // --- RÉCUPÉRATION ---
    $sql = "SELECT p.*, j.nom, j.prenom, c.notes_perso 
            FROM Participe p 
            JOIN Joueur j ON p.Id_Joueur = j.Id_Joueur 
            LEFT JOIN Commentaire c ON (j.Id_Joueur = c.Id_Joueur AND c.date_comm = :dateM)
            WHERE p.Id_Match = :idM";
            
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['idM' => $idMatch, 'dateM' => $dateMatch]);
    $participations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $titulaires = array_filter($participations, function($p) { return strtoupper($p['titulaire_ou_remplacant']) === 'TITULAIRE'; });
    $remplacants = array_filter($participations, function($p) { return strtoupper($p['titulaire_ou_remplacant']) !== 'TITULAIRE'; });
    ?>

    <h2>Feuille de Match : vs <?= htmlspecialchars($match['Nom_adversaire']) ?></h2>

    <form action="VoirFeuilleMatch.php?id=<?= urlencode($idMatch) ?>" method="POST">
        <input type="hidden" name="id_match" value="<?= htmlspecialchars($idMatch) ?>">

        <h3>Titulaires</h3>
        <table border="1">
            <thead>
                <tr>
                    <th>Nom / Prénom</th>
                    <th>Poste</th>
                    <th>Évaluation</th>
                    <th>Commentaire</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($titulaires as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['nom'] . " " . $p['prenom']) ?></td>
                    <input type="hidden" name="id_joueur[]" value="<?= $p['Id_Joueur'] ?>">
                    <input type="hidden" name="statut[]" value="Titulaire">
                    <td>
                        <select name="poste[]">
                            <option value="Meneur" <?= $p['poste'] == 'Meneur' ? 'selected' : '' ?>>Meneur</option>
                            <option value="Arrière" <?= $p['poste'] == 'Arrière' ? 'selected' : '' ?>>Arrière</option>
                            <option value="Ailier" <?= $p['poste'] == 'Ailier' ? 'selected' : '' ?>>Ailier</option>
                            <option value="Ailier Fort" <?= $p['poste'] == 'Ailier Fort' ? 'selected' : '' ?>>Ailier Fort</option>
                            <option value="Pivot" <?= $p['poste'] == 'Pivot' ? 'selected' : '' ?>>Pivot</option>
                        </select>
                    </td>
                    <td>
                        <select name="evaluation[]">
                            <?php for($i=1; $i<=5; $i++): ?>
                                <option value="<?= $i ?>" <?= $p['evaluation_perf'] == $i ? 'selected' : '' ?>><?= $i ?> ⭐</option>
                            <?php endfor; ?>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="commentaire[]" value="<?= htmlspecialchars($p['notes_perso'] ?? '') ?>">
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Remplaçants</h3>
        <table border="1">
            <thead>
                <tr>
                    <th>Nom / Prénom</th>
                    <th>Poste</th>
                    <th>Évaluation</th>
                    <th>Commentaire</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($remplacants as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['nom'] . " " . $p['prenom']) ?></td>
                    <input type="hidden" name="id_joueur[]" value="<?= $p['Id_Joueur'] ?>">
                    <input type="hidden" name="statut[]" value="Remplacant">
                    <td>
                        <select name="poste[]">
                            <option value="Meneur" <?= $p['poste'] == 'Meneur' ? 'selected' : '' ?>>Meneur</option>
                            <option value="Arrière" <?= $p['poste'] == 'Arrière' ? 'selected' : '' ?>>Arrière</option>
                            <option value="Ailier" <?= $p['poste'] == 'Ailier' ? 'selected' : '' ?>>Ailier</option>
                            <option value="Ailier Fort" <?= $p['poste'] == 'Ailier Fort' ? 'selected' : '' ?>>Ailier Fort</option>
                            <option value="Pivot" <?= $p['poste'] == 'Pivot' ? 'selected' : '' ?>>Pivot</option>
                        </select>
                    </td>
                    <td>
                        <select name="evaluation[]">
                            <?php for($i=1; $i<=5; $i++): ?>
                                <option value="<?= $i ?>" <?= $p['evaluation_perf'] == $i ? 'selected' : '' ?>><?= $i ?> ⭐</option>
                            <?php endfor; ?>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="commentaire[]" value="<?= htmlspecialchars($p['notes_perso'] ?? '') ?>">
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <br>
        <button type="submit" name="btn_update">Mettre à jour la feuille</button>
        <a href="afficher_matches.php">Retour</a>
    </form>
    <?php include 'footer.php'; ?>
</body>
</html>