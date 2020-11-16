<?php

/**
 * Etablissement.php
 * Description of Etablissement
 *
 * @author brice
 */
class Etablissement {
    
    //ATTRIBUTS
    private $identifiantEtablissement;
    private $nomEtablissement;
    private $Adresse1;
    private $Adresse3;
    private $idVille;
    
    public function __construct($identifiantEtablissement="", $nomEtablissement="", $Adresse1="", $Adresse3="", $idVille="") {
        $this->identifiantEtablissement = $identifiantEtablissement;
        $this->nomEtablissement = $nomEtablissement;
        $this->Adresse1 = $Adresse1;
        $this->Adresse3 = $Adresse3;
        $this->idVille = $idVille;
    }
    
    public function getIdentifiantEtablissement() {
        return $this->identifiantEtablissement;
    }

    public function getNomEtablissement() {
        return $this->nomEtablissement;
    }

    public function getAdresse1() {
        return $this->Adresse1;
    }

    public function getAdresse3() {
        return $this->Adresse3;
    }

    public function getIdVille() {
        return $this->idVille;
    }

    public function setIdentifiantEtablissement($identifiantEtablissement) {
        $this->identifiantEtablissement = $identifiantEtablissement;
    }

    public function setNomEtablissement($nomEtablissement) {
        $this->nomEtablissement = $nomEtablissement;
    }

    public function setAdresse1($Adresse1) {
        $this->Adresse1 = $Adresse1;
    }

    public function setAdresse3($Adresse3) {
        $this->Adresse3 = $Adresse3;
    }

    public function setIdVille($idVille) {
        $this->idVille = $idVille;
    }


    
    
}
