<?php
/**
 * Created by PhpStorm.
 * User: zico_
 * Date: 6-6-2018
 * Time: 11:39
 */

// alle bestanden ophalen die nodig zijn
session_start();
include('../config.php');
include('../template/admin_vacature_wijzigen.php');
?>
<html>
    <head>
        <title>Admin Home</title>
        <?php include("../template/header.php")?>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg bg-dark">
        <?php
        include('../template/nav.php')
        ?>
    </nav>

    <div class="container-fluid">
        <div class="row mt-sm-4 ml-sm-2 mr-sm-2">
            <div class="col-lg-12">
                <h1>Admin Home</h1>
                <hr/>
            </div>
        </div>

        <div class="row ml-sm-2 mr-sm-2">

            <?php
            //als je admin bent heb je toegang tot de pagina
            if($_SESSION["admin"] == 1)
            {
                ?>
                <div class="col-lg-12">
                    <div class="card card-grey">
                        <div class="card-heading">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="vacatureTab" href="#">Vacatures</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="labelTab" href="#">Labels</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="studentTab" href="#">Studenten</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="bedrijfTab" href="#">Bedrijven</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="particulierTab" href="#">Particulieren</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body" id="vacatureBody">
                            <?php
                            //vacatures tellen
                            $vacatureCount = $mysqli->query("SELECT Titel FROM vacature")->num_rows;
                            echo "<h3> Er zijn op dit moment " . $vacatureCount . " vacatures op de website.</h3>";
                            ?>
                            <table class="table table-striped table-dark" id="vacatureTable">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Titel</th>
                                        <th scope="col">Datum</th>
                                        <th scope="col">Beschrijving</th>
                                        <th scope="col">Functie</th>
                                        <th scope="col">Locatie</th>
                                        <th scope="col">Gebruiker</th>
                                    </tr>
                                </thead>
                                <tbody>

                            <?php
                            //vacature uitlezen en in de table zetten
                            $vacatures = $mysqli->query("SELECT * FROM vacature");
                            while($rij = $vacatures->fetch_array())
                            {
                                ?>
                                    <tr>
                                        <td><?php echo $rij['Titel'] ;?></td>
                                        <td><?php echo $rij['Datum'] ;?></td>
                                        <td><?php echo $rij['Beschrijving'] ;?></td>
                                        <td><?php echo $rij['Functie'] ;?></td>
                                        <td><?php echo $rij['Locatie'] ;?></td>
                                        <td><?php echo $rij['gebruikerID'] ;?></td>
                                        <td><button onclick="updateVacature('<?php echo $rij['Titel'];?>', '<?php echo $rij['Datum'];?>', '<?php echo $rij['gebruikerID']; ?>');" class="btn btn-warning">Wijzigen</button></td>
                                        <td><button onclick="verwijderVacature('<?php echo $rij['Titel'];?>', '<?php echo $rij['Datum'];?>', '<?php echo $rij['gebruikerID']; ?>');" class="btn btn-danger">Verwijderen</button></td>
                                    </tr>
                                <?php
                            }
                            ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-body" id="labelBody" hidden>
                            <?php
                            //labels tellen
                            $labelCount = $mysqli->query("SELECT ID FROM v_label")->num_rows;
                            echo "<h3> Er zijn op dit moment " . $labelCount . " labels.</h3>";
                            ?>
                            <!--Label input-->
                            <form class="form-control" onsubmit="uploadLabel();">
                                <label for="trefwoord">Trefwoord</label>
                                <input id="trefwoord" type="text" name="trefwoord">
                                <button type="submit" class="btn btn-primary">Aanmaken</button>
                            </form>

                            <table class="table table-striped table-dark" id="labelTable">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Trefwoord</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                //labels uitlezen en in table zetten
                                $labels = $mysqli->query("SELECT * FROM v_label");
                                while($rij = $labels->fetch_array())
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo $rij['ID'] ;?></td>
                                        <td><?php echo $rij['Trefwoord'] ;?></td>
                                        <td><button onclick="verwijderLabel(<?php echo $rij['ID'] ;?>)" class="btn btn-danger">Verwijderen</button></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-body" id="studentBody" hidden>
                            <?php
                            //studenten tellen
                            $studentCount = $mysqli->query("SELECT ID FROM student")->num_rows;
                            echo "<h3> Er zijn op dit moment " . $studentCount . " studenten geregistreerd.</h3>";
                            ?>
                            <table class="table table-striped table-dark" id="labelTable">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Naam</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">AVGcheck</th>
                                    <th scope="col">Verified</th>
                                    <th scope="col">Specialisatie</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                //query uitlezen en in de table zetten
                                    $studenten = $mysqli->query("SELECT * FROM gebruiker JOIN student s on gebruiker.ID = s.ID");
                                    while($rij = $studenten->fetch_array())
                                    {
                                        ?>
                                        <tr>
                                            <td><?php echo $rij['ID']; ?></td>
                                            <td><?php echo $rij['Naam']; ?></td>
                                            <td><?php echo $rij['Email']; ?></td>
                                            <td><?php echo $rij['AVGcheck']; ?></td>
                                            <td><?php echo $rij['veriefied']; ?></td>
                                            <td><?php echo $rij['Specialisatie']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-body" id="bedrijfBody" hidden>
                            <?php
                            //bedrijven tellen
                            $bedrijfCount = $mysqli->query("SELECT ID FROM bedrijf")->num_rows;
                            echo "<h3> Er zijn op dit moment " . $bedrijfCount . " bedrijven geregistreerd.</h3>";
                            ?>
                            <table class="table table-striped table-dark" id="labelTable">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Naam</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">AVGcheck</th>
                                    <th scope="col">Verified</th>
                                    <th scope="col">Bedrijfs naam</th>
                                    <th scope="col">Website</th>
                                    <th scope="col">Tel_nummer</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                //query uitlezen en in de table zetten
                                $bedrijven = $mysqli->query("SELECT * FROM gebruiker JOIN bedrijf b on gebruiker.ID = b.ID");
                                while($rij = $bedrijven->fetch_array())
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo $rij['ID']; ?></td>
                                        <td><?php echo $rij['Naam']; ?></td>
                                        <td><?php echo $rij['Email']; ?></td>
                                        <td><?php echo $rij['AVGcheck']; ?></td>
                                        <td><?php echo $rij['veriefied']; ?></td>
                                        <td><?php echo $rij['naamBedrijf']; ?></td>
                                        <td><?php echo $rij['websiteUrl']; ?></td>
                                        <td><?php echo $rij['tel_nummer']; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-body" id="particulierBody" hidden>
                            <?php
                            //particulieren tellen
                            $particulierCount = $mysqli->query("SELECT ID FROM particulier")->num_rows;
                            echo "<h3> Er zijn op dit moment " . $particulierCount . " particulieren geregistreerd.</h3>";
                            ?>
                            <table class="table table-striped table-dark" id="labelTable">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Naam</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">AVGcheck</th>
                                    <th scope="col">Verified</th>
                                    <th scope="col">Tel_nummer</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                //query uitlezen en in de table zetten
                                $particulier = $mysqli->query("SELECT * FROM gebruiker JOIN particulier p on gebruiker.ID = p.ID");
                                while($rij = $particulier->fetch_array())
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo $rij['ID']; ?></td>
                                        <td><?php echo $rij['Naam']; ?></td>
                                        <td><?php echo $rij['Email']; ?></td>
                                        <td><?php echo $rij['AVGcheck']; ?></td>
                                        <td><?php echo $rij['veriefied']; ?></td>
                                        <td><?php echo $rij['tel_nummer']; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php
            }
            else
            {
                echo "<h1> Je hebt geen toegang tot deze pagina!</h1>";
            }
            ?>

        </div>
    </div>
    <script>

        //detecteer click
        $('#vacatureTab').click(function () {
            //verander classes
            $('#vacatureTab').addClass('active');
            $('#studentTab').removeClass('active');
            $('#bedrijfTab').removeClass('active');
            $('#particulierTab').removeClass('active');
            $('#labelTab').removeClass('active');
            //laat de body zien van de geklikte tab
            $('#vacatureBody').removeAttr('hidden');
            //als 1 van de ander body's nog niet hidden is, maak ze dan hidden
            if(!$('#bedrijfBody').attr('hidden') || !$('#studentBody').attr('hidden') || !$('#particulierBody').attr('hidden') || !$('#labelBody').attr('hidden'))
            {
                $('#studentBody').attr('hidden', true);
                $('#bedrijfBody').attr('hidden', true);
                $('#particulierBody').attr('hidden', true);
                $('#labelBody').attr('hidden', true);
            }
        });

        $('#studentTab').click(function () {
            $('#studentTab').addClass('active');
            $('#bedrijfTab').removeClass('active');
            $('#vacatureTab').removeClass('active');
            $('#studentBody').removeAttr('hidden');
            $('#particulierTab').removeClass('active');
            $('#labelTab').removeClass('active');
            if(!$('#vacatureBody').attr('hidden') || !$('#bedrijfBody').attr('hidden') || !$('#particulierBody').attr('hidden')|| !$('#labelBody').attr('hidden'))
            {
                $('#bedrijfBody').attr('hidden', true);
                $('#vacatureBody').attr('hidden', true);
                $('#particulierBody').attr('hidden', true);
                $('#labelBody').attr('hidden', true);
            }
        });

        $('#bedrijfTab').click(function () {
            $('#bedrijfTab').addClass('active');
            $('#studentTab').removeClass('active');
            $('#vacatureTab').removeClass('active');
            $('#bedrijfBody').removeAttr('hidden');
            $('#particulierTab').removeClass('active');
            $('#labelTab').removeClass('active');
            if(!$('#vacatureBody').attr('hidden') || !$('#studentBody').attr('hidden') || !$('#particulierBody').attr('hidden')|| !$('#labelBody').attr('hidden'))
            {
                $('#studentBody').attr('hidden', true);
                $('#vacatureBody').attr('hidden', true);
                $('#particulierBody').attr('hidden', true);
                $('#labelBody').attr('hidden', true);
            }
        });

        $('#particulierTab').click(function () {
            $('#particulierTab').addClass('active');
            $('#studentTab').removeClass('active');
            $('#vacatureTab').removeClass('active');
            $('#particulierBody').removeAttr('hidden');
            $('#bedrijfTab').removeClass('active');
            $('#labelTab').removeClass('active');
            if(!$('#vacatureBody').attr('hidden') || !$('#studentBody').attr('hidden') || !$('#bedrijfBody').attr('hidden')|| !$('#labelBody').attr('hidden'))
            {
                $('#studentBody').attr('hidden', true);
                $('#vacatureBody').attr('hidden', true);
                $('#bedrijfBody').attr('hidden', true);
                $('#labelBody').attr('hidden', true);
            }
        });

        $('#labelTab').click(function () {
            $('#particulierTab').addClass('active');
            $('#studentTab').removeClass('active');
            $('#vacatureTab').removeClass('active');
            $('#labelBody').removeAttr('hidden');
            $('#bedrijfTab').removeClass('active');
            $('#particulierTab').removeClass('active');
            if(!$('#vacatureBody').attr('hidden') || !$('#studentBody').attr('hidden') || !$('#bedrijfBody').attr('hidden')|| !$('#particulierBody').attr('hidden'))
            {
                $('#studentBody').attr('hidden', true);
                $('#vacatureBody').attr('hidden', true);
                $('#bedrijfBody').attr('hidden', true);
                $('#particulierBody').attr('hidden', true);
            }
        });

        //vacature verwijder functie
        function verwijderVacature(titel, datum, gebruikerID)
        {
            //maak een post naar de verwerkpagina
            $.post('../POST/admin_verwijderen.php',{
                type: 'vacature',
                titel: titel,
                datum: datum,
                gebruikerID: gebruikerID
            },
            function (result) {
                //als het gelukt is (result = 1) dan reload de pagina
                if(result == 1)
                {
                    location.reload(true);
                }
                else
                {
                    //gaat het fout laat dan de error zien
                    alert(result);
                }
            });
        }

        //vacature update functie
        function updateVacature(titel, datum, gebruikerID)
        {
            //maak een post naar de verwerkpagina om alle gegevens van de vaacature op te halen
            $.post('../POST/admin_get_vacature.php',{
                titel: titel,
                datum: datum,
                gebruikerID: gebruikerID
            },
            function(result)
            {
                //de gegevens in form van de modal (admin_vacature_wijzigen.php) zetten en openen.
                result = JSON.parse(result);
                $('#job').val(result.Functie);
                $('#location').val(result.Locatie);
                $('#description').val(result.Beschrijving);
                $('#date').val(result.Datum);
                $('#title').val(result.Titel);
                $('#GebruikerID').val(result.gebruikerID);

                $('#adminVacatureWijzigen').modal();
            });
        }

        //label verwijder functie
        function verwijderLabel(ID)
        {
            //maak een post naar de verwijder functie
            $.post('../POST/admin_verwijderen.php',{
                    type: 'label',
                    ID: ID
                },
                function (result) {
                //als het gelukt is (result = 1) dan reload de pagina
                    if(result == 1)
                    {
                        location.reload(true);
                    }
                    else
                    {
                        alert(result);
                    }
                });
        }

        //label upload functie
        function uploadLabel()
        {
            //haal het trefwoord uit de input
            var trefwoord = $("#trefwoord").val();

            //maak een post naar de verwerk pagina
            $.post('../POST/admin_label_uploaden.php', {
                type: 'newLabel',
                trefwoord: trefwoord
            },
                function (result) {
                //als het gelukt is reload de pagina
                    if (result == 1) {
                        location.reload(true);
                    }
                    else {
                        alert(result);
                    }
                });
        }

    </script>
    </body>
</html>
