<?php

require_once '../entities/Ville.php';

class VilleDAO {

    private $pdo;

    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function selectAll(): array {
        $tableau = array();

        try{
            $curseur = $this->pdo->query("SELECT * FROM ville");
            $curseur->setFetchMode(PDO::FETCH_NUM);
            while ($enregistrement = $curseur->fetch()){
                $ville = new Ville($enregistrement[0],$enregistrement[1],$enregistrement[2],$enregistrement[3],$enregistrement[4]);
                $tableau[] = $ville;
            }
        } catch (Exception $ex) {
            $tableau[] = new Ville (-1,$ex->getMessage());
        }
        return $tableau;
    }
    
    public function selectOne($pk): Ville {
        try {
            $curseur = $this->pdo->prepare("SELECT * FROM ville WHERE id_ville = ?");
            $curseur->bindValue(1, $pk);
            $curseur->execute();
            $enregistrment = $curseur->fetch();
            if ($enregistrment != null) {
                $ville = new Ville($enregistrment[0], $enregistrment[1],$enregistrment[2],$enregistrment[3]);
            } else {
                $ville = new Ville("0", "Introuvable");
            }
            $curseur->closeCursor();
        } catch (Exception $ex) {
            $ville = new Ville("-1", $exc->getMessage());
        }
        return $ville;
    }
}
