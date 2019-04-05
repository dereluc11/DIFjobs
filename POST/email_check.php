<?php
/**
 * Created by PhpStorm.
 * User: zico_
 * Date: 25-5-2018
 * Time: 17:51
 */

    include("../config.php");
    //haal de gegevens uit de post
    $email = $_POST['email'];

    //escape alle data die we gaan gebruiken in de query
    $email = $mysqli->real_escape_string($email);

    //check if het echt een email is
    if (filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        //haal alle gebruikers op met dit email adres
        $result = $mysqli->query("SELECT ID FROM gebruiker WHERE Email = '" .$email . "'");

        //als er 1 of meer account met dit email adres zijn geef dan aan dat er een fout melding gegeven moet worden
        if($result->num_rows > 0)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }

        $mysqli->close();

    }
    else
    {
        echo 2;
    }
?>