-- A mettre a jour au niveau des noms et avec la demarche complete d'integration de la BD
-- ATTENTION circo 1 pas de code postal, entrer les valeurs dans la BD a la main ??


-- CREATION de notre table pour le fichier CSV(typage à revoir)
CREATE TABLE IF NOT EXISTS `etablissement` (
id_etablissement varchar(45) DEFAULT NULL,
nom_etablissement varchar(45) DEFAULT NULL,
Type_etablissement varchar(45) DEFAULT NULL,
Statut_public_prive varchar(45) DEFAULT NULL,
adresse_1 varchar(45) DEFAULT NULL,
Adresse_2 varchar(45) DEFAULT NULL,
adresse_3 varchar(45) DEFAULT NULL,
code_postal mediumint(11) unsigned DEFAULT NULL,
code_commune mediumint(11) unsigned DEFAULT NULL,
nom_commune varchar(45) DEFAULT NULL,
Code_departement mediumint(11) unsigned DEFAULT NULL,
Code_academie mediumint(11) unsigned DEFAULT NULL,
Code_region mediumint(11) unsigned DEFAULT NULL,
Ecole_maternelle mediumint(11) unsigned DEFAULT NULL,
Ecole_elementaire mediumint(11) unsigned DEFAULT NULL,
Voie_generale mediumint(11) unsigned DEFAULT NULL,
Voie_technologique mediumint(11) unsigned DEFAULT NULL,
Voie_professionnelle mediumint(11) unsigned DEFAULT NULL,
Telephone mediumint(11) unsigned DEFAULT NULL,
Fax varchar(45) DEFAULT NULL,
Web varchar(45) DEFAULT NULL,
Mail varchar(45) DEFAULT NULL,
Restauration varchar(45) DEFAULT NULL,
Hebergement varchar(45) DEFAULT NULL,
ULIS varchar(45) DEFAULT NULL,
Apprentissage varchar(45) DEFAULT NULL,
Segpa varchar(45) DEFAULT NULL,
Section_arts varchar(45) DEFAULT NULL,
Section_cinema varchar(45) DEFAULT NULL,
Section_theatre varchar(45) DEFAULT NULL,
Section_sport varchar(45) DEFAULT NULL,
Section_internationale varchar(45) DEFAULT NULL,
Section_europeenne varchar(45) DEFAULT NULL,
Lycee_Agricole varchar(45) DEFAULT NULL,
Lycee_militaire varchar(45) DEFAULT NULL,
Lycee_des_metiers varchar(45) DEFAULT NULL,
Post_BAC varchar(45) DEFAULT NULL,
Appartenance_Education_Prioritaire varchar(45) DEFAULT NULL,
GRETA varchar(45) DEFAULT NULL,
SIREN_SIRET mediumint(255) unsigned DEFAULT NULL,
Nombre_d_eleves mediumint(11) unsigned DEFAULT NULL,
Fiche_onisep varchar(45) DEFAULT NULL,
`position` float DEFAULT NULL,
Type_contrat_prive varchar(45) DEFAULT NULL,
Libelle_departement varchar(45) DEFAULT NULL,
Libelle_academie varchar(45) DEFAULT NULL,
Libelle_region varchar(45) DEFAULT NULL,
coordonnee_X float DEFAULT NULL,
coordonnee_Y float DEFAULT NULL,
epsg varchar(45) DEFAULT NULL,
nom_circonscription varchar(45) DEFAULT NULL,
latitude mediumint(11) unsigned DEFAULT NULL,
longitude mediumint(11) unsigned DEFAULT NULL,
precision_localisation varchar(45) DEFAULT NULL,
date_ouverture varchar(45) DEFAULT NULL,
date_maj_ligne varchar(45) DEFAULT NULL,
etat varchar(45) DEFAULT NULL,
ministere_tutelle varchar(45) DEFAULT NULL,
etablissement_multi_lignes varchar(45) DEFAULT NULL,
rpi_concentre varchar(45) DEFAULT NULL,
rpi_disperse varchar(45) DEFAULT NULL,
code_nature varchar(45) DEFAULT NULL,
libelle_nature varchar(45) DEFAULT NULL,
Code_type_contrat_prive varchar(45) DEFAULT NULL,
PIAL varchar(45) DEFAULT NULL,
etablissement_mere varchar(45) DEFAULT NULL,
type_rattachement_etablissement_mere varchar(45) DEFAULT NULL,
code_bassin_formation varchar(45) DEFAULT NULL,
libelle_bassin_formation varchar(45) DEFAULT NULL,
PRIMARY KEY (id_etablissement)

)ENGINE=INNODB  DEFAULT CHARSET=utf8;


-- AVANT DE POURSUIVRE INTEGRATION DU FICHIER CSV DANS LA BD OBLIGATOIRE "CSVEtablissementIntoBD.php"

-- Suppression des etablissement Privé
DELETE FROM etablissement WHERE Statut_public_prive ='Privé';

-- Suppression de toute les tables qui ne nous intérèsse pas après intégration dans la BD
ALTER TABLE `etablissement`
  DROP `Type_etablissement`,
  DROP `Adresse_2`,
  DROP Code_departement,
  DROP Code_academie,
  DROP Code_region,
  DROP Voie_generale,
  DROP Voie_technologique,
  DROP Voie_professionnelle,
  DROP Telephone,
  DROP Fax,
  DROP Web,
  DROP Mail,
  DROP Restauration,
  DROP Hebergement,
  DROP ULIS,
  DROP Apprentissage,
  DROP Segpa,
  DROP SIREN_SIRET,
  DROP Nombre_d_eleves,
  DROP Fiche_onisep,
  DROP `position`,
  DROP Type_contrat_prive,
  DROP Libelle_departement,
  DROP Libelle_academie,
  DROP Libelle_region,
  DROP coordonnee_X,
  DROP coordonnee_Y,
  DROP epsg,
  DROP nom_circonscription,
  DROP latitude,
  DROP longitude,
  DROP precision_localisation,
  DROP date_ouverture,
  DROP date_maj_ligne,
  DROP etat,
  DROP ministere_tutelle,
  DROP etablissement_multi_lignes,
  DROP rpi_concentre,
  DROP rpi_disperse,
  DROP code_nature,
  DROP libelle_nature,
  DROP Code_type_contrat_prive,
  DROP PIAL,
  DROP etablissement_mere,
  DROP type_rattachement_etablissement_mere,
  DROP code_bassin_formation,
  DROP libelle_bassin_formation,
  DROP Section_arts,
  DROP Section_cinema,
  DROP Section_theatre,
  DROP Section_sport,
  DROP Section_internationale,
  DROP Section_europeenne,
  DROP Lycee_Agricole,
  DROP Lycee_militaire,
  DROP Lycee_des_metiers,
  DROP Appartenance_Education_Prioritaire,
  DROP Post_BAC,
  DROP GRETA,
  DROP Ecole_maternelle,
  DROP Ecole_elementaire,
  DROP Statut_public_prive;
  
  
-- Creation des tables
  
-- creation de la table "ville"
  CREATE TABLE ville  SELECT DISTINCT code_postal,code_commune,nom_commune FROM etablissement;
  
-- Ajout dans la table ville de la colonne "id_ville" en clef primaire
  ALTER TABLE ville ADD id_ville INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (id_ville);
  
-- Ajout de la "FOREIGN KEY" id_ville dans la table "etablissement"
  ALTER TABLE etablissement ADD id_ville INT NOT NULL , ADD INDEX (id_ville);
  
-- Ajout de la "FOREIGN KEY" id_circonscription dans la table "etablissement"
  ALTER TABLE etablissement ADD id_circonscription INT NOT NULL, ADD INDEX (id_circonscription);  
  
-- Mise a jour de la table "etablissement" par rapport a "id_ville"
  UPDATE etablissement e JOIN ville v SET e.id_ville = v.id_ville WHERE e.nom_commune=v.nom_commune AND e.code_postal=v.code_postal;
-- explication: id_ville=0 dans la table "etablissement" le but est d'atribuer la valeur de id_ville(ville) dans id_ville(etablissement) quand ils partagent le meme code postal ET nom de commune
  -- info bonus: dans les yvelines certaines villes partagent le meme Code postal et d'autres villes le meme nom d'ou la double verification	
  
-- Suppresion des colonnes inutile desormais dans la table "etablissement"
  ALTER TABLE `etablissement` DROP code_postal, DROP code_commune, DROP nom_commune;
  
-- Creation de la table "circonscription"
CREATE TABLE IF NOT EXISTS circonscription (
id_circonscription int(3) DEFAULT NULL AUTO_INCREMENT,
nom_circonscription varchar(45) DEFAULT NULL,
PRIMARY KEY (id_circonscription),
UNIQUE (nom_circonscription)

);

-- Creation de la table "utilisateur"
CREATE TABLE IF NOT EXISTS utilisateur (
id_utilisateur int(3) DEFAULT NULL AUTO_INCREMENT,
identifiant_utilisateur varchar(45) DEFAULT NULL,
mdp_utilisateur varchar(45) DEFAULT NULL,
email_utilisateur varchar(45) DEFAULT NULL,
PRIMARY KEY (id_utilisateur),
UNIQUE (identifiant_utilisateur),
UNIQUE (email_utilisateur)
);

-- Creation de la table "raison"
CREATE TABLE IF NOT EXISTS raison (
id_raison int(3) NOT NULL AUTO_INCREMENT,
raison varchar(45) DEFAULT NULL,
PRIMARY KEY (id_raison)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Creation de la table "enseignant"
CREATE TABLE IF NOT EXISTS enseignant (
id_enseignant int(3) NOT NULL AUTO_INCREMENT,
prenom_enseignant varchar(45) DEFAULT NULL,
nom_enseignant varchar(45) DEFAULT NULL,
id_etablissement varchar(45) DEFAULT NULL,
PRIMARY KEY (id_enseignant),
FOREIGN KEY (id_etablissement) REFERENCES `etablissement`(id_etablissement)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- VOIR DIFFERENCE AVEC PRECEDENT
-- CREATE TABLE IF NOT EXISTS enseignant (
-- id_enseignant int(3) DEFAULT NULL,
-- prenom_enseignant varchar(45) DEFAULT NULL,
-- nom_enseignant varchar(45) DEFAULT NULL,
-- date_naissance_enseignant date DEFAULT NULL,
-- id_etablissement varchar(45) DEFAULT NULL,
-- PRIMARY KEY (id_enseignant),
-- CONSTRAINT fk_etablissement_enseignant FOREIGN KEY(id_etablissement) REFERENCES
-- `etablissement`(id_etablissement)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Creation de la table demande
CREATE TABLE IF NOT EXISTS demande (
id_demande int(3) NOT NULL AUTO_INCREMENT,
id_etablissement varchar(45) DEFAULT NULL,
date_demande date DEFAULT NULL,
id_raison int(3) DEFAULT NULL,
remplacant varchar(45) DEFAULT NULL,
PRIMARY KEY (id_demande),
FOREIGN KEY (id_etablissement) REFERENCES `etablissement`(id_etablissement),
FOREIGN KEY (id_raison) REFERENCES raison(id_raison)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- AVANT DE POURSUIVRE INTEGRATION MISE EN PLACE DU FICHIER CSVUpdateCirconscription.php