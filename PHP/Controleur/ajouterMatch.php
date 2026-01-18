<?php
require_once '../modele/DaoMatch.php';
require_once '../modele/Match.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matchDAO = new MatchDAO();

    // 1. Récupération des données du formulaire
    $idM = $_POST['IdM']; // Assure-toi d'avoir <input name="IdM"> dans ton HTML
    $dateM = $_POST['DateM'];
    $heureM = $_POST['HeureM'];
    $adversaire = $_POST['Adv'];
    $lieu = $_POST['LieuM'];
    $resultatSaisi = $_POST['Result'];

    // 2. Logique de date pour le résultat
    $dateAujourdhui = date('Y-m-d');
    
    // Si la date du match est dans le futur, on ignore le résultat saisi et on met NULL
    if ($dateM > $dateAujourdhui) {
        $resultatFinal = null;
    } else {
        // Si c'est aujourd'hui ou passé, on prend ce qui est saisi (ou vide)
        $resultatFinal = !empty($resultatSaisi) ? $resultatSaisi : null;
    }

    // 3. Création de l'objet avec le nouvel ID
    $nouveauMatch = new Match_(
        $idM,
        $dateM,
        $heureM,
        $adversaire,
        $resultatFinal,
        $lieu
    );

    try {
        $matchDAO->insert($nouveauMatch);
        // Redirection vers la liste des matchs
        header("Location: ../vue/afficher_matches.php?status=success");
        exit();
    } catch (Exception $e) {
        echo "Erreur lors de l'insertion : " . $e->getMessage();
    }
}