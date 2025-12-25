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
     $req = $this->pdo->prepare('
            INSERT INTO Match_ (Id_Match, date_Match, Heure_Match, Nom_adversaire,  resultat, lieu_rencontre)
            VALUES (:Id_Match and :date_Match and :Heure_Match and
             :Nom_adversaire and :resultat
             and :lieu_rencontre)
        ');
        // à modifier
        $req->execute([
            'Id_Match' => $m->getId_Match(),
            'date_Match' => $m->getDateMatch(),
            'Heure_Match' => $m->getHeureMatch(),
            'Nom_adversaire' => $m->getNom_Adversaire(),
            'resultat' => $m->getResultat(),
            'lieu_rencontre' => $m->getLieuRencontre()
        ]);
}


 

public function updateInfo(Match_ $p,  DATE $date_Match, String $Heure_Match){
        $req = $this->pdo->prepare("
            UPDATE Match_
            SET date_Match = :date_Match, Heure_Match = :Heure_Match
            WHERE Id_Match = :$p->getId_Match()

        ");
        $req->execute([
            'Id_Match' => $p->getId_Match(),
            'date_Match' => $date_Match,
            'Heure_Match' => $Heure_Match
        ]);
}

    public function delete(Match_ $m){
        $sup = $this->pdo->prepare("delete from Participe where Id_Joueur = :Id_Joueur and Id_Match = : Id_Match");
    $sup -> execute([
	'Id_Match' =>$m->getId_Match()]);
    }


    public function select(Match_ $m){
         $req = $this->pdo->prepare("select * from Match_ where Id_Match = :Id_Match;");
		$req ->execute(['Id_Match' =>$m->getIdMatch() ]);
    return $req->fetchAll(PDO::FETCH_ASSOC);
    }



    public function obtenirTous() {
        $req = $this->pdo->query('SELECT * FROM Match_ ORDER BY Id_Match');
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}