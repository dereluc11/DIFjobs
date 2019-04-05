<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 24-5-2018
 * Time: 11:48
 */
session_start();

if (isset($_SESSION['ID'])) {
    include_once('../config.php');



    //maak booleans en check of het een bedrijf is
    $is_bedrijf = false;
    $is_particulier = false;
    $is_student = false;

    //haal benodigde gegevens op
    if ($_SESSION["accountType"] == 'bedrijf') {
        $is_bedrijf = true;

        $bedrijfGegevensQuery = $mysqli->query("SELECT * FROM bedrijf WHERE ID = " . $_SESSION["ID"]);

        $bedrijfsgegevens = $bedrijfGegevensQuery->fetch_array();


        $bedrijfsnaam = $bedrijfsgegevens['naamBedrijf'];
        $bedrijfURL = $bedrijfsgegevens['websiteUrl'];
        $bedrijfTel = $bedrijfsgegevens['tel_nummer'];
    }

    //check of het een particulier is
    if ($_SESSION["accountType"] == 'particulier') {
        $is_particulier = true;

        $particulierGegevensQuery = $mysqli->query("SELECT * FROM particulier WHERE ID = " . $_SESSION["ID"]);

        $particulierTel = $particulierGegevensQuery->fetch_object()->tel_nummer;
    }

    //check of het een student is
    if ($_SESSION["accountType"] == 'student') {
        $is_student = true;

        $studentGegevensQuery = $mysqli->query("SELECT * FROM student WHERE ID = " . $_SESSION["ID"]);

        $specialisatie = $studentGegevensQuery->fetch_object()->Specialisatie;
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
        <div class="row">
            <div class="col-lg-12 mt-sm-4 ml-sm-2 mr-sm-2">
                <h1><?php if (!empty($_SESSION['name'])) {
                        echo $_SESSION['name'];
                    } else {
                        echo "Account";
                    } ?></h1>
                <hr/>
            </div>
        </div>
        <div class="row ml-sm-2 mr-sm-2">
            <div class="col-lg-12">
                <div class="card card-grey">
                    <div class="card-heading">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="dataTab" href="#">Gegevens</a>
                                </li>

                                <?php
                                if ($is_bedrijf || $is_particulier) { ?>

                                    <li class='nav-item'>
                                        <a class='nav-link' id='jobsTab' href='#'>Vacatures</a>
                                    </li>

                                <?php }

                                if ($is_student) { ?>

                                    <li class='nav-item'>
                                        <a class='nav-link' id='responseTab' href='#'>Reacties</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body" id="dataBody">
                        <h1 class="card-title">Gegevens</h1>

                        <h3>persoonlijke gegevens:</h3>
                        <!-- naam veranderen -->
                        <div class="row">
                            <div class="form-group col-lg-3">
                                <label for="naam">Naam:</label>
                                <input type="text" class="form-control" id="naam" placeholder="John Doe"
                                       value="<?php echo $_SESSION['name']; ?>" required>
                            </div>
                            <div class="col-lg-2 mt-2 pt-sm-4">
                                <button onclick="nameSubmit();" class="btn btn-primary">Opslaan</button>
                            </div>

                        </div>
                        <small class="redLetters" id="nameError">Naam is verplicht.</small>

                        <!-- einde naam veranderen-->

                        <!-- email veranderen -->
                        <div class="row">
                            <div class="form-group col-lg-3">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email"
                                       value="<?php echo $_SESSION['email']; ?>"
                                       required>
                            </div>
                            <div class="col-lg-2 mt-2 pt-sm-4">
                                <button onclick="emailSubmit();" class="btn btn-primary">Opslaan
                                </button>
                            </div>
                        </div>
                        <small class="redLetters" id="emailError">Dit email adres is niet geldig of al in gebruik.
                        </small>
                        <!-- einde email veranderen -->
                        <hr/>

                        <h3>wachtwoord veranderen:</h3>
                        <!-- wachtwoord veranderen -->
                        <div class="row">
                            <div class="form-group col-lg-2">
                                <label for="password">Nieuw Wachtwoord*</label>
                                <input type="password" class="form-control" id="password" placeholder="Wachtwoord"
                                       required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-2">
                                <label for="confirmPassword">Herhaal Wachtwoord*</label>
                                <input type="password" class="form-control" id="confirmPassword"
                                       placeholder="Wachtwoord" required>
                            </div>
                            <div class="col-sm-3 mt-2 pt-sm-4">
                                <button onclick="passwordSubmit()" class="btn btn-primary">Opslaan
                                </button>
                            </div>
                        </div>
                        <small id="passwordError" class="redLetters">Het wachtwoord is niet het zelfde.</small>
                        <!-- einde wachtwoord veranderen -->
                        <hr/>

                        <?php if ($is_student) { ?>
                            <!-- student -->
                            <h3>Specialisatie:</h3>
                            <div class="row">
                                <div class="form-group col-lg-2">
                                    <input type="text" class="form-control" id="specialisatie"
                                           value="<?php echo $specialisatie; ?>"
                                           placeholder="C# developer">
                                </div>
                                <div class="col-sm-3">
                                    <button onclick="skillSubmit()" class="btn btn-primary">Opslaan</button>
                                </div>
                            </div>
                            <!-- einde student -->
                            <hr/>
                        <?php }

                        if ($is_bedrijf) {
                            ?>

                            <!-- bedrijf -->
                            <h3>Bedrijfsgegevens:</h3>
                            <div class="row">
                                <div class="form-group col-lg-3">
                                    <label for="Bedrijfsnaam">Bedrijfsnaam:</label>
                                    <input type="text" class="form-control" id="Bedrijfsnaam"
                                           placeholder="Dif jobs developer" value="<?php echo $bedrijfsnaam; ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-3">
                                    <label for="webURL">Website:</label>
                                    <input type="url" class="form-control" id="webURL"
                                           value="<?php echo $bedrijfURL; ?>" placeholder="www.difjobs.nl">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-3">
                                    <label for="phoneNumber">Telefoonnummer:</label>
                                    <input type="url" class="form-control" id="phoneNumber"
                                           value="<?php echo $bedrijfTel; ?>" placeholder="0612345678">
                                </div>
                            </div>

                            <br/>
                            <div class="row">
                                <div class="col-lg-2">
                                    <button onclick="bedrijfSubmit();" class="btn btn-primary">Opslaan</button>
                                </div>
                            </div>
                            <!-- einde bedrijf -->
                            <hr/>

                        <?php }
                        if ($is_particulier) {
                            ?>
                            <!-- particulier -->
                            <h3>Telefoonnummer:</h3>
                            <div class="row">
                                <div class="form-group col-lg-2">
                                    <label for="phoneNumber">Telefoonnummer:</label>
                                    <input type="url" class="form-control" id="particulierPhone"
                                           value="<?php echo $particulierTel; ?>" placeholder="0612345678">
                                </div>

                                <div class="col-sm-3 mt-2 pt-sm-4">
                                    <button onclick="particulierSubmit();" class="btn btn-primary">Opslaan</button>
                                </div>
                            </div>                            <!-- einde particulier -->

                        <?php } ?>

                    </div>

                    <?php if ($is_bedrijf || $is_particulier) { ?>
                        <div class="card-body" id="jobsBody" hidden>

                            <!-- bedrijf & particulier-->
                            <div class="row">
                                <div class="col-lg-3">
                                    <h1 class="card-title">Vacature</h1>
                                </div>
                                <div class="col-lg-9">
                                    <a href="jobpost.php" class="pull-right btn btn-primary">Plaats vacature
                                    </a>
                                </div>
                            </div>
                            <table class="table table-striped table-dark">
                                <thead>
                                <tr>
                                    <th scope="col">Titel</th>
                                    <th scope="col">Datum</th>
                                    <th scope="col">Functie</th>
                                    <th scope="col">aanpassen</th>
                                    <th scope="col">reacties</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                //query om vacatures op te halen
                                $vacatureQuery = $mysqli->query("SELECT `Titel`, `Datum`, `Functie` 
                                                                    FROM vacature WHERE gebruikerID = " . $_SESSION['ID']);
                                //while loop om vactures op het scherm te zetten
                                while ($rij = $vacatureQuery->fetch_array()) {

                                    //datum formateren
                                    $date = date_format(new DateTime($rij['Datum']), "d-m-Y");
                                    $dateURL = date_format(new DateTime($rij['Datum']), "d-m-Y_h:i:s");
                                    ?>


                                    <tr>
                                        <th><?php echo $rij['Titel']; ?></th>
                                        <td><?php echo $date; ?></td>
                                        <td><?php echo $rij['Functie']; ?></td>
                                        <td>
                                            <a href="editjob.php?titel=<?php echo $rij['Titel']; ?>&datum=<?php echo $dateURL; ?>"><span
                                                        class="fa fa-edit"></span></a></td>
                                        <td>
                                            <a href="jobresponses.php?titel=<?php echo $rij['Titel']; ?>&datum=<?php echo $dateURL; ?>"><span
                                                        class="fa fa-comment"></span></a></td>
                                    </tr>

                                    <?php
                                }
                                ?>

                                </tbody>
                            </table>
                        </div>
                    <?php } ?>

                    <?php if ($is_student) { ?>
                        <div class="card-body" id="responseBody" hidden>

                            <!-- alleen studenten-->
                            <h1 class="card-title">Reactie</h1>

                            <table class="table table-striped table-dark">
                                <thead>
                                <tr>
                                    <th scope="col">Titel</th>
                                    <th scope="col">Functie</th>
                                    <th scope="col">Bedrijf</th>
                                    <th scope="col">Datum</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                //maak query om reacties op te halen
                                $reactieQuery = $mysqli->query("SELECT v.Titel, b.naamBedrijf, v.Functie, r.datum FROM reactie r
                                                                JOIN bedrijf b ON r.VgebruikerID = b.ID
                                                                JOIN vacature v ON (r.Vtitel = v.Titel AND r.Vdatum = v.Datum AND r.VgebruikerID = v.gebruikerID)
                                                                WHERE r.SgebruikerID = " . $_SESSION['ID']);
                                //while loop om reacties op het scherm te zetten
                                while ($rij = $reactieQuery->fetch_array()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $rij['Titel'] ?></td>
                                        <td><?php echo $rij['Functie'] ?></td>
                                        <td><?php echo $rij['naamBedrijf'] ?></td>
                                        <td><?php echo $rij['datum'] ?></td>
                                    </tr>
                                <?php }
                                $mysqli->close();
                                ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        //alles uitvoeren als het document geladen is
        $(document).ready(function () {
            $("#passwordError").hide();
            $("#emailError").hide();
            $("#nameError").hide();
        });

        //als de nameSumbit knop van naam veranderen wordt geklikt
        function nameSubmit() {

            //update naar database met ajax

            if($("#naam").val().length > 0)
            {
                $.post("../POST/updateUserData.php?type=name", {
                    name: $("#naam").val()
                }, function (result) {
                    if(result == 1)
                    {
                        alert("Naam succesvol veranderd.");
                    }
                });
            }else{
                $("#nameError").show();
            }

        }

        //als de emailSumbit knop van email veranderen wordt geklikt
        function emailSubmit() {

            //check of het email adres al bestaat
            $.post("../POST/email_check.php", {
                    email: $("#email").val()
                },
                function (result) {
                    if (result == 0) {
                        $("#emailError").hide();

                        //update het email adres
                        $.post("../POST/updateUserData.php?type=email", {
                            email: $("#email").val()
                        }, function (result) {
                            if(result == 1)
                            {
                                alert("email succesvol veranderd.");
                            }

                        });
                    }
                    else {
                        //laat emailError verschijnen
                        $("#emailError").show();
                    }
                });
        }

        //als de passwordSumbit knop van wachtwoord veranderen wordt geklikt
        function passwordSubmit() {
            //wachtwoorden vergelijken
            if ($("#password").val() !== $("#confirmPassword").val() || $("#password").val().length <= 0 || $("#confirmPassword").val().length <= 0) {
                $("#passwordError").show();
            }
            else {
                $("#passwordError").hide();

                //update wachtwoord met ajax
                $.post("../POST/updateUserData.php?type=password", {
                    pass: $("#password").val()
                }, function (result) {
                    if(result == 1)
                    {
                        alert("wachtwoord succesvol veranderd.");
                    }
                });
            }

        }

        //als de skillSumbit knop van specialisatie veranderen wordt geklikt
        function skillSubmit() {
            //update specialisatie naar database met ajax
            $.post("../POST/updateUserData.php?type=skill", {
                skill: $("#specialisatie").val()
            }, function (result) {
                if(result == 1)
                {
                    alert("specialisatie succesvol aangepast.");
                }
            });
        }

        function bedrijfSubmit() {
            //update specialisatie naar database met ajax
            $.post("../POST/updateUserData.php?type=bedrijf", {
                name: $("#Bedrijfsnaam").val(),
                url: $("#webURL").val(),
                tel: $("#phoneNumber").val()
            }, function (result) {
                if(result == 1)
                {
                    alert("gegevens succesvol aangepast.");
                }
            });
        }

        function particulierSubmit() {
            $.post("../POST/updateUserData.php?type=particulier", {
                tel: $("#particulierPhone").val()
            }, function (result) {
                if(result == 1)
                {
                    alert("gegevens succesvol aangepast");
                }
            });
        }


        //detecteer click
        $('#dataTab').click(function () {

            //verander classes
            $('#dataTab').addClass('active');
            $('#jobsTab').removeClass('active');
            $('#responseTab').removeClass('active');

            //laat de body zien van de geklikte tab
            $('#dataBody').removeAttr('hidden');

            //als 1 van de ander body's nog niet hidden is, maak ze dan hidden
            if (!$('#responseBody').attr('hidden') || !$('#jobsBody').attr('hidden')) {
                $('#jobsBody').attr('hidden', true);
                $('#responseBody').attr('hidden', true);
            }
        });

        $('#jobsTab').click(function () {

            //verander classes
            $('#jobsTab').addClass('active');
            $('#responseTab').removeClass('active');
            $('#dataTab').removeClass('active');

            //laat de body zien van de geklikte tab
            $('#jobsBody').removeAttr('hidden');

            //als 1 van de ander body's nog niet hidden is, maak ze dan hidden
            if (!$('#dataBody').attr('hidden') || !$('#responseBody').attr('hidden')) {
                $('#responseBody').attr('hidden', true);
                $('#dataBody').attr('hidden', true);
            }
        });

        $('#responseTab').click(function () {
            //verander classes
            $('#responseTab').addClass('active');
            $('#jobsTab').removeClass('active');
            $('#dataTab').removeClass('active');

            //laat de body zien van de geklikte tab
            $('#responseBody').removeAttr('hidden');

            //als 1 van de ander body's nog niet hidden is, maak ze dan hidden
            if (!$('#dataBody').attr('hidden') || !$('#jobsBody').attr('hidden')) {
                $('#jobsBody').attr('hidden', true);
                $('#dataBody').attr('hidden', true);
            }
        });
    </script>
    </body>
    </html>
    <?php
} else {

    header("location: home.php?er=true");
}
?>


