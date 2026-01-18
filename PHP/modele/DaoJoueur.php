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
                UPDATE joueur
                SET statut = :nouveauStatut, poste_preferer = :nouveauPostePref, taille = :nouvelleTaille, poids = :nouveauPoids
                WHERE Id_Joueur = :Id_Joueur
            ");
            $req->execute([
                'Id_Joueur' => $joueur->getId_Joueur(),
                'nouveauStatut' => $nouveauStatut,
                'nouveauPostePref' => $nouveauPostePref,
                'nouvelleTaille' => $nouvelleTaille,
                'nouveauPoids' => $nouveauPoids
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

    public function findByID(Joueur $joueur){
        $sup = $this->pdo->prepare("select * from Joueur where Id_Joueur = :Id_Joueur");
    $sup -> execute([
	':Id_Joueur' => $joueur->getId_Joueur]);
        return $sup->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findByNom(string $nom){
        $sup = $this->pdo->prepare("select * from Joueur where nom = :nom");
        $sup -> execute([
        ':nom' => $nom]);
        return $sup->fetch(PDO::FETCH_ASSOC);

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