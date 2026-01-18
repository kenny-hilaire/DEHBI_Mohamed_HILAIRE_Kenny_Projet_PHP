<?php
class Commentaire {
    private $Id_Commentaire; 
    private $notes_perso; 
    private $date_comm; 
    private $Id_Joueur;

    // Remplacez "DATE $date_comm" par "string $date_comm"
    public function __construct(string $Id_commentaire, string $notes_perso, string $date_comm, string $Id_Joueur) {
        $this->Id_Commentaire = $Id_commentaire;
        $this->notes_perso = $notes_perso;
        $this->date_comm = $date_comm; 
        $this->Id_Joueur = $Id_Joueur;
    }

    public function getIdCommentaire() { return $this->Id_Commentaire; }
    public function getNotes_perso() { return $this->notes_perso; }
    public function getDate_comm() { return $this->date_comm; }
    public function getId_Joueur() { return $this->Id_Joueur; }
}