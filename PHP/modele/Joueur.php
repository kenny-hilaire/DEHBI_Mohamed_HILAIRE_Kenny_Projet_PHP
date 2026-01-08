<?php
class Joueur {
    private $Id_Joueur;
    private  $nom;
    private $prenom;
    private $numero_licence ;
    private $date_naissance;
    private $taille;
    private $poids; 
    private $statut;
    private $poste_preferer;

    public function __construct(String $Id_Joueur, String $nom, String $prenom, String $numero_licence, String $date_naissance, float $taille, float $poids, String $statut, String $poste_preferer ){
        $this->Id_Joueur = $Id_Joueur;
        $this->nom = $nom;
        $this->prenom=$prenom;
        $this->numero_licence = $numero_licence;
        $this->date_naissance= $date_naisssance;
        $this->taille = $taille;
        $this->poids=$poids;
        $this->statut=$statut;
        $this->poste_preferer=$poste_preferer;
    }
    public function getId_Joueur(){
        return $this->Id_Joueur;
    }
    public function getNom(){
        return $this->nom;
    }

    public function getPrenom(){
        return $this->prenom;
    }
    public function getNumLicence(){
        return $this->numero_licence;
    }
    public function getDateNaissance(){
        return $this->date_naissance;
    }
    public function getTaille(){
        return $this->taille;
    }
    public function getPoids(){       
         return $this->poids;
    }
    public function getStatut(){        
        return $this->statut;
    }
    public function getPoste_Preferer(){
        return $this->poste_preferer;
    }
}
?>