<?php
require_once 'Joueur.php'; 
require_once '../modele/connexionBD.php';

class JoueurDAO {
    private $pdo;

    public function __construct() {
        $connection = new ConnectionBD();
        $this->pdo = $connection->getConnection();
    }
    
    public function insert(Joueur $j) {

        $sql = "
            INSERT INTO joueur
            (Id_Joueur, nom, prenom, numero_licence, date_naissance, taille, poids, statut, poste_preferer)
            VALUES
            (:id, :nom, :prenom, :licence, :date_naissance, :taille, :poids, :statut, :poste)
        ";

        $req = $this->pdo->prepare($sql);

        $req->execute([
            'id' => $j->getId_Joueur(),
            'nom' => $j->getNom(),
            'prenom' => $j->getPrenom(),
            'licence' => $j->getNumLicence(),
            'date_naissance' => $j->getDateNaissance(),
            'taille' => $j->getTaille(),
            'poids' => $j->getPoids(),
            'statut' => $j->getStatut(),
            'poste' => $j->getPoste_Preferer()
        ]);
    }

    public function updateInfo(Joueur $joueur, String $nouveauStatut, String $nouveauPostePref, float $nouvelleTaille, float $nouveauPoids ){
            $req = $this->pdo->prepare("
                UPDATE contact
                SET statut = :nouveauStatut, poste_preferer = :nouveauPostePref, taille = :nouvelleTaille, poids = :nouveauPoids
                WHERE numero_licence = :numLicence 
            ");
            $req->execute([
                'Id_Joueur' => $joueur->getId_Joueur,
                'nouveauStatut' =>$nouveauStatut,
                'taille' => $nouvelleTaille,
                'poste_preferer' => $nouveauPostePref, 
                'poids' => $nouveauPoids
            ]);
        }

    public function delete(String $idJoueur) {
        $req = $this->pdo->prepare(
            "DELETE FROM joueur WHERE Id_Joueur = :id"
        );
        $req->execute([
            'id' => $idJoueur
        ]);
    }



    public function select(Joueur $j){
         $req = $this->pdo->prepare("select * from Joueur where Id_Joueur = :Id_Joueur ;");
		$req ->execute(['Id_Joueur' => $j->getId_Joueur]);
    return $req->fetchAll(PDO::FETCH_ASSOC);
    }



    public function obtenirTous() {
        $req = $this->pdo->query('SELECT * FROM Joueur ORDER BY nom, prenom');
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}