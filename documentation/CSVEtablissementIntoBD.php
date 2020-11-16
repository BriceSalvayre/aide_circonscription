<?php
// CSVEtablissementIntoBD.php
header("Content-Type: text/html;charset=UTF-8");
require_once '../ressources/bibliotheque.php';
require_once '../daos/Connexion.php';

$enteteCommune = "id_etablissement,nom_etablissement,Type_etablissement,Statut_public_prive,adresse_1,Adresse_2,adresse_3,code_postal,code_commune,nom_commune,Code_departement,Code_academie,Code_region,Ecole_maternelle,Ecole_elementaire,Voie_generale,Voie_technologique,Voie_professionnelle,Telephone,Fax,Web,Mail,Restauration,Hebergement,ULIS,Apprentissage,Segpa,Section_arts,Section_cinema,Section_theatre,Section_sport,Section_internationale,Section_europeenne,Lycee_Agricole,Lycee_militaire,Lycee_des_metiers,Post_BAC,Appartenance_Education_Prioritaire,GRETA,SIREN_SIRET,Nombre_d_eleves,Fiche_onisep,`position`,Type_contrat_prive,Libelle_departement,Libelle_academie,Libelle_region,coordonnee_X,coordonnee_Y,epsg,nom_circonscription,latitude,longitude,precision_localisation,date_ouverture,date_maj_ligne,etat,ministere_tutelle,etablissement_multi_lignes,rpi_concentre,rpi_disperse,code_nature,libelle_nature,Code_type_contrat_prive,PIAL,etablissement_mere,type_rattachement_etablissement_mere,code_bassin_formation,libelle_bassin_formation";

$fichier = file_get_contents("fr-en-annuaire-education.csv");
$fichier = trim($fichier);
$ligne = explode("\n", $fichier);
$connexion = new Connexion();
//$pdo = $connexion->seConnecter("../conf/bdDis.ini");
$pdo = $connexion->seConnecter("../conf/bdLoc.ini");

$pdo->beginTransaction();
for ($i = 1; $i < count($ligne); $i++) {
    $enregistrement = explode(";", $ligne[$i]);
    insertIntoBDtest($pdo, $enregistrement, $enteteCommune);
   
}
$pdo->commit();
echo "terminer";
?>