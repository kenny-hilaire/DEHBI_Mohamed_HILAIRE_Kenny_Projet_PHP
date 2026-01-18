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

    public function updateInfo(Match_ $m, string $dateMatch, string $heureMatch){
        $req = $this->pdo->prepare("
            UPDATE Match_
            SET DATE_ = :DATE_, HEURE = :HEURE
            WHERE Id_Match = :Id_Match
        ");

        $req->execute([
            ':Id_Match' => $m->getId_Match(),
            ':DATE_' => $dateMatch,
            ':HEURE' => $heureMatch
        ]);
    }

    public function delete(string $idMatch){
        $req = $this->pdo->prepare("DELETE FROM Match_ WHERE Id_Match = :Id_Match");
        $req->execute([
            ':Id_Match' => $idMatch
        ]);
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
