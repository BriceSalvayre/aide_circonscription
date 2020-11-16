<?php

// CSVUpdateCirconscription.php
header("Content-Type: text/html;charset=UTF-8");
require_once '../ressources/bibliotheque.php';
require_once '../daos/Connexion.php';
require_once '../daos/VilleDAO.php';
require_once '../daos/EtablissementDAO.php';

$cnx = new Connexion();
//$pdo = $cnx->seConnecter("../conf/bdDis.ini");
$pdo = $cnx->seConnecter("../conf/bdLoc.ini");

//Récupération et lecture du fichier "circo2" 
$fichier = file_get_contents("circo2.csv");
$fichier = trim($fichier);
// on explose le fichier ligne par ligne
$ligne = explode("\n",$fichier);

$pdo->beginTransaction();

// on boucle sur l'intégralité du tableau $ligne
for($i=0; $i<count($ligne); $i++){
    // on récupère chaque enregistrement par ligne
    $enregistrement = explode(";",$ligne[$i]);
    // si l'enregistrement ne comporte qu'un élément alors c'est un nom de circonscription
    if (count($enregistrement)<=2){
    insertNomCirco($pdo, $enregistrement[0]);
    }
}
$pdo->commit();

//Récupération et lecture du fichier "circo" 
$fichier = file_get_contents("circo.csv");
$fichier = trim($fichier);

// on explose le fichier paragraphe par paragraphe
$circo = explode("\n\n", $fichier);

$pdo->beginTransaction();

// on boucle sur l'intégralité du tableau $circo
for ($i = 0; $i < count($circo); $i++) {
    $ligne = explode("\n", $circo[$i]);
    
    // on explose le fichier ligne par ligne
    for ($y = 1; $y < count($ligne); $y++) {
        // on récupère chaque enregistrement par ligne
        $enregistrement = explode(";", $ligne[$y]);
        
        // on récupère l'etablissment de la ligne 
        $daoEtabl = new EtablissementDAO($pdo);
        $etablissement = $daoEtabl->selectOne($enregistrement[1]);

        // on associe l'établissement à la circonscription $z
        $z = $i + 1;
        updateIdCirconscription($pdo, $z, $etablissement->getIdentifiantEtablissement());
    }
}
$pdo->commit();
echo "fini";