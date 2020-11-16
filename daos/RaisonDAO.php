<?php

/**
 * Description of RaisonDAO
 *
 * @author brice
 */
require_once '../entities/Raison.php';

class RaisonDAO {

    private $pdo;

    function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function selectAll(): array{
        $tableau = array();
        
        try{
            $curseur = $this->pdo->query("SELECT * FROM raison");
            $curseur->setFetchMode(PDO::FETCH_NUM);
            while ($enregistrement = $curseur->fetch()){
                $raison = new Raison("$enregistrement[0]",$enregistrement[1]);
                $tableau[] = $raison;
            }
        } catch (Exception $ex) {
            $tableau[]= $ex->getMessage();
        }
        return $tableau;
    }
    
    public function insert(Raison $raison): int {
        $affected = 0;

        try {
            $cmd = $this->pdo->prepare("INSERT INTO raison (raison) VALUES (?)");
            $cmd->bindValue(1, $raison->getRaison());
            $cmd->execute();

            $affected = $cmd->rowCount();
        } catch (Exception $ex) {
            $affected = -1;
        }

        return $affected;
    }

    public function delete(Raison $raison): int {
        $affected = 0;

        try {
            $cmd = $this->pdo->prepare("DELETE FROM raison WHERE id_raison = ?");
            $cmd->bindValue(1, $raison->getIdRaison());
            $cmd->execute();

            $affected = $cmd->rowCount();
        } catch (Exception $ex) {
            $affected = -1;
        }
        return $affected;
    }

    public function update(Raison $raison): int {
        $affected = 0;

        try {
            $cmd = $this->pdo->prepare("UPDATE raison SET raison = ? WHERE id_raison = ?");
            $cmd->bindValue(1, $raison->getRaison());
            $cmd->bindValue(2, $raison->getIdRaison());
            $cmd->execute();

            $affected = $cmd->rowCount();
        } catch (Exception $ex) {
            $affected = -1;
        }
        return $affected;
    }

}
