<?php
/**
 * Created by PhpStorm.
 * User: lucsers
 * Date: 8-6-2018
 * Time: 12:32
 */
session_start();

if (isset($_SESSION['ID'])) {
    //haal config.php op
    require_once("../config.php");

    //escape alle data die we gaan gebruiken in de query
    $job = $mysqli->real_escape_string($_POST['job']);
    $location = $mysqli->real_escape_string($_POST['location']);
    $description = $mysqli->real_escape_string($_POST['description']);
    $date = $mysqli->real_escape_string($_POST['date']);
    $date = date_format(new DateTime($date), "Y-m-d h:i:s");
    $title = $mysqli->real_escape_string($_POST['title']);

    if(isset($_POST['GebruikerID']))
    {
        $ID = $_POST['GebruikerID'];
    }
    else
    {
        $ID = $_SESSION['ID'];
    }

    //maak en doe query
    $vacatureQuery = $mysqli->query("UPDATE `vacature` SET `Beschrijving`= '" . $description . "',`Functie`= '" . $job . "',`Locatie`= '" . $location . "'
                            WHERE Titel = '" . $title . "' AND Datum = '" . $date . "' AND gebruikerID = " . $ID);

    //sluit connectie


    if ($vacatureQuery == 1) {
        if($_SESSION['admin'] == 1)
        {
            header('Location: ../pages/admin_home.php');
        }
        else{
            //stuur terug naar account pagina
            header('Location: ../pages/account.php');
        }

    } else {
        echo "oops! something went wrong.";
    }
    $mysqli->close();
} else {
    header('Location: ../pages/home.php');
}