<?php
require_once 'Joueur.php'; 
require_once '../modele/connexionBD.php';

class JoueurDAO {
    private $pdo;

    public function __construct() {
        $connection = new ConnectionBD();
        $this->pdo = $connection->getConnection();
    }
    
public function insert(Joueur $c){
     $req = $this->pdo->prepare('
            INSERT INTO joueur (Id_Joueur, nom , prenom, numero_licence, date_naissance, taille, poids,statut,poste_preferer)
            VALUES (:Id_Joueur and :nom and :prenom and
             :numero_licence and :date_naissance
             and :taille and :poids and :statut and :poste_preferer)
        ');
        // à modifier
        $req->execute([
            'nom' => $c->getNom(),
            'prenom' => $c->getPrenom(),
            'Id_Joueur' => $c->getId_Joueur(),
            'numero_licence' => $c->getNumLicence(),
            'date_naissance' => $c->getDateNaissance(),
            'taille' => $c->getTaille(),
            'poids' => $c->getPoids(),
            'statut' => $c->getStatut(),
            'poste_preferer'=> $c->getPoste_Preferer()
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

    public function delete(Joueur $joueur){
        $sup = $this->pdo->prepare("delete from Joueur where Id_Joueur = :Id_Joueur");
    $sup -> execute([
	':Id_Joueur' => $joueur->getId_Joueur]);
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

    public function obtenirActifs() {
    // On définit la requête dans $req
    $req = "SELECT * FROM Joueur WHERE statut = 'actif' ORDER BY nom ASC";
    // On utilise $this->pdo->query($req) car la variable est $req
    $resultat = $this->pdo->query($req);
    return $resultat->fetchAll(PDO::FETCH_ASSOC);
}
}