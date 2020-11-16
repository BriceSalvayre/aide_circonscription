<?php

require_once '../entities/Circonscription.php';

class CirconscriptionDAO {

    private $pdo;

    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function insert(Circonscription $circonscription): int {
        $affected = 0;

        try {
            $cmd = $this->pdo->prepare("INSERT INTO circonscription(nom_circonscription) VALUES (?)");
            $cmd->bindValue(2, $circonscription->getNomCirconscription());
            $cmd->execute();

            $affected = $cmd->rowCount();
        } catch (Exception $ex) {
            $affected = -1;
        }
        return $affected;
    }

    public function delete(Circonscription $circonscription): int {
        $affected = 0;

        try {
            $cmd = $this->pdo->prepare("DELETE FROM circonscription WHERE id_circonscription = ?");
            $cmd->bindValue(1, $circonscription->getIdCirconscription());
            $cmd->execute();

            $affected = $cmd->rowCount();
        } catch (Exception $ex) {
            $affected = -1;
        }
        return $affected;
    }

    public function update(Circonscription $circonscription): int {
        $affected = 0;

        try {
            $cmd = $this->pdo->prepare("UPDATE circonscription SET nom_circonscription=? WHERE id_circonscription =?");
            $cmd->bindValue(2,$circonscription->getNomCirconscription());
            $cmd->bindValue(3,$circonscription->getIdCirconscription());
            $cmd->execute();
            
            $affected= $cmd->rowCount();
        } catch (Exception $ex) {
            $affected = -1;
        }
        return $affected;
    }

}
