<?php
$consulter = "active";
require_once '../controls/consulterCTRL.php';
?>
<!DOCTYPE html>
<!--
consulterIHM.php
-->

<html>
    <?php include 'header.php'; ?>
    <article>
        <div class="container">
            <form class="form-inline" action="#" method="POST">
                <input type="submit" name="demande" value="Demandes par circonscription" class="btn btn-outline-secondary">
                <input type="submit" name="enseignant" value="Affectation des contractuels" class="btn btn-outline-secondary">
                <input type="submit" name="etablissement" value="Liste etablissement" class="btn btn-outline-secondary">
            </form>
            <table class="table-hover table-bordered" width="100%">
                <?php
                echo $retour;
                ?>
            </table>
        </div>
    </article>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</html>

