<?php
/**
 * Created by PhpStorm.
 * User: lucsers
 * Date: 29-5-2018
 * Time: 09:59
 */
//haal config op voor connectie met de database
require('../config.php');

//start sessie
session_start();

//kijk wat er in de GET wordt meegegeven
if($_GET['type'] == 'name')
{

    $name = $mysqli->real_escape_string($_POST['name']);

    if($mysqli->query("UPDATE `gebruiker` SET `Naam`= '".$name."'WHERE ID = " . $_SESSION['ID']))
    {
        echo 1;
    }

    $_SESSION['name'] = $name;

    $mysqli->close();

}
elseif ($_GET['type'] == 'email')
{

    $email = $mysqli->real_escape_string($_POST['email']);

    if($mysqli->query("UPDATE `gebruiker` SET `Email`= '".$email."'WHERE ID = " . $_SESSION['ID']))
    {
        echo 1;
    }

    $_SESSION['email'] = $email;

    $mysqli->close();
}
elseif ($_GET['type'] == 'password')
{

    $pass = $mysqli->real_escape_string($_POST['pass']);

    if(isset($_POST['ID']))
    {
        $ID = $_POST['ID'];
    }
    else
    {
        $ID = $_SESSION['ID'];
    }

    $pass = password_hash($pass, PASSWORD_BCRYPT);

    if($mysqli->query("UPDATE `gebruiker` SET `Wachtwoord`= '".$pass."'WHERE ID = " . $ID))
    {
        echo 1;
    }

    $mysqli->close();
}

elseif ($_GET['type'] == 'skill')
{

    if($mysqli->real_escape_string($_POST['skill']))
    {
        echo 1;
    }

    $skillUpdate = $mysqli->query("UPDATE `Student` SET `Specialisatie`= '".$skill."'WHERE ID = " . $_SESSION['ID']);

    $mysqli->close();
}

elseif ($_GET['type'] == 'bedrijf')
{
    $bedrijfNaam = $mysqli->real_escape_string($_POST['name']);
    $bedrijfTel = $mysqli->real_escape_string($_POST['tel']);


    if($mysqli->query("UPDATE `bedrijf` SET `naamBedrijf`= '".$bedrijfNaam."',
                                        `websiteUrl`= '".$bedrijfUrl."',
                                        `tel_nummer`= '".$bedrijfTel."' WHERE ID = ".$_SESSION['ID']))
    {
        echo 1;
    }

    $mysqli->close();
}

elseif ($_GET['type'] == 'particulier')
{
    $particulierTel = $mysqli->real_escape_string($_POST['tel']);


    if($mysqli->query("UPDATE `particulier` SET `tel_nummer`= '".$particulierTel."' WHERE ID = ".$_SESSION['ID']))
    {
        echo 1;
    }

    $mysqli->close();
}