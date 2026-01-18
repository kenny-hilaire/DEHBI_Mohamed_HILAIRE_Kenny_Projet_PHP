<?php
require_once '../modele/connexionBD.php';
require_once '../modele/DaoJoueur.php';
require_once '../modele/DaoMatch.php';
require_once '../modele/DaoParticipe.php';

$connectionBD = new ConnectionBD();
$pdo = $connectionBD->getConnection();
$daoParticipe = new ParticipeDAO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idMatch = $_POST['id_match'];
    $nomTitu = $_POST['nomTitu'] ?? [];
    $posteTitu = $_POST['posteTitu'] ?? [];
    $commentaireTitu = $_POST['commentaireTitu'] ?? [];
    $evaluationTitu = $_POST['evaluationTitu'] ?? [];

    $nomRempl = $_POST['nomRempl'] ?? [];
    $posteRempl = $_POST['posteRempl'] ?? [];
    $commentaireRempl = $_POST['commentaireRempl'] ?? [];
    $evaluationRempl = $_POST['evaluationRempl'] ?? [];

    // Insérer les titulaires
    foreach ($nomTitu as $i => $nom) {
        if (!empty($nom)) {
            $daoParticipe->insert([
                'id_match' => $idMatch,
                'nom_joueur' => $nom,
                'poste' => $posteTitu[$i] ?? '',
                'commentaire' => $commentaireTitu[$i] ?? '',
                'evaluation' => $evaluationTitu[$i] ?? ''
            ]);
        }
    }

    // Insérer les remplaçants
    foreach ($nomRempl as $i => $nom) {
        if (!empty($nom)) {
            $daoParticipe->insert([
                'id_match' => $idMatch,
                'nom_joueur' => $nom,
                'poste' => $posteRempl[$i] ?? '',
                'commentaire' => $commentaireRempl[$i] ?? '',
                'evaluation' => $evaluationRempl[$i] ?? ''
            ]);
        }
    }

    header("Location: VoirFeuilleMatch.php?id=$idMatch");
    exit;
}
