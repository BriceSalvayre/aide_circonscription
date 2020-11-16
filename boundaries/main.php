<?php $menu = "active"?>
<!DOCTYPE html>
<html>
    <?php include 'header.php'; ?>
    <article>
        <div class="container">
            <div class="jumbotron">
                <h1>Bienvenue sur le site d'aide pour les contractuels</h1>
                <p> Ce site est un outils qui a pour but de vous aider dans la saisie des contractuels dans la base de données </p>
                <p> Ce site en construction merci de votre indulgence</p>
            </div>
            <div class="row">
                <div class="col md">
                    <div class="card">
                        <div class="card-body">
                            <a href="consulterCTRL.php">
                                <h5 class="card-title">Consulter</h5>
                                <p class="card-text">Consulter la liste des demandes<br><br></p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col md ">
                    <div class="card">
                        <a href="demanderCTRL.php">
                            <div class="card-body">
                                <h5 class="card-title">Faire une demande</h5>
                                <p class="card-text">Faire une demande de contractuel pour un etablissement</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col md ">
                    <div class="card">
                        <a href="affecterCTRL.php">
                            <div class="card-body">
                                <h5 class="card-title">Affecter un contractuel</h5>
                                <p class="card-text">Case reservé à la DSDEN<br><br></p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</html>