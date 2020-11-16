<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//require_once '../daos/Connexion.php';
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
try {
    $cnx = new Connexion();
    $pdo = $cnx->seConnecter("bdpascal.ini");
   // $pdo = $cnx->seConnecter("../conf/bdDis.ini");
    $curseur = $pdo->query("SELECT * FROM ville");
    $curseur->setFetchMode(PDO::FETCH_NUM);
    foreach ($curseur as $enregistrement) {
        print_r ($enregistrement);
        echo "<br>";
    }
   // print_r($curseur);
} catch (Exception $ex) {
    echo -1;
}


 /* $host_name = 'db5001068964.hosting-data.io';
  $database = 'dbs919886';
  $user_name = 'dbu1105818';
  $password = 'M2iDWWM#';

  $link = new mysqli($host_name, $user_name, $password, $database);

  if ($link->connect_error) {
    die('<p>La connexion au serveur MySQL a échoué: '. $link->connect_error .'</p>');
  } else {
    echo '<p>Connexion au serveur MySQL établie avec succès.</p>';
  }*/
?>