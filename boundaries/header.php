
<!DOCTYPE html>
<!--
header.php
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link href="../ressources/bootstrap/css/bootstrap.css" rel="stylesheet">
        <title>Aide circonscritpion</title>
        <link rel="icon" type="image/gif" href="../images/logoPage.jpg" />
    </head>
    <header>
        <div class="container">
            <div class="row">
                <div class="col md">
                    <img class="img-fluid" max-width:100%; src="../images/mergedImage.jpg" class="mx-auto d-block">
                </div>

                <!--<div class="col-10 md fondJaune"><h1>bandeau education national</h1></div>-->
            </div>
            <div class="row">
                <div class="col md ">
                    <nav class="navbar navbar-expand bg-dark navbar-dark">
                        <ul class="navbar-nav">
                            <li class="nav-item <?php echo $menu ?>">
                                <a class="nav-link" href="mainCTRL.php">Menu</a>
                            <li class="nav-item <?php echo $consulter ?>">
                                <a class="nav-link" href="consulterCTRL.php">Consulter</a>
                            </li>
                            <li class="nav-item <?php echo $demander ?>">
                                <a class="nav-link" href="demanderCTRL.php">Demander</a>
                            </li>
                            <li class="nav-item <?php echo $affecter ?>">
                                    <a class="nav-link" href="affecterCTRL.php">Affecter</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>    
</html>