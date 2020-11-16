<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../daos/Connexion.php';
require_once '../daos/EtablissementDAO.php';
require_once '../daos/VilleDAO.php';
require_once '../daos/CirconscriptionDAO.php';
require_once '../daos/EnseignantDAO.php';
require_once '../daos/RaisonDAO.php';
require_once '../daos/DemandeDAO.php';


try {
    /*$cnx = new Connexion();
    $pdo = $cnx->seConnecter("../conf/bdDis.ini");
    $pdo->beginTransaction();
    
    
    $dao = new EtablissementDAO($pdo);

//TEST ETABLISEMENT  insert delete update !!!
    
    //INSERT
    $etablissement = New Etablissement("0780000B","brice","chezmoi","78370",22);
    $affected = $dao->insert($etablissement);
    echo "TEST INSERT"."<br>";
    $tableau =$dao->selectOne($etablissement->getIdentifiantEtablissement());
    echo $tableau->getIdentifiantEtablissement()." ".$tableau->getNomEtablissement()." ".$tableau->getAdresse1()." ".$tableau->getAdresse3()." id ville = ".$tableau->getIdVille()."(Via SELECTONE)<br>"; 
    echo $affected."<br><hr>";
    //UPDATE
    echo "TEST UPDATE"."<br>";
    $etablissement = New Etablissement("0780000B","pierre","chezlui","78000",40);
    $affected = $dao->update($etablissement);
    $tableau =$dao->selectOne($etablissement->getIdentifiantEtablissement());
    echo $tableau->getIdentifiantEtablissement()." ".$tableau->getNomEtablissement()." ".$tableau->getAdresse1()." ".$tableau->getAdresse3()." id ville = ".$tableau->getIdVille()."(Via SELECTONE)<br>";    
    echo $affected."<br><hr>";
    //DELETE
    echo "TEST DELETE"."<br>";
    $etablissement = New Etablissement("0780000B");
    $affected = $dao->delete($etablissement);
    $tableau =$dao->selectOne($etablissement->getIdentifiantEtablissement());
    echo $tableau->getIdentifiantEtablissement()." ".$tableau->getNomEtablissement()." ".$tableau->getAdresse1()." ".$tableau->getAdresse3()." ".$tableau->getIdVille()."(Via SELECTONE)<br>";     
    echo $affected."<br><hr>";
    
    
    // TEST ETABLISSEMENT SELECTALL !!!
    echo "TEST SELECTALLTABLE"."<br>";
    $tableau = array();
    $tableau = $dao->selectAllTable();
    foreach ($tableau as $enregistrement) {
        //print_r($enregistrement['etablissement']);
       echo $enregistrement['etablissement']->getIdentifiantEtablissement() . " - ".$enregistrement['etablissement']->getNomEtablissement()
                ." - ". $enregistrement['ville']->getCodePostal(). " - " . $enregistrement['ville']->getNomCommune()." - "
                .$enregistrement['circonscription']->getNomCirconscription()."<br>";
        //. $enregistrement->getNomEtablissement();
    }*/

    
    
    
    
    
    //$dao = new CirconscriptionDAO($pdo);
    
    // TEST CIRCONSCRIPTION insert delete update !!!!
    //$circonscription = new Circonscription("32",32,"ASH2YVELINES2");
    //$circonscription = new Circonscription(31);
    //$affected = $dao->insert($circonscription);
    //$affected = $dao->delete($circonscription);
    //$affected = $dao->update($circonscription);
    
    
    // TEST ENSEIGNANT insert delete update  !!!
    /*$dao = new EnseignantDAO($pdo);
    $enseignant = new Enseignant("","Jade","Salvayre","0780000B");
    //$enseignant = new Enseignant("1");
    $affected = $dao->insert($enseignant);
    //$affected = $dao->delete($enseignant);
    //$affected = $dao->update($enseignant);
    //
    //selectAll
    ///$affected = array();
    //$affected= $dao->selectAll();*/
    //$pdo->commit();
    //echo $affected;
    //echo $affected[0]->getPrenomEnseignant();
    
    
    //TEST DEMANDE insert delete update
   // $dao = new DemandeDAO($pdo);
    //$demande = new Demande("","0780000B","5","pas de ramplacant");
    //$demande = new Demande (1);
    //$affected =$dao->insert($demande);
    //$affected = $dao->delete($demande);
    
   // $tableau =$dao->selectAllDemandeByCirconscription(2);
    
   // print_r($tableau);
  //  $pdo->commit();
    //echo $affected;
    
  //$date = date('Y,m,d');
 $date = date_create('2020-02-25');
 $date = date_format($date,'d,m,Y');
  
  echo $date ;
} catch (Exception $ex) {
    
}