<?php

require_once '../entities/Demande.php';
require_once '../entities/Circonscription.php';
require_once '../entities/Raison.php';
require_once '../entities/Etablissement.php';
require_once '../entities/Ville.php';
/**
 * Description of DemandeDAO
 *
 * @author brice
 */
class DemandeDAO {
    private $pdo;
    
    function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    /**
     * 
     * @return array
     */
    public function selectAllDemande(): array {
        $tableauDemande = array();
        $tableauRetour = array();
        try {
            $sql ="SELECT * FROM demande d JOIN etablissement e JOIN ville v JOIN circonscription c JOIN  raison r ON e.id_ville=v.id_ville AND e.id_circonscription = c.id_circonscription AND d.id_etablissement = e.id_etablissement AND d.id_raison = r.id_raison ORDER BY c.id_circonscription";
            $curseur = $this->pdo->query($sql);
            $curseur->setFetchMode(PDO::FETCH_ASSOC);
            while ($enregistrement = $curseur->fetch()) {
                $date = date_create($enregistrement["date_demande"]);
                $date = date_format($date,'d-m-Y');
                $demande = new Demande($enregistrement["id_demande"],$enregistrement["id_etablissement"],$enregistrement["id_raison"],$enregistrement["remplacant"],$date);
                $etablissement = new Etablissement($enregistrement["id_etablissement"], $enregistrement["nom_etablissement"], $enregistrement["adresse_1"], $enregistrement["adresse_3"]);
                $ville = new Ville($enregistrement["id_ville"], $enregistrement["code_postal"], $enregistrement["code_commune"], $enregistrement["nom_commune"]);
                $circonscription = new Circonscription($enregistrement["id_circonscription"], $enregistrement["nom_circonscription"]);
                $raison = new Raison($enregistrement["id_raison"],$enregistrement["raison"]);
                
                $tableauDemande['demande'] = $demande;
                $tableauDemande['raison'] = $raison;
                $tableauDemande['etablissement'] = $etablissement;
                $tableauDemande['ville'] = $ville;
                $tableauDemande['circonscription'] = $circonscription;
                $tableauRetour[] = $tableauDemande;
            }
        } catch (Exception $ex) {
            $tableauDemande['error'] = $ex->getMessage();
            $tableauRetour[] = $tableauDemande['error'];
        }
        return $tableauRetour;
    }
    
    /**
     * 
     * @param type $idCirconscription
     * @return array
     */
    public function selectAllDemandeByCirconscription($idCirconscription): array {
        $tableauDemande = array();
        $tableauRetour = array();
        try {
            $sql ="SELECT * FROM demande d JOIN etablissement e
                    JOIN ville v JOIN circonscription c JOIN  raison r
                    ON e.id_ville=v.id_ville
                    AND e.id_circonscription = c.id_circonscription
                    AND d.id_etablissement = e.id_etablissement
                    AND d.id_raison = r.id_raison
                    WHERE e.id_circonscription = ?
                    ORDER BY c.id_circonscription";
            $curseur = $this->pdo->prepare($sql);
            $curseur->bindValue(1,$idCirconscription);
            $curseur->execute();
            $curseur->setFetchMode(PDO::FETCH_ASSOC);
            while ($enregistrement = $curseur->fetch()) {
                $date = date_create($enregistrement["date_demande"]);
                $date = date_format($date,'d,m,Y');
                $demande = new Demande($enregistrement["id_demande"],$enregistrement["id_etablissement"],$enregistrement["id_raison"],$enregistrement["remplacant"],$date);
                $etablissement = new Etablissement($enregistrement["id_etablissement"], $enregistrement["nom_etablissement"], $enregistrement["adresse_1"], $enregistrement["adresse_3"]);
                $ville = new Ville($enregistrement["id_ville"], $enregistrement["code_postal"], $enregistrement["code_commune"], $enregistrement["nom_commune"]);
                $circonscription = new Circonscription($enregistrement["id_circonscription"], $enregistrement["nom_circonscription"]);
                $raison = new Raison($enregistrement["id_raison"],$enregistrement["raison"]);
                
                $tableauDemande['demande'] = $demande;
                $tableauDemande['raison'] = $raison;
                $tableauDemande['etablissement'] = $etablissement;
                $tableauDemande['ville'] = $ville;
                $tableauDemande['circonscription'] = $circonscription;
                $tableauRetour[] = $tableauDemande;
            }
        } catch (Exception $ex) {
            $tableauDemande['error'] = $ex->getMessage();
            $tableauRetour[] = $tableauDemande['error'];
        }
        return $tableauRetour;
    }
    
    
    /**
     * 
     * @return array
     */
    public function selectAll(): array{
        $tableau = array();
        
        try{
            $curseur = $this->pdo->query("SELECT * FROM demande");
            $curseur->setFetchMode(PDO::FETCH_NUM);
            while ($enregistrement = $curseur->fetch()){
                $demande = new Demande("$enregistrement[0]",$enregistrement[1],$enregistrement[2],$enregistrement[3],$enregistrement[4]);
                $tableau[] = $demande;
            }
        } catch (Exception $ex) {
            $tableau[]= $ex->getMessage();
        }
        return $tableau;
    }
    
    /**
     * 
     * @param Demande $demande
     * @return int
     */
    public function insert(Demande $demande): int {
        $affected = 0;

        try {
            $cmd = $this->pdo->prepare("INSERT INTO demande (id_etablissement,id_raison,remplacant,date_demande) VALUES (?,?,?,?)");
            $cmd->bindValue(1, $demande->getIdEtablissement());
            $cmd->bindValue(2, $demande->getIdRaison());
            $cmd->bindValue(3, $demande->getRemplacant());
            $cmd->bindValue(4, date('Y,m,d'));
            $cmd->execute();

            $affected = $cmd->rowCount();
        } catch (Exception $ex) {
            $affected = -1;
            echo $ex->getMessage();
        }

        return $affected;
    }
    
    /**
     * 
     * @param Demande $demande
     * @return int
     */
    public function delete(Demande $demande): int {
        $affected = 0;

        try {
            $cmd = $this->pdo->prepare("DELETE FROM demande WHERE id_demande = ?");
            $cmd->bindValue(1, $demande->getIdDemande());
            $cmd->execute();

            $affected = $cmd->rowCount();
        } catch (Exception $ex) {
            $affected = -1;
        }
        return $affected;
    }
    
    /**
     * 
     * @param Demande $demande
     * @return int
     */
    public function update(Demande $demande): int {
        $affected = 0;

        try {
            $cmd = $this->pdo->prepare("UPDATE demande SET id_etablissement=?,id_raison=?,remplacant=? WHERE id_demande = ?");
            $cmd->bindValue(1, $demande->getIdEtablissement());
            $cmd->bindValue(2, $demande->getIdRaison());
            $cmd->bindValue(3, $demande->getRemplacant());
            $cmd->bindValue(4, $demande->getIdDemande());
            $cmd->execute();

            $affected = $cmd->rowCount();
        } catch (Exception $ex) {
            $affected = -1;
        }
        return $affected;
    }

}
