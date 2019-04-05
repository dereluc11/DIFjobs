<!DOCTYPE html>
<html lang="nl">
<head>
    <?php
    /**
     * Created by PhpStorm.
     * User: mmoer
     * Date: 5/23/2018
     * Time: 11:47 AM
     */
    include("../template/header.php");
    ?>
</head>

<body>

<div class="container-fluid pl-0 pr-0">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <?php
        include('../template/nav.php');
        ?>
	</nav>


	<div class="row">
		<div class="col-lg-12 mt-sm-4 ml-sm-2 mr-sm-2">
			<h1>Vacature plaatsen</h1>
			<hr/>
		</div>
	</div>

	<div class="row mx-auto">
		<div class="col-sm-6">
            <!--vacature uploaden form-->
			<form name="postJobForm" id="signUpForm" action="../POST/jobpost.php" method="post">
				<div class="form-group">
					<label for="jobNaam">Titel</label>
					<input type="text" name="jobNaam" class="form-control" id="jobNaam" placeholder="B.V. Programmeur gezocht" required>
				</div>

				<div class="form-group">
					<label for="locatie">Locatie</label>
					<input type="text" name="locatie" class="form-control" id="locatie" placeholder="B.V. Zoetermeer" required>
				</div>

                <div class="form-group">
                    <label for="functie">Functie</label>
                    <input type="text" name="functie" class="form-control" id="functie" placeholder="B.V. Webdeveloper" required>
                </div>

				<div class="form-group">
					<label for="Omschrijving">Omschrijving</label>
					<textarea class="form-control" id="Omschrijving" rows="3" maxlength="750" name="jobOmschrijving" required></textarea>
				</div>

				<button type="submit" class="btn btn-default btn-block buttoncolorgray"><span
							class="glyphicon glyphicon-off"></span> Plaats vacature
				</button>
			</form>
		</div>
	</div>
</div>