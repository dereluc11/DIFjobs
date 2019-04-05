<?php
/**
 * Created by PhpStorm.
 * User: mmoer
 * Date: 5/23/2018
 * Time: 11:47 AM
 */

session_start();

if (isset($_SESSION['ID'])) {

    //haal config.php op
    require_once("../config.php");

    //haal gegevens op uit GET en SESSION
    $title = $_GET['titel'];

    $Vdate = str_replace("_", " ", $_GET['datum']);
    $Vdate = date_format(new DateTime($Vdate), "Y-m-d h:i:s");
    $userID = $_SESSION['ID'];

    //maak query om gegevens uit reactie te halen
    $reactieQuery = $mysqli->query("SELECT g.Naam, g.Email, r.bericht, r.datum FROM reactie r
                                        JOIN gebruiker g ON r.SgebruikerID = g.ID
                                        WHERE Vtitel = '" . $title . "' AND Vdatum = '" . $Vdate . "' AND VgebruikerID = " . $userID);

}

?>
<html>
<head>
    <?php include("../template/header.php"); ?>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark">
    <?php
    include('../template/nav.php')
    ?>
</nav>

<div class="container-fluid">
    <div class="row mt-lg-2">
        <div class="col-lg-12">
            <h1>Reacties:</h1>
            <hr/>
        </div>
    </div>


    <?php


    //counter voor de styling
    $counter = 0;

    //while loop om alle reacties op het scherm te zetten
    while ($rij = $reactieQuery->fetch_array()) {

        //date format om het in de nederlandse format te zetten
        $Sdate = date_format(new DateTime($rij['datum']), "d-m-Y");

        if ($counter == 0) {
            ?>
            <div class="row mt-lg-4 ml-sm-2 mr-sm-2">
        <?php }
        $counter++;
        ?>
        <div class="col-lg-4">
            <div class="card card-green mt-1 mb-1">
                <div class="card-heading">
                    <div class="row px-sm-3 py-sm-3">
                        <div class="col-lg-12">
                            Vacature: <?php echo $title; ?>
                            <small class="pull-right"><?php echo $Sdate; ?></small>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <?php echo $rij['bericht']; ?>
                    <hr/>
                    <small class="pull-left">Student info: <?php echo $rij["Naam"]; ?>, <?php echo $rij["Email"]; ?></small>
                </div>

            </div>
        </div>
        <?php if ($counter >= 3) { ?>
            </div>
        <?php $counter = 0;
        }
    } ?>
</div>
</body>
</html>
