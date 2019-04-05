<?php
/**
 * Created by PhpStorm.
 * User: zico_
 * Date: 31-5-2018
 * Time: 13:04
 */

    include('../config.php');

    //haal alle gegevens uit de url
    $email = $_GET['email'];
    $code = $_GET['code'];

    //haal de gebruiker op uit de databse
    $result = $mysqli->query("SELECT ID FROM gebruiker WHERE Email = '$email' AND verifiedCode = '$code'");
    $gebruikerID = "";

    //als er resultaat is update de gebruiker en zet verified op true en haal de code uit de database
    if($result)
    {
        $gebruikerID = $result->fetch_object()->ID;

        $mysqli->query("UPDATE gebruiker SET veriefied = true, verifiedCode = NULL WHERE ID = '$gebruikerID' ");


    }
    else
    {
        echo "Er is geen gebruiker gevonden. Klopt dit niet neem dan contact op met de beheerder";
    }

?>
<html>
<head>
    <title>Email verificatie</title>
    <?php include('../template/header.php'); ?>
</head>
<body>
<div class="container-fluid pl-0 pr-0">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <?php
        include('../template/nav.php');
        ?>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 mt-sm-4 ml-sm-2 mr-sm-2">
                <h1>Registratie compleet maken.</h1>
                <hr/>
            </div>
        </div>
<!--Hier staan de verschillende forms voor de verschillende soorten accounts-->
    <div class="row ml-sm-2 mr-sm-2">
        <div class="col-lg-12">
            <div class="card card-grey">
                <div class="card-heading">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="studentTab" href="#">Student</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="BedrijfTab" href="#">Bedrijf</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="particulierTab" href="#">Particulier</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body" id="studentBody">
                    <h1 class="card-title">Student</h1>
                    <form name="studentForm" action="signup_complete.php" method="post">
                        <label for="specialisatie">Wat is je specialisatie?</label>
                        <input type="text" name="specialisatie" class="form-control" id="specialisatie" placeholder="programmeur" required>
                        <input type="hidden" name="gebruikerID" value="<?php echo $gebruikerID ?>"><br/>
                        <button type="submit" class="btn btn-primary" name="studentSubmit">Submit</button>
                    </form>
                </div>

                <div class="card-body" id="BedrijfBody" hidden>
                    <h1 class="card-title">Bedrijf</h1>
                    <form name="bedrijfForm" action="signup_complete.php" method="post">
                        <label for="bedrijfNaam">Wat is de naam van het Bedrijf?</label>
                        <input type="text" name="bedrijfNaam" class="form-control" id="bedrijfNaam" placeholder="Google" required>
                        <label for="bedijfURL">Wat is de link naar je bedrijfs website?</label>
                        <input type="text" name="bedrijfURL" class="form-control" id="bedijfURL" placeholder="www.Google.nl">
                        <label for="bedrijfTel">Wat is het telefoonnummer waar naar studenten kunnen bellen?</label>
                        <input type="tel" name="bedrijfTel" class="form-control" id="bedrijfTel" placeholder="06123456789">
                        <input type="hidden" name="gebruikerID" value="<?php echo $gebruikerID ?>"><br/>
                        <button type="submit" class="btn btn-primary" name="bedrijfSubmit">Submit</button>
                    </form>
                </div>

                <div class="card-body" id="particulierBody" hidden>
                    <h1 class="card-title">Particulier</h1>
                    <form name="particulierForm" action="signup_complete.php" method="post">
                        <label for="particulierTel">Wat is het telefoonnummer waar naar studenten kunnen bellen?</label>
                        <input type="tel" name="particulierTel" class="form-control" id="particulierTel" placeholder="06123456789" required>
                        <input type="hidden" name="gebruikerID" value="<?php echo $gebruikerID ?>"><br/>
                        <button type="submit" class="btn btn-primary" name="particulierSubmit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    //detecteer click
    $('#studentTab').click(function () {
        //verander classes
        $('#studentTab').addClass('active');
        $('#BedrijfTab').removeClass('active');
        $('#particulierTab').removeClass('active');
        //laat de body zien van de geklikte tab
        $('#studentBody').removeAttr('hidden');
        //als 1 van de ander body's nog niet hidden is, maak ze dan hidden
        if(!$('#particulierBody').attr('hidden') || !$('#BedrijfBody').attr('hidden'))
        {
            $('#BedrijfBody').attr('hidden', true);
            $('#particulierBody').attr('hidden', true);
        }
    });
    $('#BedrijfTab').click(function () {
        $('#BedrijfTab').addClass('active');
        $('#particulierTab').removeClass('active');
        $('#studentTab').removeClass('active');
        $('#BedrijfBody').removeAttr('hidden');
        if(!$('#studentBody').attr('hidden') || !$('#particulierBody').attr('hidden'))
        {
            $('#particulierBody').attr('hidden', true);
            $('#studentBody').attr('hidden', true);
        }
    });
    $('#particulierTab').click(function () {
        $('#particulierTab').addClass('active');
        $('#BedrijfTab').removeClass('active');
        $('#studentTab').removeClass('active');
        $('#particulierBody').removeAttr('hidden');
        if(!$('#studentBody').attr('hidden') || !$('#BedrijfBody').attr('hidden'))
        {
            $('#BedrijfBody').attr('hidden', true);
            $('#studentBody').attr('hidden', true);
        }
    });
</script>
</body>
</html>
