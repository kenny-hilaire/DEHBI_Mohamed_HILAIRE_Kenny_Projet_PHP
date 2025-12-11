<?php
require_once 'Participe.php'; // ✅ Important pour que Contact soit reconnu

class ParticipeDAO{
    private $pdo;

    public function __construct(){
     try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=basketball;charset=utf8", 'ETU', 'PHPKenny2025*');
    } catch (Exception $e) {
         die("Erreur de connexion : " . $e->getMessage());
     }
}

 String $idJoueur,
        String $idMatch,
        String $poste,
        String $evaluationPerf ,
        String $titulaireOuRemplacant,
        String $idParticipation 

public function insert(Joueur $c){
     $req = $this->pdo->prepare('
            INSERT INTO Participe (Id_Joueur, Id_Match, id_participation, poste,  evaluation_perf, titulaire_ou_remplacant  )
            VALUES (:Id_Joueur and :Id_Match and :id_participation and
             :poste and :evaluation_perf
             and :titulaire_ou_remplacant)
        ');
        // à modifier
        $req->execute([
            'Id_Joueur' => $c->getIdJoueur(),
            'Id_Match' => $c->getIdMatch(),
            'id_participation' => $c->getIdParticipation(),
            'poste' => $c->getPoste(),
            'evaluation_perf' => $c->getEvaluationPerf(),
            'titulaire_ou_remplacant' => $c->getTitulaireOuRemplacant()
        ]);
}


 

public function updateInfo(Participe $p, String $nouveauPoste, String $TitulaireOuRemplacementpdate, String $nouvelleEvaluation ){
        $req = $this->pdo->prepare("
            UPDATE contact
            SET poste = :nouveauPoste, titulaireOuRemplacant = :TitulaireOuRemplacementpdate, evaluationPerf = :nouvelleEvaluation
            WHERE idJoueur = :$p->getIdJoueur() 
            and idMatch = :$p->getIdMatch()
        ");
        $req->execute([
            'Id_Joueur' => $p->getIdJoueur(),
            'idMatch' =>$p->getIdMatch(),
            'nouveauPoste' =>$nouveauPoste,
            'TitulaireOuRemplacementpdate' => $TitulaireOuRemplacementpdate,
            'nouvelleEvaluation' => $nouvelleEvaluation, 
        ]);
}

    public function delete(Participe $p){
        $sup = $this->pdo->prepare("delete from Participe where Id_Joueur = :Id_Joueur and Id_Match = : Id_Match");
    $sup -> execute([
	':Id_Joueur' => $p->getIdJoueur() ,'Id_Match' =>$p->getIdMatch()]);
    }


    public function select(Participe $j){
         $req = $this->pdo->prepare("select * from Participe where Id_Joueur = :Id_Joueur and Id_Match = :Id_Match;");
		$req ->execute(['Id_Joueur' => $j->getIdJoueur() , 'Id_Match' =>$p->getIdMatch() ]);
    return $req->fetchAll(PDO::FETCH_ASSOC);
    }



    public function obtenirTous() {
        $req = $this->pdo->query('SELECT * FROM Particpe ORDER BY Id_Joueur');
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}