<?php
    class Match_{
        private $Id_Match;
        private $date_Match;
        private $Heure_Match;
        private $Nom_adversaire; 
        private $resultat;
        private $lieu_rencontre; 


        public function __construct(String $id_match, DATE $date_match, String $heure_match, String $nom_adversaire, String $resultat, String $lieu_rencontre){
        $this->Id_Match = $id_match;
        $this->date_Match = $date_match;
        $this->Heure_Match = heure_match;
        $this->Nom_adversaire = $nom_adversaire;
        $this->resultat = $resultat;
        $this->lieu_rencontre= $lieu_rencontre;
        }

        function getId_Match (){
            return $this->Id_Match;
        }
        function getDateMatch(){
            return $this->date_Match;
        }

        function getHeureMatch(){
            return $this->Heure_Match = heure_match; ;
        }

        function getNom_Adversaire(){
            return $this->Nom_adversaire;
        }
        function getResultat(){
            return $this->resultat;
        }
        function getLieuRencontre(){
            return $this->lieu_rencontre;
        }
    }