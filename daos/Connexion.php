<?php

/**
 * Connexion.php : une bibliothèque
 *
 * seConnecter() : PDO(à partir d'un fichier ini)
 * seDeconnecter() : void
 */
class Connexion {

    /**
     *
     * @param type $psCheminParametresConnexion
     * @return null
     */
    public function seConnecter($psCheminParametresConnexion) {

        $tProprietes = parse_ini_file($psCheminParametresConnexion);

        $lsProtocole = $tProprietes["protocole"];
        $lsServeur = $tProprietes["serveur"];
        $lsPort = $tProprietes["port"];
        $lsUT = $tProprietes["ut"];
        $lsMDP = $tProprietes["mdp"];
        $lsBD = $tProprietes["bd"];

        /*
         * Connexion
         */
        $pdo = null;
        try {
            $pdo = new PDO("$lsProtocole:host=$lsServeur;port=$lsPort;dbname=$lsBD;", $lsUT, $lsMDP);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
            $pdo->exec("SET NAMES 'UTF8'");
        } catch (PDOException $ex) {
            
        }
        return $pdo;
    }

    /**
     *
     * @param PDO $pcnx
     */
    public function seDeconnecter(PDO &$pcnx) {
        $pcnx = null;
    }

}

?>