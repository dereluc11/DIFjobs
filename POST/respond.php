<?php
//start sessie
session_start();
/**
 * Created by PhpStorm.
 * User: mmoer
 * Date: 6/6/2018
 * Time: 12:41 PM
 */
//Maakt verbinding met database
include_once('../config.php');

//variabele waarin de titel van de variabele wordt bewaard
$titelNaam = $_POST['jobTitle'];

//variabele waarin de tekst van een bericht wordt geplaatst
$reactieBericht = $mysqli->real_escape_string($_POST['Bericht']);

//query waarmee het emailadress van de plaatser wordt gevonden
$getContactQuery = $mysqli->query("SELECT gebruiker.email FROM gebruiker JOIN vacature ON gebruiker.ID = vacature.gebruikerID WHERE vacature.titel = '$titelNaam'");

//query waarmee het emailadress van de plaatser wordt gevonden
$getPostInfoQuery = $mysqli->query("SELECT datum, gebruikerID FROM vacature WHERE titel = '$titelNaam'");

//datum wordt in Vdatum var geplaatst
if ($getPostInfoQuery) {
    //haal het resultaat op
    while ($row = $getPostInfoQuery->fetch_array()) {
        $Vdatum = $row[0];
        $VgebruikerID = $row[1];
    }
}

//query waarmee het emailadress van de plaatser wordt gevonden
$getPostGebruikerID = $mysqli->query("SELECT gebruikerID FROM vacature WHERE titel = '$titelNaam'");

//var met reactiedatum erin
$reactieDatum = date("Y-m-d h-i-s");

//als de query succesvol wordt uitgevoerd
if ($getContactQuery) {
    //haal het resultaat op
    while ($row = $getContactQuery->fetch_array()) {
        $emailToo = $row[0];
            if($mysqli->query('INSERT INTO reactie VALUES("'. $_SESSION['ID'] .'", "'.$titelNaam .'", "' .  $Vdatum  . '", "'.$VgebruikerID. '", "'.$reactieDatum. '", "'.$reactieBericht.'")'))
        {
            header("Location: ../pages/home.php?postsuccess=1");
            die();
            //mail($emailToo,"Er is gereageerd op je vacature!",$reactieBericht);
        } else{
            echo "failed to respond";
        }
    }
} else {
    //dit doen wanneer de query niet kan worden uitgevoerd
    echo("something went wrong");
}

