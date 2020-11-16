<?php

/**
 * Description of EnseignantDAO
 *
 * @author brice
 */
require_once '../entities/Enseignant.php';
require_once '../entities/Circonscription.php';
require_once '../entities/Etablissement.php';
require_once '../entities/Ville.php';

class EnseignantDAO {

    private $pdo;

    function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function selectEverything(): array{
        $tableauRetour = array();
        $tableauEnseigant = array();
        
        try{
            $sql ="SELECT * FROM enseignant e
                    JOIN etablissement a
                    ON e.id_etablissement = a.id_etablissement
                    JOIN circonscription c
                    ON a.id_circonscription = c.id_circonscription
                    JOIN ville v
                    ON a.id_ville = v.id_ville";
            $curseur = $this->pdo->query($sql);
            $curseur->setFetchMode(PDO::FETCH_ASSOC);
            
            while ($enregistrement = $curseur->fetch()){
                $enseignant = new Enseignant($enregistrement["id_enseignant"],$enregistrement["prenom_enseignant"],$enregistrement["nom_enseignant"]);
                $etablissement = new Etablissement($enregistrement["id_etablissement"],$enregistrement["nom_etablissement"],$enregistrement["adresse_1"],$enregistrement["adresse_3"]);
                $ville = new Ville($enregistrement["id_ville"], $enregistrement["code_postal"], $enregistrement["code_commune"], $enregistrement["nom_commune"]);
                $circonscription = new Circonscription($enregistrement["id_circonscription"], $enregistrement["nom_circonscription"]);
                
                $tableauEnseigant['enseignant']= $enseignant;
                $tableauEnseigant['etablissement'] = $etablissement;
                $tableauEnseigant['ville'] = $ville;
                $tableauEnseigant['circonscription'] = $circonscription;
                $tableauRetour[] = $tableauEnseigant;
            }
        } catch (Exception $ex) {
            $tableauEnseigant['error'] = $ex->getMessage();
            $tableauRetour[] = $tableauEnseigant['error'];
        }
        return $tableauRetour;
    }

    public function selectAll(): array {
        $tableau = array();

        try {
            $sql = "SELECT * FROM enseignant";
            $curseur = $this->pdo->query($sql);
            $curseur->setFetchMode(PDO::FETCH_NUM);
            while ($enregistrement = $curseur->fetch()) {
                $enseignant = new Enseignant($enregistrement[0], $enregistrement[1], $enregistrement[2], $enregistrement[3]);
                $tableau[] = $enseignant;
            }
        } catch (Exception $ex) {
            $tableau[0] = $ex->getMessage();
        }
        return $tableau;
    }

    public function insert(Enseignant $enseignant): int {
        $affected = 0;

        try {
            $cmd = $this->pdo->prepare("INSERT INTO enseignant (prenom_enseignant,nom_enseignant,id_etablissement) VALUES (?,?,?)");
            $cmd->bindValue(1, $enseignant->getPrenomEnseignant());
            $cmd->bindValue(2, $enseignant->getNomEnseignant());
            $cmd->bindValue(3, $enseignant->getIdentifiantEtablissement());
            $cmd->execute();

            $affected = $cmd->rowCount();
        } catch (Exception $ex) {
            $affected = -1;
            echo $ex->getMessage();
        }
        return $affected;
    }

    public function delete(Enseignant $enseignant): int {
        $affected = 0;

        try {
            $cmd = $this->pdo->prepare("DELETE FROM enseignant WHERE id_enseignant = ?");
            $cmd->bindValue(1, $enseignant->getIdEnseignant());
            $cmd->execute();

            $affected = $cmd->rowCount();
        } catch (Exception $ex) {
            $affected = -1;
        }
        return $affected;
    }

    public function update(Enseignant $enseignant): int {
        $affected = 0;

        try {
            $cmd = $this->pdo->prepare("UPDATE enseignant SET prenom_enseignant=?,nom_enseignant=?,id_etablissement=? WHERE id_enseignant=? ");
            $cmd->bindValue(1, $enseignant->getPrenomEnseignant());
            $cmd->bindValue(2, $enseignant->getNomEnseignant());            
            $cmd->bindValue(3, $enseignant->getIdentifiantEtablissement());            
            $cmd->bindValue(4, $enseignant->getIdEnseignant());
            $cmd->execute();

            $affected = $cmd->rowCount();
        } catch (Exception $ex) {
            $affected = -1;
        }
        return $affected;
    }

}
