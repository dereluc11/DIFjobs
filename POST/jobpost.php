<?php
/**
 * Created by PhpStorm.
 * User: mmoer
 * Date: 6/1/2018
 * Time: 2:37 PM
 */
include_once('../config.php');

session_start();

//var met ingevulde titel
$jobTitle = $_POST['jobNaam'];

//var met locatie
$jobLocatie = $_POST['locatie'];

//var met functie
$jobFunction = $_POST['functie'];

//var met omschrijving
$jobBeschrijving = $_POST["jobOmschrijving"];

//var met datum
$postDatum = date("Y-m-d h-i-s");

//var wordt gechecked en vervangen als nodig
$jobTitle = $mysqli->real_escape_string($jobTitle);

//zelfde als hierboven maar dan voor locatie
$jobLocatie = $mysqli->real_escape_string($jobLocatie);

//zelfde als hierboven maar dan met de functie
$jobFunction = $mysqli->real_escape_string($jobFunction);

//zelfde als hierboven maar dan met omschrijving
$jobBeschrijving = $mysqli->real_escape_string($jobBeschrijving);

//query voor het posten van een job
$result = $mysqli->query('INSERT INTO vacature VALUES("' . $jobTitle . '", "' . $postDatum . '", "' . $jobBeschrijving .
    '", "' . $jobFunction . '", "' . $jobLocatie . '", "' . $_SESSION["ID"] . '")');

//als query succesvol uitgevoerd wordt
if ($result) {
    header("Location: ../pages/home.php?postsuccess=2");
    die();
} else {
    //zo niet dan:
    echo "failed to post";
}