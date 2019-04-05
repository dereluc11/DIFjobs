<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 24-5-2018
 * Time: 12:21
 */

// database logingegevens
$db_hostname = 'localhost';
$db_username = 'root';
$db_password = '';
$db_database = 'projectse4';

// maak de database-verbinding
$mysqli = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
