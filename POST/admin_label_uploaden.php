<?php
/**
 * Created by PhpStorm.
 * User: zico_
 * Date: 11-6-2018
 * Time: 14:18
 */
    session_start();
    include('../config.php');

    //check of er een label wordt gemaakt
    if($_POST['type'] == 'newLabel')
    {
        //maak de nieuwe label
        $trefwoord = $_POST['trefwoord'];
        $mysqli->query("INSERT INTO v_label VALUES(NULL,'$trefwoord')");
        echo 1;
        $mysqli->close();

    }

?>

