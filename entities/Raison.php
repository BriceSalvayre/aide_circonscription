<?php


/**
 * Description of Raison
 *
 * @author brice
 */
class Raison {
    //ATTRIBUTS
    private $idRaison;
    private $raison;
    
    function __construct($idRaison, $raison) {
        $this->idRaison = $idRaison;
        $this->raison = $raison;
    }
    
    public function getIdRaison() {
        return $this->idRaison;
    }

    public function getRaison() {
        return $this->raison;
    }

    public function setIdRaison($idRaison) {
        $this->idRaison = $idRaison;
    }

    public function setRaison($raison) {
        $this->raison = $raison;
    }


}
