<?php
require_once 'Match.php';
require_once '../modele/connexionBD.php';

class MatchDAO {
    private $pdo;

    public function __construct() {
        $connection = new ConnectionBD();
        $this->pdo = $connection->getConnection();
    }

    public function insert(Match_ $m){
        $req = $this->pdo->prepare("
            INSERT INTO Match_
            (Id_Match, DATE_, HEURE, Nom_adversaire, resultat, lieu_rencontre)
            VALUES (:Id_Match, :DATE_, :HEURE, :Nom_adversaire, :resultat, :lieu_rencontre)
        ");

        $req->execute([
            ':Id_Match' => $m->getId_Match(),
            ':DATE_' => $m->getDateMatch(),
            ':HEURE' => $m->getHeureMatch(),
            ':Nom_adversaire' => $m->getNom_Adversaire(),
            ':resultat' => $m->getResultat(),
            ':lieu_rencontre' => $m->getLieuRencontre()
        ]);
    }

   public function updateInfo(Match_ $m, string $dateMatch, string $heureMatch, string $resultat) {
    $req = $this->pdo->prepare("
        UPDATE Match_
        SET DATE_ = :DATE_, HEURE = :HEURE, resultat = :res
        WHERE Id_Match = :Id_Match
    ");

    $req->execute([
        ':Id_Match' => $m->getId_Match(),
        ':DATE_' => $dateMatch,
        ':HEURE' => $heureMatch,
        ':res'   => $resultat
    ]);
}

   public function delete(string $idMatch) {
    try {
        $this->pdo->beginTransaction(); // On commence une transaction pour être sûr

        // 1. Supprimer les lignes dans Participe liées à ce match
        $reqParticipe = $this->pdo->prepare("DELETE FROM Participe WHERE Id_Match = :idM");
        $reqParticipe->execute([':idM' => $idMatch]);

        // 2. Supprimer le match lui-même
        $reqMatch = $this->pdo->prepare("DELETE FROM Match_ WHERE Id_Match = :idM");
        $reqMatch->execute([':idM' => $idMatch]);

        $this->pdo->commit(); // On valide les deux suppressions
    } catch (Exception $e) {
        $this->pdo->rollBack(); // En cas d'erreur, on annule tout
        throw $e;
    }
}

    public function findById(string $idMatch){
        $req = $this->pdo->prepare("SELECT * FROM Match_ WHERE Id_Match = :Id_Match");
        $req->execute([
            ':Id_Match' => $idMatch
        ]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenirTous() {
        $req = $this->pdo->query("SELECT * FROM Match_ ORDER BY DATE_, HEURE");
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}
