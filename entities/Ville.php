<?php

/**
 * Description of Ville
 *
 * @author brice
 */
class Ville {
   private $idVille;
   private $codePostal;
   private $codeCommune;
   private $nomCommune;
   private $idCirconscription;
   
   function __construct($idVille="", $codePostal="", $codeCommune="", $nomCommune="", $idCirconscription="") {
       $this->idVille = $idVille;
       $this->codePostal = $codePostal;
       $this->codeCommune = $codeCommune;
       $this->nomCommune = $nomCommune;
       $this->idCirconscription = $idCirconscription;
   }

   public function getIdVille() {
       return $this->idVille;
   }

   public function getCodePostal() {
       return $this->codePostal;
   }

   public function getCodeCommune() {
       return $this->codeCommune;
   }

   public function getNomCommune() {
       return $this->nomCommune;
   }

   public function getIdCirconscription() {
       return $this->idCirconscription;
   }

   public function setIdVille($idVille) {
       $this->idVille = $idVille;
   }

   public function setCodePostal($codePostal) {
       $this->codePostal = $codePostal;
   }

   public function setCodeCommune($codeCommune) {
       $this->codeCommune = $codeCommune;
   }

   public function setNomCommune($nomCommune) {
       $this->nomCommune = $nomCommune;
   }

   public function setIdCirconscription($idCirconscription) {
       $this->idCirconscription = $idCirconscription;
   }


}
