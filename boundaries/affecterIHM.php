<?php
$affecter = "active";
?>
<!DOCTYPE html>
<!--
affecterIHM.php
-->

<html>
    <?php include 'header.php'; ?>
    <article>
        <div class="container">
            <br>
            <form action=../controls/affecterCTRL.php method="POST">
                <div class="form-group">
                    <label for="firstName" >Prenom :</label>
                    <input type="text" placeholder="Entrer le prenom" id="firstName" name="firstName" class="form-control">
                </div>
                <div class="form-group">
                    <label for="lastName" >Nom :</label>
                    <input type="text" placeholder="Entrer le nom" id="lastName" name="lastName" class="form-control">
                </div>
                <div class="form-group">
                    <label for="etablissement">Etablissement :</label>
                    <select name="etablissement" id="etablissement" class="form-control">
                        <?php echo $optionEtablissement ?>
                    </select>
                </div>
                <input type="submit" name="btValider" value="Valider">
            </form>
            <br>
            <?php echo $message; ?>
        </div>
    </article>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</html>
