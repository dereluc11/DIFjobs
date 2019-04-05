<?php

    include('../config.php');

    //check of het om een vacature gaat
    if($_POST['type'] == 'vacature')
    {
        //haal alle gegevens uit de post
        $titel = $_POST['titel'];
        $datum = $_POST['datum'];
        $gebruikerID = $_POST['gebruikerID'];

        //verwijder de vacature uit de database
        if($mysqli->query("DELETE FROM vacature WHERE Titel = '$titel' AND Datum = '$datum' AND gebruikerID = $gebruikerID"))
        {
            echo 1;
        }
        else
        {
            print_r($mysqli->error);
        }


    }
    //check of het om een label gaat
    elseif($_POST['type'] == 'label')
    {
        //haal de gegevens uit de post
        $ID = $_POST['ID'];
        //verwijder de label uit de database
        if($mysqli->query("DELETE FROM v_label WHERE ID = $ID "))
        {
            echo 1;
        }
        else
        {
            print_r($mysqli->error);
        }
    }
?>