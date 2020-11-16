<?php

/**
 * EtablissementDAO.PHP
 * Description of EtablissementDAO
 *
 * @author brice
 */
require_once '../entities/Etablissement.php';
require_once '../entities/Ville.php';
require_once '../entities/Circonscription.php';

class EtablissementDAO {

    private $pdo;

    function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
    
    
    /**
     * 
     * @return array
     */
    public function selectAll(): array {
        $tableau = array();

        try {
            $curseur = $this->pdo->query("SELECT * FROM etablissement");
            $curseur->setFetchMode(PDO::FETCH_NUM);
            while ($enregistrement = $curseur->fetch()) {
                $etablissement = new Etablissement($enregistrement[0], $enregistrement[1], $enregistrement[2], $enregistrement[3], $enregistrement[4]);
                $tableau[] = $etablissement;
            }
        } catch (Exception $ex) {
            $tableau[] = $ex->getMessage();
        }
        return $tableau;
    }
    
    
    /**
     * Select avec jointure de table "ville" et "circonscription"
     * 
     * @return array $tableauRetour     * 
     * $tableauRetour est un tableau ordinal de tableau associatif d'objet ( un tableau de tableau d'objet)
     */
    public function selectAllTable(): array {
        // déclaration des tableaux de retour
        $tableauEtablissement = array();
        $tableauRetour = array();
        try {
            $sql ="SELECT * FROM etablissement e JOIN ville v JOIN circonscription c ON e.id_ville=v.id_ville AND e.id_circonscription = c.id_circonscription ORDER BY c.id_circonscription";
            $curseur = $this->pdo->query($sql);
            $curseur->setFetchMode(PDO::FETCH_ASSOC);
            while ($enregistrement = $curseur->fetch()) {
                //Création de nos objets
                $etablissement = new Etablissement($enregistrement["id_etablissement"], $enregistrement["nom_etablissement"], $enregistrement["adresse_1"], $enregistrement["adresse_3"]);
                $ville = new Ville($enregistrement["id_ville"], $enregistrement["code_postal"], $enregistrement["code_commune"], $enregistrement["nom_commune"]);
                $circonscription = new Circonscription($enregistrement["id_circonscription"], $enregistrement["nom_circonscription"]);
                
                //Insertion des objets dans un tableau associatif
                $tableauEtablissement['etablissement'] = $etablissement;
                $tableauEtablissement['ville'] = $ville;
                $tableauEtablissement['circonscription'] = $circonscription;
                
                //Insertion du tableau associatif dans un tableau ordinal
                $tableauRetour[] = $tableauEtablissement;
            }
        } catch (Exception $ex) {
            $tableauEtablissement['error'] = $ex->getMessage();
            $tableauRetour[] = $tableauEtablissement['error'];
        }
        return $tableauRetour;
    }
    
    /**
     * 
     * @param Etablissement $etablissement
     * @return int
     */
    public function insert(Etablissement $etablissement): int {
        $affected = 0;

        try {
            $cmd = $this->pdo->prepare("INSERT INTO etablissement (id_etablissement,nom_etablissement,adresse_1,adresse_3,id_ville) VALUES (?,?,?,?,?)");
            $cmd->bindValue(1, $etablissement->getIdentifiantEtablissement());
            $cmd->bindValue(2, $etablissement->getNomEtablissement());
            $cmd->bindValue(3, $etablissement->getAdresse1());
            $cmd->bindValue(4, $etablissement->getAdresse3());
            $cmd->bindValue(5, $etablissement->getIdVille());
            $cmd->execute();

            $affected = $cmd->rowCount();
        } catch (Exception $ex) {
            $affected = -1;
        }
        return $affected;
    }
    
    
    /**
     * 
     * @param Etablissement $etablissement
     * @return int
     */
    public function delete(Etablissement $etablissement): int {
        $affected = 0;

        try {
            $cmd = $this->pdo->prepare("DELETE FROM etablissement where id_etablissement = ?");
            $cmd->bindValue(1, $etablissement->getIdentifiantEtablissement());
            $cmd->execute();

            $affected = $cmd->rowCount();
        } catch (Exception $ex) {
            $affected = -1;
        }
        return $affected;
    }
    
    /**
     * 
     * @param Etablissement $etablissement
     * @return int
     */
    public function update(Etablissement $etablissement): int {
        $affected = 0;

        try {
            $cmd = $this->pdo->prepare(" UPDATE etablissement SET nom_etablissement=?,adresse_1=?,adresse_3=?,id_ville=? WHERE id_etablissement=?");
            $cmd->bindValue(1, $etablissement->getNomEtablissement());
            $cmd->bindValue(2, $etablissement->getAdresse1());
            $cmd->bindValue(3, $etablissement->getAdresse3());
            $cmd->bindValue(4, $etablissement->getIdVille());
            $cmd->bindValue(5, $etablissement->getIdentifiantEtablissement());
            $cmd->execute();

            $affected = $cmd->rowCount();
        } catch (Exception $ex) {
            $affected = -1;
        }
        return $affected;
    }

    public function selectOne($pk): Etablissement {
        try {
            $curseur = $this->pdo->prepare("SELECT * FROM etablissement WHERE id_etablissement = ?");
            $curseur->bindValue(1, $pk);
            $curseur->execute();
            $enregistrment = $curseur->fetch();
            if ($enregistrment != null) {
                $etablissement = new Etablissement($enregistrment[0], $enregistrment[1],$enregistrment[2],$enregistrment[3],$enregistrment[4]);
            } else {
                $etablissement = new Etablissement("0", "Introuvable");
            }
            $curseur->closeCursor();
        } catch (Exception $ex) {
            $etablissement = new Etablissement("-1", $exc->getMessage());
        }
        return $etablissement;
    }

}
