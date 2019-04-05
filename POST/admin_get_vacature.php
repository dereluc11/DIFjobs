<?php
    include('../config.php');

    //haal alles uit de post en zet ze in variabele
    $titel = $_POST['titel'];
    $datum = $_POST['datum'];
    $ID = $_POST['gebruikerID'];

    //haal de vacature op uit de databse
    $vacature = $mysqli->query("SELECT * FROM vacature WHERE Titel = '$titel' AND Datum = '$datum' AND gebruikerID = '$ID'")->fetch_object();

    //stuur de result terug in json.
    print_r(json_encode($vacature));

    $mysqli->close();
?>