<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des joueurs</title>
    <link rel="stylesheet" href="CSS/feuilleMatch.css">
</head>
<body>
   <?php include 'nav.php'; ?>
    <?php
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
    require_once '../modele/Participe.php';

    $connectionBD = new ConnectionBD();
    $pdo = $connectionBD->getConnection();
    $daoJoueur = new JoueurDAO();
    $daoParticipe = new ParticipeDAO();
    $matchDAO = new MatchDAO();

    $Joueur = $daoJoueur->obtenirActifs();
    
    // Initialisation des tableaux pour l'affichage
    $joueursSelectionnesTitu = array_fill(0, 5, '');
    $joueursSelectionnes = array_fill(0, 7, '');

    $idMatch = $_GET['id'] ?? $_POST['id_match'] ?? null;

    if ($idMatch === null) {
        die("Match non défini");
    }

    $match = $matchDAO->findById($idMatch);

    // --- LOGIQUE DE TRAITEMENT ---
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // 1. On récupère toujours les noms pour garder l'affichage lors du onchange
        if (isset($_POST['nomTitu'])) {
            $joueursSelectionnesTitu = $_POST['nomTitu'];
        }
        if (isset($_POST['nomRempl'])) {
            $joueursSelectionnes = $_POST['nomRempl'];
        }

        // 2. INSERTION : Uniquement si on a cliqué sur le bouton VALIDER
        // Cela empêche l'insertion lors du simple "onchange"
        if (isset($_POST['btn_valider'])) {
            
            // Fusion des données pour le traitement
            $joueursFinal = [
                'TITULAIRE' => [
                    'nom' => $_POST['nomTitu'] ?? [],
                    'poste' => $_POST['posteTitu'] ?? [],
                    'evaluation' => $_POST['evaluationTitu'] ?? []
                ],
                'REMPLACANT' => [
                    'nom' => $_POST['nomRempl'] ?? [],
                    'poste' => $_POST['posteRempl'] ?? [],
                    'evaluation' => $_POST['evaluationRempl'] ?? []
                ]
            ];

            foreach ($joueursFinal as $statut => $donnees) {
                for ($i = 0; $i < count($donnees['nom']); $i++) {
                    $nom = $donnees['nom'][$i];
                    if (!empty($nom)) {
                        $joueurTrouve = $daoJoueur->findByNom($nom);
                        if ($joueurTrouve) {
                            $idJoueur = $joueurTrouve['Id_Joueur'];
                            $poste = $donnees['poste'][$i] ?? '';
                            $evaluation = $donnees['evaluation'][$i] ?? '';
                            $idParticipation = uniqid('P');

                            $participe = new Participe(
                                $idJoueur,
                                $idMatch,
                                $poste,
                                $evaluation,
                                $statut,
                                $idParticipation
                            );

                            $daoParticipe->insert($participe);
                        }
                    }
                }
            }
            // Redirection pour éviter les doublons au rafraîchissement (F5)
            header("Location: afficher_matches.php?status=ok");
            exit();
        }
    }

    $joueursPris = array_filter(array_merge(
        $joueursSelectionnesTitu,
        $joueursSelectionnes
    ));
    ?>

    <form action="VoirFeuilleMatch.php?id=<?= urlencode($idMatch) ?>" method="POST">
        <h2>
            Match vs <?= htmlspecialchars($match['Nom_adversaire']) ?>
            (<?= $match['DATE_'] ?> à <?= substr($match['HEURE'], 0, 5) ?>)
        </h2>

        <h2>Titulaires (5)</h2>
        <table class="feuille-table">
            <thead>
                <tr class="ligne-joueur">
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Poste</th>
                    <th>Taille</th>
                    <th>Poids</th>
                    <th>Commentaire</th>
                    <th>Evaluations</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < 5; $i++): ?>
                <tr>
                    <td>
                        <select name="nomTitu[]" onchange="this.form.submit()">
                            <option value="">-- Nom --</option>
                            <?php foreach ($Joueur as $j): 
                                $estDejaPris = in_array($j['nom'], $joueursPris) && $joueursSelectionnesTitu[$i] !== $j['nom'];
                                if (!$estDejaPris): ?>
                                <option value="<?= $j['nom'] ?>" <?= ($joueursSelectionnesTitu[$i] == $j['nom']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($j['nom']) ?>
                                </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <?php
                    $infosTitu = null;
                    if (!empty($joueursSelectionnesTitu[$i])) {
                        $infosTitu = $daoJoueur->findByNom($joueursSelectionnesTitu[$i]);
                    }
                    ?>
                    <td><?= htmlspecialchars($infosTitu['prenom'] ?? '') ?></td>
                    <td>
                        <select name="posteTitu[]" class="select-joueur">
                            <option value="">-- Poste --</option>
                            <option value="Meneur">Meneur</option>
                            <option value="Arrière">Arrière</option>
                            <option value="Ailier">Ailier</option>
                            <option value="Ailier Fort">Ailier Fort</option>
                            <option value="Pivot">Pivot</option>
                        </select>
                    </td>
                    <td><?= htmlspecialchars($infosTitu['taille'] ?? '') ?></td>
                    <td><?= htmlspecialchars($infosTitu['poids'] ?? '') ?></td>
                    <td><textarea name="commentaireTitu[]" rows="2" cols="15"></textarea></td>
                    <td>
                        <select name="evaluationTitu[]">
                            <option value="">-- Note --</option>
                            <option value="1">⭐</option>
                            <option value="2">⭐⭐</option>
                            <option value="3">⭐⭐⭐</option>
                            <option value="4">⭐⭐⭐⭐</option>
                            <option value="5">⭐⭐⭐⭐⭐</option>
                        </select>
                    </td>
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>

        <h2>Remplaçants (minimum 5)</h2>
        <table class="feuille-table">
            <thead>
                <tr class="ligne-joueur">
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Poste</th>
                    <th>Taille</th>
                    <th>Poids</th>
                    <th>Commentaire</th>
                    <th>Evaluations</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($t = 0; $t < 5; $t++): ?>
                <tr>
                    <td>
                        <select name="nomRempl[]" class="select-joueur" onchange="this.form.submit()">
                            <option value="">-- Nom --</option>
                            <?php foreach ($Joueur as $j): 
                                $estDejaPris = in_array($j['nom'], $joueursPris) && $joueursSelectionnes[$t] !== $j['nom'];
                                if (!$estDejaPris): ?>
                                <option value="<?= $j['nom'] ?>" <?= (isset($joueursSelectionnes[$t]) && $joueursSelectionnes[$t] === $j['nom']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($j['nom']) ?>
                                </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <?php
                    $infosRempl = null;
                    if (!empty($joueursSelectionnes[$t])) {
                        $infosRempl = $daoJoueur->findByNom($joueursSelectionnes[$t]);
                    }
                    ?>
                    <td><?= htmlspecialchars($infosRempl['prenom'] ?? '') ?></td>
                    <td>
                        <select name="posteRempl[]" class="select-joueur">
                            <option value="">-- Poste --</option>
                            <option value="Meneur">Meneur</option>
                            <option value="Arrière">Arrière</option>
                            <option value="Ailier">Ailier</option>
                            <option value="Ailier Fort">Ailier Fort</option>
                            <option value="Pivot">Pivot</option>
                        </select>
                    </td>
                    <td><?= htmlspecialchars($infosRempl['taille'] ?? '') ?></td>
                    <td><?= htmlspecialchars($infosRempl['poids'] ?? '') ?></td>
                    <td><textarea name="commentaireRempl[]" rows="2" cols="15"></textarea></td>
                    <td>
                        <select name="evaluationRempl[]">
                            <option value="">-- Note --</option>
                            <option value="1">⭐</option>
                            <option value="2">⭐⭐</option>
                            <option value="3">⭐⭐⭐</option>
                            <option value="4">⭐⭐⭐⭐</option>
                            <option value="5">⭐⭐⭐⭐⭐</option>
                        </select>
                    </td>
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>

        <input type="hidden" name="id_match" value="<?= htmlspecialchars($idMatch) ?>">
        <button type="submit" id="btn-valider" name="btn_valider">Valider la feuille</button>
    </form>
    <?php include 'footer.php'; ?>

</body>
</html>