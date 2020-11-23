<?php


// les require_once
require_once '../daos/EtablissementDAO.php';
require_once '../daos/Connexion.php';
require_once '../daos/EnseignantDAO.php';
require_once '../entities/Enseignant.php';

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

$message ="";
$btValider = filter_input(INPUT_POST,"btValider");
$prenomEnseignant = filter_input(INPUT_POST,"firstName");
$nomEnseignant = filter_input(INPUT_POST,"lastName");
$idEtablissement = filter_input(INPUT_POST,"etablissement");

if ($btValider!=NULL){
    $DAOEnseignant = new EnseignantDAO($pdo);
    $pdo->beginTransaction();
    $enseignant = new Enseignant("", $prenomEnseignant, $nomEnseignant, $idEtablissement);
    $DAOEnseignant->insert($enseignant);
    $pdo->commit();
    
    $objetEtablissement = $daoEtablissement->selectOne($idEtablissement);
    $a = $objetEtablissement->getIdentifiantEtablissement();
    $b = $objetEtablissement->getNomEtablissement();
    $message ="<p class='bg-success text-white'>$prenomEnseignant $nomEnseignant à été affecter au $a $b !</p>";
}


include '../boundaries/affecterIHM.php';
