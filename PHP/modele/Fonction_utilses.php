<?php

class StatistiquesManager {
    private $db;

    // Le constructeur reçoit la connexion PDO
    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // ------------------- Nb titularisation d'un joueur -------------------
    public function nombreMatchTitulaire($p_idJoueur) {
        $sql = "SELECT count(*) FROM Participe 
                WHERE Id_Joueur = :id 
                AND titulaire_ou_remplacant = 'titulaire'"; // Orthographe selon schéma
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $p_idJoueur]);
        return $stmt->fetchColumn();
    }

    // ------------------- Nb remplaçant d'un joueur -------------------
    public function nombreMatchRemplaçant($p_idJoueur) {
        $sql = "SELECT count(*) FROM Participe P, Joueur J 
                WHERE J.Id_Joueur = P.Id_Joueur 
                AND J.Id_Joueur = :id 
                AND P.titulaire_ou_remplacant = 'remplacant'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $p_idJoueur]);
        return $stmt->fetchColumn();
    }

    // ------------------- % de match gagné -------------------
    public function nombre_victoire() {
        $total = $this->db->query("SELECT COUNT(*) FROM Match")->fetchColumn();
        if ($total == 0) return 0;

        $sql = "SELECT count(*) FROM Match WHERE resultat = 'victoire'";
        $victoires = $this->db->query($sql)->fetchColumn();

        return round(($victoires / $total) * 100, 2);
    }

    // ------------------- % de match null -------------------
    public function nombre_draw() {
        $total = $this->db->query("SELECT COUNT(*) FROM Match")->fetchColumn();
        if ($total == 0) return 0;

        $sql = "SELECT count(*) FROM Match WHERE resultat = 'egalte'";
        $draws = $this->db->query($sql)->fetchColumn();

        return round(($draws / $total) * 100, 2);
    }

    // ------------------- % de match perdu -------------------
    public function nombre_perdu() {
        $total = $this->db->query("SELECT COUNT(*) FROM Match")->fetchColumn();
        if ($total == 0) return 0;

        $sql = "SELECT count(*) FROM Match WHERE resultat = 'perdu'"; // Corrigé 'egalte' du SQL original
        $perdus = $this->db->query($sql)->fetchColumn();

        return round(($perdus / $total) * 100, 2);
    }

    // ------------------- % victoire ou Joueur a participer -------------------
    public function pourcentage_victoire_joueur($p_idJoueur) {
        // Nombre total de matchs joués par ce joueur
        $sqlPart = "SELECT COUNT(*) FROM Participe WHERE Id_Joueur = :id";
        $stmtPart = $this->db->prepare($sqlPart);
        $stmtPart->execute(['id' => $p_idJoueur]);
        $participations = $stmtPart->fetchColumn();

        if ($participations == 0) return 0;

        // Nombre de victoires
        $sqlWin = "SELECT COUNT(*) FROM Participe P
                   JOIN Match M ON P.Id_Match = M.Id_Match
                   WHERE P.Id_Joueur = :id AND M.resultat = 'victoire'";
        $stmtWin = $this->db->prepare($sqlWin);
        $stmtWin->execute(['id' => $p_idJoueur]);
        $victoires = $stmtWin->fetchColumn();

        return round(($victoires / $participations) * 100, 2);
    }

    // ------------------- Moyenne Evaluation -------------------
    public function moyenneEvaluation($p_idJoueur) {
        $sql = "SELECT AVG(CAST(evaluation_perf AS DECIMAL(10,2))) 
                FROM Participe 
                WHERE Id_Joueur = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $p_idJoueur]);
        $moyenne = $stmt->fetchColumn();

        return $moyenne ? round($moyenne, 2) : 0;
    }
}