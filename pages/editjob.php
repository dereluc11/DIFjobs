<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 7-6-2018
 * Time: 13:55
 */
session_start();

if (isset($_SESSION['ID'])) {

    require_once("../config.php");


//haal gegevens op uit GET en SESSION
    $title = $_GET['titel'];

    $date = str_replace("_", " ", $_GET['datum']);
    $date = date_format(new DateTime($date), "Y-m-d h:i:s");
    $userID = $_SESSION['ID'];

    //maak query om gegevens uit vacature te halen
    $vacatureQuery = $mysqli->query("SELECT * FROM vacature WHERE Titel = '" . $title . "' AND Datum = '" . $date . "' AND gebruikerID = " . $userID);


    $beschrijving = '';
    $locatie = '';
    $functie = '';

    while ($rij = $vacatureQuery->fetch_array()) {
        $beschrijving = $rij['Beschrijving'];
        $locatie = $rij['Locatie'];
        $functie = $rij['Functie'];

    }


    ?>
    <html>
    <head>
        <?php
        include("../template/header.php");
        ?>
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
                <h1>Vacature bewerken: <?php echo $title; ?></h1>
                <hr/>
            </div>
        </div>
        <div class="row mt-lg-2">
            <div class="col-lg-6">

                <!--edit job form-->
                <form name="editjob" action="../POST/editjob.php" method="post">
                    <div class="form-group col-lg-6">
                        <label for="job">Functie:</label>
                        <input type="text" class="form-control" name="job" placeholder="php programeur"
                               value="<?php echo $functie; ?>" required>
                    </div>

                    <div class="form-group col-lg-6">
                        <label for="location">Locatie:</label>
                        <input type="text" class="form-control" name="location" placeholder="Zoetermeer"
                               value="<?php echo $locatie; ?>" required>
                    </div>

                    <div class="form-group col-lg-6">
                        <label for="description">Beschrijving:</label>
                        <textarea class="form-control" name="description" maxlength="750"
                                  required><?php echo $beschrijving; ?></textarea>
                    </div>

                    <input type="hidden" value="<?php echo $date; ?>" name="date">
                    <input type="hidden" value="<?php echo $title; ?>" name="title">


                    <div class="col-sm-3 mt-2 pt-sm-4">
                        <button type="submit" class="btn btn-primary">Opslaan</button>
                    </div>

                </form>
            </div>


    </body>
    </html>
    <?php
} else {
    header("Location: home.php");
}
?>
