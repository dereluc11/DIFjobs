<!DOCTYPE html>
<html lang="nl">
<head>
    <?php
    session_start();
    include("../template/header.php");
    require_once("../config.php");

    //vacature tellen voor de counter
    $vacCount = $mysqli->query("SELECT * FROM vacature");
    ?>
</head>

<body>
<nav class="navbar navbar-expand-lg bg-dark">
    <?php
    include('../template/nav.php')
    ?>
</nav>


<?php
//stukje php dat succesfully responded weergeeft wanneer er geredirect wordt na een post en de reactie succesvol is opgeslagen
if (isset($_GET['postsuccess']) && $_GET['postsuccess'] == 1) {
    echo "Je hebt succesvol op de vacature gereageerd!";
}

if (isset($_GET['postsuccess']) && $_GET['postsuccess'] == 2) {
    echo "Je hebt succesvol een vacature geplaatst!";
}

?>

<div class="container-fluid">
    <div class="row mt-sm-4 ml-sm-2 mr-sm-2">
        <div class="col-lg-12">
            <h1>Home</h1>
            <hr/>
        </div>
    </div>

    <div class="row ml-sm-2 mr-sm-2">
        <div class="col-lg-12 mt-3">
            <?php
            if (isset($_GET['loginSucces'])) {
                echo "<div class='alert alert-success'>Je bent succesvol ingelogd.</div>";
            } elseif (isset($_GET['loginError'])) {
                echo "<div class='alert alert-danger'>Er is iets mis gegaan tijdens het in loggen, probeer het opnieuw of neem contact op met de beheerder.</div>";
            }
            ?>
        </div>
    </div>
    <div class="row ml-sm-2 mr-sm-2">
        <div class="col-lg-12 mt-3">
            <div class="card card-green">
                <div class="card-heading">
                    <div class="row px-lg-3 py-lg-3">
                        <div class="col-sm-3">
                            <i class="fa fa-briefcase fa-5x"></i>
                        </div>
                        <div class="col-sm-9 text-right">
                            <div class="huge">
                                <?php
                                //toont aantal vacatures in de db
                                echo $vacCount->num_rows; ?>
                            </div>
                            <div>
                                Vacatures!
                            </div>
                        </div>
                    </div>
                </div>
                <a href="jobs.php">
                    <div class="card-footer">
                        <span class="pull-left">Toon direct</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>


<div class="row ml-sm-2 mr-sm-2 mt-lg-4">
    <div class="col-lg-12">
        <h2>Welkom op Dif Jobs!</h2>
        <p>
            Dif Jobs is de website die bedrijven, particulieren en studenten bij elkaar brengt zodat er productieve
            samenwerkingen onstaan waar iedereen
            baat bij hebben. Bedrijven en particulieren kunnen na het registreren van een account advertenties
            plaatsen met daarin vraagstukken opdrachten
            die door studenten kunnen worden uitgevoerd. De advertenties worden weergegeven op de jobs pagina.
            Studenten kunnen na het registreren van een
            account op advertenties reageren door een bericht te sturen naar het bedrijf dat de advertentie heeft
            geplaatst. Dit doe je door
            simpelweg op de reageerknop onder een advertentie te klikken.
        </p>
    </div>
</div>
</div>

</body>
</html>

