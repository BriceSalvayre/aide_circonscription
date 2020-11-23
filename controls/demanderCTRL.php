<?php


// les require_once
require_once '../daos/RaisonDAO.php';
require_once '../daos/EtablissementDAO.php';
require_once '../daos/Connexion.php';
require_once '../daos/EnseignantDAO.php';
require_once '../daos/DemandeDAO.php';

//les filter_inputs


// debut de connexion
$cnx = new Connexion();
//$pdo =$cnx->seConnecter("../conf/bdDis.ini");
$pdo =$cnx->seConnecter("../conf/bdLoc.ini");



// declaration de la liste deroulante etablissment
$daoEtablissement = new EtablissementDAO($pdo);
$optionEtablissement ="";
$tableauEtablissement = $daoEtablissement->selectAll();

foreach ($tableauEtablissement as $enregistrement){
    $idEtablissement = $enregistrement->getIdentifiantEtablissement();
    $nomEtablissement = $enregistrement->getNomEtablissement();
    
    $optionEtablissement .= "<option value='$idEtablissement'>$idEtablissement  $nomEtablissement</option>";
}



//delclaration de la liste deroulante raison
$daoRaison = new RaisonDao($pdo);
$optionRaison ="";
$tableauRaison = $daoRaison->selectAll();


foreach ($tableauRaison as $enregistrement){
    $idRaison =$enregistrement->getIdRaison();
    $raison =$enregistrement->getRaison();
    
    $optionRaison .= "<option value='$idRaison'>$raison</option>";
}


// Message de validation
$message ="";
//Recuperation des saises
$btValider = filter_input(INPUT_POST,"btValider");
$etablissement = filter_input(INPUT_POST,"etablissement");
$raison = filter_input(INPUT_POST,"raison");
$name = filter_input(INPUT_POST,"name");
if ($btValider!=NULL){
    $daoDemande= new DemandeDAO($pdo);
    $demande = new Demande("",$etablissement,$raison,$name);
    $pdo->beginTransaction();
    $affected = $daoDemande->insert($demande);
    $pdo->commit();
    
    if($affected = 1){
    $objetEtablissement = $daoEtablissement->selectOne($etablissement);
    $a = $objetEtablissement->getIdentifiantEtablissement();
    $b = $objetEtablissement->getNomEtablissement();
    $message ="<p class='bg-success text-white'>demande effectuer pour l'etablissement $a $b </p>";
    }
}
include '../boundaries/demanderIHM.php';