<?php

require_once __DIR__ . '/connexionBD.php';

class Fonction_utiles {
    private $pdo;

    public function __construct() {
        $connection = new ConnectionBD();
        $this->pdo = $connection->getConnection();
    }

    // ------------------- Nb titularisation d'un joueur -------------------
    public function nombreMatch_Titulaire($p_idJoueur) {
        $sql = "SELECT count(*) FROM Participe 
                WHERE Id_Joueur = :id 
                AND titulaire_ou_remplacant = 'titulaire'"; // Orthographe selon schéma
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $p_idJoueur]);
        return $stmt->fetchColumn();
    }

    // ------------------- Nb remplaçant d'un joueur -------------------
    public function nombreMatchRemplaçant($p_idJoueur) {
        $sql = "SELECT count(*) FROM Participe P, Joueur J 
                WHERE J.Id_Joueur = P.Id_Joueur 
                AND J.Id_Joueur = :id 
                AND P.titulaire_ou_remplacant = 'remplacant'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $p_idJoueur]);
        return $stmt->fetchColumn();
    }

    // ------------------- % de match gagné -------------------
    public function nombre_victoire(): int {
        $total = $this->pdo->query("SELECT COUNT(*) FROM Match_")->fetchColumn();
        if ($total == 0) return 0;

        $sql = "SELECT count(*) FROM Match WHERE resultat = 'victoire'";
        $victoires = $this->pdo->query($sql)->fetchColumn();

        return round(($victoires / $total) * 100, 2);
    }

    // ------------------- % de match null -------------------
    public function nombre_draw() {
        $total = $this->pdo->query("SELECT COUNT(*) FROM Match_")->fetchColumn();
        if ($total == 0) return 0;

        $sql = "SELECT count(*) FROM Match_ WHERE resultat = 'egalte'";
        $draws = $this->pdo->query($sql)->fetchColumn();

        return round(($draws / $total) * 100, 2);
    }

    // ------------------- % de Match_ perdu -------------------
    public function nombre_perdu() {
        $total = $this->pdo->query("SELECT COUNT(*) FROM Match_")->fetchColumn();
        if ($total == 0) return 0;

        $sql = "SELECT count(*) FROM Match_ WHERE resultat = 'perdu'"; // Corrigé 'egalte' du SQL original
        $perdus = $this->pdo->query($sql)->fetchColumn();

        return round(($perdus / $total) * 100, 2);
    }

    // ------------------- % victoire ou Joueur a participer -------------------
    public function pourcentage_victoire_joueur($p_idJoueur) {
        // Nombre total de Match_s joués par ce joueur
        $sqlPart = "SELECT COUNT(*) FROM Participe WHERE Id_Joueur = :id";
        $stmtPart = $this->pdo->prepare($sqlPart);
        $stmtPart->execute(['id' => $p_idJoueur]);
        $participations = $stmtPart->fetchColumn();

        if ($participations == 0) return 0;

        // Nombre de victoires
        $sqlWin = "SELECT COUNT(*) FROM Participe P
                   JOIN Match_ M ON P.Id_Match_ = M.Id_Match_
                   WHERE P.Id_Joueur = :id AND M.resultat = 'victoire'";
        $stmtWin = $this->pdo->prepare($sqlWin);
        $stmtWin->execute(['id' => $p_idJoueur]);
        $victoires = $stmtWin->fetchColumn();

        return round(($victoires / $participations) * 100, 2);
    }

    // ------------------- Moyenne Evaluation -------------------
    public function moyenneEvaluation($p_idJoueur) {
        $sql = "SELECT AVG(CAST(evaluation_perf AS DECIMAL(10,2))) 
                FROM Participe 
                WHERE Id_Joueur = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $p_idJoueur]);
        $moyenne = $stmt->fetchColumn();

        return $moyenne ? round($moyenne, 2) : 0;
    }
}