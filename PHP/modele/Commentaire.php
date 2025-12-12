<?php
 class Commentaire{
    private $Id_Commentaire ; 
    private $notes_perso; 
    private $date_comm; 
    private $Id_Joueur;

    public function __construct(String $Id_commentaire , String $notes_perso , DATE date_comm, String $Id_Joueur){
        $this->Id_Commentaire = $Id_commentaire;
        $this->notes_perso = $notes_perso;
        $this->$date_comm = $date_comm;
        $this->Id_Joueur = $Id_Joueur;
    }

    function getIdCommentaire() {
        return $this->Id_Commentaire;
    }
    function getNotes_perso(){
        return $this->notes_perso;
    }
    function getDate_comm(){
        return $this->date_comm;
    }
    function getId_Joueur(){
        return $this->Id_Joueur;
    }
 }