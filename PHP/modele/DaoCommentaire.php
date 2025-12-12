<?php
class commentaire{
      private $pdo;

    public function __construct(){
     try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=basketball;charset=utf8", 'ETU', 'PHPKenny2025*');
    } catch (Exception $e) {
         die("Erreur de connexion : " . $e->getMessage());
     }
}

public function insert(Commentaire $c){
     $req = $this->pdo->prepare('
            INSERT INTO Commenatire (Id_Commentaire, notes_perso, date_comm, Id_Joueur)
            VALUES (:Id_Commentaire and :notes_perso and
             :date_comm and :Id_Joueur
            )
        ');
        // à modifier
        $req->execute([
            'Id_Commentaire' => $c->getIdCommentaire(),
            'notes_perso' => $c->getNotes_perso(),
            'date_comm' => $c->getDate_comm(),
            'Id_Joueur' => $c->getId_Joueur()
        ]);
}


 

public function updateInfo(Commentaire $c, String $notes_perso ){
        $req = $this->pdo->prepare("
            UPDATE contact
            SET notes_perso = :notes_perso
            WHERE Id_Commentaire = :$c->getIdCommentaire() 
        ");
        $req->execute([
            'notes_perso' =>$notes_perso,
            'Id_Commentaire' =>$c->getIdCommentaire()
        ]);
}

    public function delete(Commentaire $c){
        $sup = $this->pdo->prepare("delete from Commentaire where Id_Commentaire = :Id_Commentaire");
    $sup -> execute([
	':Id_Commentaire' => $c->getIdCommentaire()]);
    }


    public function select(Commentaire $c){
         $req = $this->pdo->prepare("select * from Commentaire where Id_Commentaire = :Id_Commentaire;");
		$req ->execute(['Id_Commentaire' => $c->getIdCommentaire()]);
    return $req->fetchAll(PDO::FETCH_ASSOC);
    }



    public function obtenirTous() {
        $req = $this->pdo->query('SELECT * FROM Commentaire ORDER BY Id_Commentaire');
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}
