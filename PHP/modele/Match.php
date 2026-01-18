<?php
class Match_ {
    private $Id_Match;
    private $date_Match;
    private $Heure_Match;
    private $Nom_adversaire; 
    private $resultat;
    private $lieu_rencontre; 

    public function __construct(string $id_match, string $date_match, string $heure_match, string $nom_adversaire, ?string $resultat, string $lieu_rencontre) {
        $this->Id_Match = $id_match;
        $this->date_Match = $date_match;
        $this->Heure_Match = $heure_match; // Corrigé : ajout du $
        $this->Nom_adversaire = $nom_adversaire;
        $this->resultat = $resultat;
        $this->lieu_rencontre = $lieu_rencontre;
    }

    public function getId_Match () { return $this->Id_Match; }
    public function getDateMatch() { return $this->date_Match; }
    public function getHeureMatch() { return $this->Heure_Match; }
    public function getNom_Adversaire() { return $this->Nom_adversaire; }
    public function getResultat() { return $this->resultat; }
    public function getLieuRencontre() { return $this->lieu_rencontre; }
}