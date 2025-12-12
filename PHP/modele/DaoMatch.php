<?php
require_once 'Match.php'; 
class MatchDAO{
    private $pdo;

     //private $Id_Match;
        //private $date_Match;
      //  private $Heure_Match;
    //    private $Nom_adversaire; 
  //      private $resultat;
//        private $lieu_rencontre; 


    public function __construct(){
     try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=basketball;charset=utf8", 'hilaire', 'PHPKenny2025*');
    } catch (Exception $e) {
         die("Erreur de connexion : " . $e->getMessage());
     }
}

public function insert(Match $m){
     $req = $this->pdo->prepare('
            INSERT INTO Match (Id_Match, date_Match, Heure_Match, Nom_adversaire,  resultat, lieu_rencontre)
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


 

public function updateInfo(Match $p,  DATE $date_Match, String $Heure_Match){
        $req = $this->pdo->prepare("
            UPDATE Match
            SET date_Match = :date_Match, Heure_Match = :Heure_Match
            WHERE Id_Match = :$p->getId_Match()

        ");
        $req->execute([
            'Id_Match' => $p->getId_Match(),
            'date_Match' => $date_Match,
            'Heure_Match' => $Heure_Match
        ]);
}

    public function delete(Match $m){
        $sup = $this->pdo->prepare("delete from Participe where Id_Joueur = :Id_Joueur and Id_Match = : Id_Match");
    $sup -> execute([
	'Id_Match' =>$m->getId_Match()]);
    }


    public function select(Match $m){
         $req = $this->pdo->prepare("select * from Match where Id_Match = :Id_Match;");
		$req ->execute(['Id_Match' =>$m->getIdMatch() ]);
    return $req->fetchAll(PDO::FETCH_ASSOC);
    }



    public function obtenirTous() {
        $req = $this->pdo->query('SELECT * FROM Match ORDER BY Id_Match');
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}