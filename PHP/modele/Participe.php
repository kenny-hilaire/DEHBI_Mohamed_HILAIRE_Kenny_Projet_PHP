<?php

class Participe
{
    private String $idParticipation;

    private String $idJoueur;

    private String $idMatch;

    private string $poste;

   
    private string $evaluationPerf;

    private string $titulaireOuRemplacant;

 

    public function __construct(
        String $idJoueur,
        String $idMatch,
        String $poste,
        String $evaluationPerf ,
        String $titulaireOuRemplacant,
        String $idParticipation 
    ) {
        $this->idJoueur = $idJoueur;
        $this->idMatch = $idMatch;
        $this->poste = $poste;
        $this->evaluationPerf = $evaluationPerf;
        $this->titulaireOuRemplacant = $titulaireOuRemplacant;
        $this->idParticipation = $idParticipation;
        
    }

  
    public function getIdParticipation(): string {
        return $this->idParticipation;
    }

    public function getIdJoueur(): string {
        return $this->idJoueur;
    }

    public function getIdMatch(): string {
        return $this->idMatch;
    }

    public function getPoste(): string {
        return $this->poste;
    }

    public function getEvaluationPerf(): string {
        return $this->evaluationPerf;
    }
    public function getTitulaireOuRemplacant(): string {
        return $this->titulaireOuRemplacant;
    }

}