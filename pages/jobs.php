<?php
session_start();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <?php


    include("../template/header.php");

    include_once('../config.php');

    if (isset($_SESSION['ID']) && $_SESSION['accountType'] == 'student') {
    include ('../template/respond.php');
	}

    ?>
</head>

<body>
<nav class="navbar navbar-expand-lg bg-dark">
    <?php
    include('../template/nav.php')
    ?>
</nav>

<div class="row mt-sm-4 ml-sm-2 mr-sm-2">
	<div class="col-lg-12">
		<h1>Vacatures</h1>
		<hr/>
	</div>
</div>


<div class="container-fluid">


    <?php
    $haalJobs = $mysqli->query("SELECT * FROM vacature");

    //counter voor de om de juiste hoeveelheid per rij te weergeven
    $counter = 0;

    //while loop om alle reacties op het scherm te zetten
    while ($rij = $haalJobs->fetch_array()) {

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
							Vacature: <?php echo $rij['Titel']; ?>
						</div>
					</div>
				</div>

				<div class="card-footer">
                    <?php echo $rij['Beschrijving']; ?>
					<hr/>

					<small class="pull-right">Geplaatst op: <?php echo $rij['Datum']; ?></small>
					<a href="#" class="btn btn-success clickbutton" data-toggle="modal" data-target="#respondPopup"  ID="respondBtn" name="respondBtn" value="<?php echo $rij['Titel']; ?>">Reageer</a>
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
