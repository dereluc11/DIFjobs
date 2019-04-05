<?php
/**
 * Created by PhpStorm.
 * User: lucsers
 * Date: 1-6-2018
 * Time: 15:38
 */
session_start();

if(session_destroy())
{
    header("location: home.php");
}