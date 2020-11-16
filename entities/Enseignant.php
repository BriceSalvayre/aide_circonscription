<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Enseignant
 *
 * @author brice
 */
class Enseignant {
    // ATTRIBUTS
    private $idEnseignant;
    private $prenomEnseignant;
    private $nomEnseignant;
    private $identifiantEtablissement;
    
    function __construct($idEnseignant="", $prenomEnseignant="", $nomEnseignant="", $identifiantEtablissement="") {
        $this->idEnseignant = $idEnseignant;
        $this->prenomEnseignant = $prenomEnseignant;
        $this->nomEnseignant = $nomEnseignant;
        $this->identifiantEtablissement = $identifiantEtablissement;
    }
    
    public function getIdEnseignant() {
        return $this->idEnseignant;
    }

    public function getPrenomEnseignant() {
        return $this->prenomEnseignant;
    }

    public function getNomEnseignant() {
        return $this->nomEnseignant;
    }

    public function getIdentifiantEtablissement() {
        return $this->identifiantEtablissement;
    }

    public function setIdEnseignant($idEnseignant) {
        $this->idEnseignant = $idEnseignant;
    }

    public function setPrenomEnseignant($prenomEnseignant) {
        $this->prenomEnseignant = $prenomEnseignant;
    }

    public function setNomEnseignant($nomEnseignant) {
        $this->nomEnseignant = $nomEnseignant;
    }

    public function setIdentifiantEtablissement($identifiantEtablissement) {
        $this->identifiantEtablissement = $identifiantEtablissement;
    }


}
