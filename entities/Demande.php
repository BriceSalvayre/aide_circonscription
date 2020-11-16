<?php


/**
 * Description of demande
 *
 * @author brice
 */
class Demande {
    private $idDemande;
    private $idEtablissement;
    private $dateDemande;
    private $idRaison;
    private $remplacant;
    
    function __construct($idDemande="", $idEtablissement="", $idRaison="", $remplacant="", $dateDemande="") {
        $this->idDemande = $idDemande;
        $this->idEtablissement = $idEtablissement;
        $this->idRaison = $idRaison;
        $this->remplacant = $remplacant;
        $this->dateDemande = $dateDemande;
    }

    public function getIdDemande() {
        return $this->idDemande;
    }

    public function getIdEtablissement() {
        return $this->idEtablissement;
    }

    public function getDateDemande() {
        return $this->dateDemande;
    }

    public function getIdRaison() {
        return $this->idRaison;
    }

    public function getRemplacant() {
        return $this->remplacant;
    }

    public function setIdDemande($idDemande) {
        $this->idDemande = $idDemande;
    }

    public function setIdEtablissement($idEtablissement) {
        $this->idEtablissement = $idEtablissement;
    }

    public function setIdRaison($idRaison) {
        $this->idRaison = $idRaison;
    }

    public function setRemplacant($remplacant) {
        $this->remplacant = $remplacant;
    }


}
