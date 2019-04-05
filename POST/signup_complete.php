<?php
/**
 * Created by PhpStorm.
 * User: zico_
 * Date: 1-6-2018
 * Time: 15:19
 */

include('../config.php');

$status = "";

//check om welke submit het gaan
if(isset($_POST['studentSubmit']))
{
    //haal alles uit de post
    $gebruikersID = $_POST['gebruikerID'];
    $specialisatie = $_POST['specialisatie'];

    //zet de gegevens in de database
    if($mysqli->query('INSERT INTO student VALUES(' . $gebruikersID . ', "' . $specialisatie .'")'))
    {
        //zet de status in de variable
        $status = "Je bent geregistreerd als student. Wil je later ook een bedrijf of particulieren opdrachtgever aan je account toevoegen dan kan dat via de account pagina(Nog niet beschikbaar)";
    }
    else
    {
        $status = "vraag een beheerder";
        print_r($mysqli->error);
    }

}
elseif(isset($_POST['bedrijfSubmit']))
{
    $gebruikersID = $_POST['gebruikerID'];
    $bedrijfNaam = $_POST['bedrijfNaam'];
    $bedrijfURL = $_POST['bedrijfURL'];
    $bedrijfTel = $_POST['bedrijfTel'];

    if($mysqli->query('INSERT INTO bedrijf VALUES(' . $gebruikersID . ',"' . $bedrijfNaam . '", "' . $bedrijfURL . '", "' . $bedrijfTel . '")'))
    {
        $status = "Je bent geregistreerd als bedrijf. Wil je later ook een student of particulieren opdrachtgever aan je account toevoegen dan kan dat via de account pagina(Nog niet beschikbaar)";
    }
    else
    {
        $status = "vraag een beheerder";
        print_r($mysqli->error);
    }

}
elseif(isset($_POST['particulierSubmit']))
{
    $gebruikersID = $_POST['gebruikerID'];
    $particulierTel = $_POST['particulierTel'];

    if($mysqli->query('INSERT INTO particulier VALUES(' . $gebruikersID . ', "' . $particulierTel .'")'))
    {
        $status = "Je bent geregistreerd als particulier. Wil je later ook een bedrijf of student aan je account toevoegen dan kan dat via de account pagina(Nog niet beschikbaar)";
    }
    else
    {
        $status = "vraag een beheerder";
        print_r($mysqli->error);
    }
}
?>

<html>
<head>
    <?php
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

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 mt-sm-4 ml-sm-2 mr-sm-2">
                <!--Laat de status zien-->
                <h3><?php echo $status; ?></h3>
                <hr/>
            </div>
        </div>


</div>
</body>
</html>

