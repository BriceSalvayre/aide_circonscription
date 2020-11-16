<?php

/**
 * Description of Utilisateur
 *
 * @author brice
 */
class Utilisateur {
    private $idUtilisateur;
    private $identifiantUtilisateur;
    private $mdpUtilisateur;
    private $emailUtilisateur;
    
     function __construct($idUtilisateur="", $identifiantUtilisateur="", $mdpUtilisateur="", $emailUtilisateur="") {
        $this->idUtilisateur = $idUtilisateur;
        $this->identifiantUtilisateur = $identifiantUtilisateur;
        $this->mdpUtilisateur = $mdpUtilisateur;
        $this->emailUtilisateur = $emailUtilisateur;
    }
    
    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }

    public function getIdentifiantUtilisateur() {
        return $this->identifiantUtilisateur;
    }

    public function getMdpUtilisateur() {
        return $this->mdpUtilisateur;
    }

    public function getEmailUtilisateur() {
        return $this->emailUtilisateur;
    }

    public function setIdUtilisateur($idUtilisateur) {
        $this->idUtilisateur = $idUtilisateur;
    }

    public function setIdentifiantUtilisateur($identifiantUtilisateur) {
        $this->identifiantUtilisateur = $identifiantUtilisateur;
    }

    public function setMdpUtilisateur($mdpUtilisateur) {
        $this->mdpUtilisateur = $mdpUtilisateur;
    }

    public function setEmailUtilisateur($emailUtilisateur) {
        $this->emailUtilisateur = $emailUtilisateur;
    }



}
