<?php
$demander = "active";
?>
<!DOCTYPE html>
<!--
demanderIHM.php
-->

<html>
    <?php include 'header.php'; ?>
    <article>
        <div class="container">
            <br>
            <form action=../controls/demanderCTRL.php method="POST">                
                <div class="form-group">
                    <label for="etablissement">Etablissement :</label>
                    <select name="etablissement" id="etablissement" class="form-control">
                        <?php echo $optionEtablissement ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="raison">Raison :</label>
                    <select name="raison" id="etablissement" class="form-control">
                        <?php echo $optionRaison ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name" >Nom et Prénom titulaire remplacé (si remplacement) :</label>
                    <input type="text" placeholder="Entrer le nom et prenom" id="name" class="form-control" name="name">
                </div>
                <input type="submit" name="btValider" value="Valider">
            </form>
            <br>
            <?php echo $message;?>
    </article>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</html>
