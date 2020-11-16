<?php

/**
 * Description of Circonscription
 *
 * @author brice
 */
class Circonscription {
    
    private $idCirconscription;
    private $nomCirconscription;
    
    function __construct($idCirconscription="",$nomCirconscription="") {
        $this->idCirconscription = $idCirconscription;
        $this->nomCirconscription = $nomCirconscription;
    }
    
    public function getIdCirconscription() {
        return $this->idCirconscription;
    }
    
    public function getNomCirconscription() {
        return $this->nomCirconscription;
    }

    public function setIdCirconscription($idCirconscription) {
        $this->idCirconscription = $idCirconscription;
    }

    public function setNomCirconscription($nomCirconscription) {
        $this->nomCirconscription = $nomCirconscription;
    }


}
