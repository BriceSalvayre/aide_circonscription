<?php

/*
 * consulterCTRL.php
 */

require_once '../daos/Connexion.php';
require_once '../daos/EtablissementDAO.php';
require_once '../daos/EnseignantDAO.php';
require_once '../daos/DemandeDAO.php';

$cnx = new Connexion();
$pdo = $cnx->seConnecter("../conf/bdDis.ini");

$retour = "";


$tableauRetour = array();
$tableau = array();


$listeEtablissement = filter_input(INPUT_POST, "etablissement");
$listeDemande = filter_input(INPUT_POST, "demande");
$listeEnseignant = filter_input(INPUT_POST, "enseignant");

if ($listeEtablissement != NULL) {
    $dao = new EtablissementDAO($pdo);
    $tableau = $dao->selectAllTable();
    $enteteTableau = "<tr>
                    <th>N°Etablissement</th>
                    <th>Nom Etablissement</th>
                    <th>Code postal</th>
                    <th>Commune</th>
                    <th>Circonscription</th>
                    </tr>";
    foreach ($tableau as $enregistrement) {
        //print_r($enregistrement['etablissement']);
        $tableauRetour[] = "<tr><td>" . $enregistrement['etablissement']->getIdentifiantEtablissement() . "</td><td>" . $enregistrement['etablissement']->getNomEtablissement()
                . "</td><td>" . $enregistrement['ville']->getCodePostal() . "</td><td>" . $enregistrement['ville']->getNomCommune() . "</td><td>"
                . $enregistrement['circonscription']->getNomCirconscription() . "</td></tr>";
        //. $enregistrement->getNomEtablissement();
    }
    $retour = $enteteTableau;
    for ($i = 0; $i < count($tableauRetour); $i++) {
        $retour .= $tableauRetour[$i];
    }
}

if ($listeDemande != NULL) {
    $enteteTableau= "<tr>"
            . "<th>Nature demande</th>"
            . "<th>Date demande</th>"
            . "<th>N° Etablissement</th>"
            . "<th>Nom Etablissement</th>"
            . "<th>Ville</th>"
            . "<th>Circonsciption</th>";
    $dao = new DemandeDAO($pdo);
    $tableau = $dao->selectAllDemande();
    foreach ($tableau as $enregistrement) {
        $tableauRetour[] = "<tr><td>".$enregistrement['raison']->getRaison()
                            ."</td><td>".$enregistrement['demande']->getDateDemande()
                            ."</td><td>".$enregistrement['etablissement']->getIdentifiantEtablissement()
                            ."</td><td>".$enregistrement['etablissement']->getNomEtablissement()
                            ."</td><td>".$enregistrement['ville']->getNomCommune()
                            ."</td><td>".$enregistrement['circonscription']->getNomCirconscription()
                            ."</td></tr>";
    }
    $retour = $enteteTableau;
    for ($i = 0; $i < count($tableauRetour); $i++) {
        $retour .= $tableauRetour[$i];
    }
}

if ($listeEnseignant != NULL) {
    $enteteTableau =  "<tr>
                        <th>Enseignant</th>
                        <th>N° Etablissement</th>
                        <th>Nom Etablissement</th>
                        <th>Commune</th>
                        <th>Circonscription</th>
                    </tr>";
$dao = new EnseignantDAO($pdo);
$tableau = $dao->selectEverything();
    foreach ($tableau as $enregistrement) {
        $tableauRetour[] = "<tr><td>" . $enregistrement['enseignant']->getPrenomEnseignant() . " " . $enregistrement['enseignant']->getNomEnseignant() . "</td><td>" . $enregistrement['etablissement']->getIdentifiantEtablissement() . "</td><td>" . $enregistrement['etablissement']->getNomEtablissement()
                . "</td><td>" . $enregistrement['ville']->getNomCommune() . "</td><td>" . $enregistrement['circonscription']->getNomCirconscription() . "</td></tr>";
    }
    $retour = $enteteTableau;
    for ($i = 0; $i < count($tableauRetour); $i++) {
        $retour .= $tableauRetour[$i];
    }
}

include '../boundaries/consulterIHM.php';
