<?php
require_once 'connexionBD.php'; 

class CommentaireDAO {
    private $pdo;

    public function __construct() {
        $connection = new ConnectionBD();
        $this->pdo = $connection->getConnection();
    }

    public function insert(Commentaire $c) {
    // On retire Id_Commentaire de la liste des colonnes et des valeurs
    $req = $this->pdo->prepare('
        INSERT INTO Commentaire (notes_perso, date_comm, Id_Joueur)
        VALUES (:notes, :date_c, :id_j)
    ');
    $req->execute([
        'notes'  => $c->getNotes_perso(),
        'date_c' => $c->getDate_comm(),
        'id_j'   => $c->getId_Joueur()
    ]);
}

    public function updateParJoueurEtDate(string $idJoueur, string $date, string $notes) {
        // On cherche s'il existe déjà un commentaire pour ce joueur à cette date
        $req = $this->pdo->prepare("
            UPDATE Commentaire 
            SET notes_perso = :notes 
            WHERE Id_Joueur = :idJ AND date_comm = :dateC
        ");
        $req->execute([
            'notes' => $notes,
            'idJ'   => $idJoueur,
            'dateC' => $date
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
