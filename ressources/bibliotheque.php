<?php


/**
 * 
 * @param PDO $pdo
 * @param array $tAttributesValues
 * @param type $entete
 * @return int
 */
function insertIntoBDtest(PDO $pdo, array $tAttributesValues, $entete): int {
    $affected = 0;
    $nbrEntete = explode(",", $entete); // $nbrEntete est un tableau contenant tout les enregistrements d'une ligne
    $value = count($tAttributesValues);
    if (count($nbrEntete) == $value) {
        $nbr = "?"; // initialisation de la variable $nbr qui va servir à concatener les "?"
        for ($i = 1; $i < count($nbrEntete); $i++) { // boucle qui concatène les "?" en fonction du nombre de colonne
            $nbr .= ",?";
        }

        try {
            $sql = "INSERT INTO etablissement ($entete) VALUES ($nbr)"; // commande SQL insert
            $statement = $pdo->prepare($sql);
            for ($i = 1; $i <= count($nbrEntete); $i++) { //boucle qui permet d'attribuer les champs à la BD
                $y = $i - 1;
                $statement->bindValue($i, $tAttributesValues[$y]);
            }
            $statement->execute(); // ne pas oublier !!!
            $affected = $statement->rowcount(); // retour (on sait jamais) du nombre de champs modifié
        } catch (Exception $ex) {
            $affected = -1; // en cas d'erreur
            //echo $ex->getMessage();
        }
    } else {
        $canal = fopen("log.txt", "a+");
        $diff = (count($nbrEntete) - $value);
        fwrite($canal, " il y a une erreur pour l'enregistrement $tAttributesValues[0] il manque $diff enregistrement(s) \r\n");
    }
    return $affected;
}

/**
 * 
 * @param type $pdo
 * @param type $valeur
 * @return int
 */
function insertNomCirco($pdo, $valeur): int {
    $affected = 0;
    try {
        $sql = "INSERT INTO circonscription (nom_circonscription) VALUE (?)";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(1, $valeur);
        $statement->execute();
        $affected = $statement->rowCount();
    } catch (Exception $ex) {
        $affected = -1;
        echo $ex->getMessage();
    }
    return $affected;
}

/**
 * 
 * @param type $pdo
 * @param type $id
 * @param type $cp
 * @return int
 */
function updateIdVille($pdo,$idCirco,$cdCommune): int {
    $affected = 0;
    try {
        $statement = $pdo->prepare("UPDATE ville v SET v.id_circonscription = ? WHERE v.code_commune= ?");
        $statement->bindValue(1,$idCirco);
        $statement->bindValue(2,$cdCommune);
        $statement->execute();
        $affected = $statement->rowCount();
    } catch (Exception $ex) {
        $affected = -1;
        echo $ex->getMessage();
    }
    return $affected;
}


/**
 * 
 * @param type $pdo
 * @param type $id
 * @param type $cp
 * @return int
 */
function updateIdCirconscription($pdo,$idCirco,$idEtablissement): int {
    $affected = 0;
    try {
        $statement = $pdo->prepare("UPDATE etablissement e SET e.id_circonscription = ? WHERE e.id_etablissement= ?");
        $statement->bindValue(1,$idCirco);
        $statement->bindValue(2,$idEtablissement);
        $statement->execute();
        $affected = $statement->rowCount();
    } catch (Exception $ex) {
        $affected = -1;
        echo $ex->getMessage();
    }
    return $affected;
}
