<?php
require_once 'Participe.php'; 
require_once 'connexionBD.php'; 

class ParticipeDAO {
    private $pdo;

    public function __construct() {
        $connection = new ConnectionBD();
        $this->pdo = $connection->getConnection();
    }

    public function insert(Participe $p) {
        $req = $this->pdo->prepare('
            INSERT INTO Participe (Id_Joueur, Id_Match, poste, evaluation_perf, titulaire_ou_remplacant)
            VALUES (:Id_Joueur, :Id_Match, :poste, :evaluation_perf, :titulaire_ou_remplacant)
        ');

        $req->execute([
            'Id_Joueur'               => $p->getIdJoueur(),
            'Id_Match'                => $p->getIdMatch(),
            'poste'                   => $p->getPoste(),
            'evaluation_perf'         => $p->getEvaluationPerf(),
            'titulaire_ou_remplacant' => $p->getTitulaireOuRemplacant()
        ]);
    }

    public function updateInfo(Participe $p, string $nouveauPoste, string $nouveauStatut, string $nouvelleEvaluation) {
        $req = $this->pdo->prepare("
            UPDATE Participe 
            SET poste = :nouveauPoste, 
                titulaire_ou_remplacant = :nouveauStatut, 
                evaluation_perf = :nouvelleEvaluation
            WHERE Id_Joueur = :idJ AND Id_Match = :idM
        ");
        $req->execute([
            'idJ'              => $p->getIdJoueur(),
            'idM'              => $p->getIdMatch(),
            'nouveauPoste'     => $nouveauPoste,
            'nouveauStatut'    => $nouveauStatut,
            'nouvelleEvaluation' => $nouvelleEvaluation
        ]);
    }

    public function delete(Participe $p) {
        $sup = $this->pdo->prepare("DELETE FROM Participe WHERE Id_Joueur = :Id_Joueur AND Id_Match = :Id_Match");
        $sup->execute([
            'Id_Joueur' => $p->getIdJoueur(),
            'Id_Match'  => $p->getIdMatch()
        ]);
    }

    public function select(Participe $p) {
        $req = $this->pdo->prepare("SELECT * FROM Participe WHERE Id_Joueur = :Id_Joueur AND Id_Match = :Id_Match");
        $req->execute([
            'Id_Joueur' => $p->getIdJoueur(),
            'Id_Match'  => $p->getIdMatch()
        ]);
        return $req->fetch(PDO::FETCH_ASSOC); // Un seul résultat attendu
    }

    public function obtenirTous() {
        // ✅ Correction de l'orthographe "Participe" (il manquait le 'i')
        $req = $this->pdo->query('SELECT * FROM Participe ORDER BY Id_Joueur');
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}