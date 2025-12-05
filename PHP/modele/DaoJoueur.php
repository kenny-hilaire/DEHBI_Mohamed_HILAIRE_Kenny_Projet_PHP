<?php
require_once 'Joueur.php'; // ✅ Important pour que Contact soit reconnu

class ContactDAO{
    private $pdo;

    public function __construct(){
     try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=basketball;charset=utf8", 'ETU', 'PHPKenny2025*');
    } catch (Exception $e) {
         die("Erreur de connexion : " . $e->getMessage());
     }
}

public function insert(Contact $c){
     $req = $this->pdo->prepare('
            INSERT INTO joueur (Id_Joueur, nom , prenom, numéro_licence, date_naissance, taille, poids,statut,poste_préferer)
            VALUES (:Id_Joueur and :nom and :prenom and
             :numéro_licence and :date_naissance
             and :taille and :poids and :statut and :poste_préferer)
        ');
        // à modifier
        $req->execute([
            'nom' => $c->getNom(),
            'prenom' => $c->getPrenom(),
            'adresse' => $c->getAdresse(),
            'code_postale' => $c->getCodePostale(),
            'ville' => $c->getVille(),
            'telephone' => $c->getTelephone()
        ]);
}

public function updateInfo(Contact $ancien, $nouveauNom, $nouveauPrenom){
        $req = $this->pdo->prepare("
            UPDATE contact
            SET nom = :nouveauNom, prenom = :nouveauPrenom
            WHERE nom = :ancienNom AND prenom = :ancienPrenom
        ");
        $req->execute([
            'nouveauNom' => $nouveauNom,
            'nouveauPrenom' =>$nouveauPrenom,
            'ancienNom' => $ancien->getNom(),
            'ancienPrenom' => $ancien->getPrenom()
        ]);
}

    public function updateCoordonne($telephone, $adresse, $code_postale, $ville){
          $req = $this->pdo->prepare('
            UPDATE contact
            SET adresse = :adresse, code_postale = :code_postale, ville = :ville
            WHERE telephone = :telephone
        ');
        return $req->execute([
            'adresse' => $adresse,
            'code_postale' => $code_postale,
            'ville' => $ville,
            'telephone' => $telephone
        ]);
    }

    public function delete(Contact $contact){
        $sup = $this->pdo->prepare("delete from contact where telephone = :telephone");
    $sup -> execute([
	':telephone' => $contact->getTelephone()]);
    }


    public function select($motCle){
         $req = $this->pdo->prepare("select * from contact where nom like :mc1 or prenom like :mc1 or telephone like :mc1 or adresse like :mc1 or code_postale like :mc1 or ville like :mc1;");
		$req ->execute(['mc1' => "%$motCle%"]);
    return $req->fetchAll(PDO::FETCH_ASSOC);
    }



    public function obtenirTous() {
        $req = $this->pdo->query('SELECT * FROM contact ORDER BY nom, prenom');
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}