<?php
/**
 * Created by PhpStorm.
 * User: zico_
 * Date: 30-5-2018
 * Time: 16:31
 */

function code_generator($length)
{
    //maak een sting met alles karakters niet je wilt gebruiken
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //een string om de code in op te slaan
    $code = '';
    //een for loop die random karakters uit de characters string haalt en in code zet
    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, strlen($characters))];
    }
    return $code;
}

?>