<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 24-5-2018
 * Time: 12:18
 */

//include alle benodigde files
include_once('../config.php');
include_once ('../assets/php/code_generator.php');

//haal alle gegevens uit het formulier

$naam = $_POST['naam'];
$email = $_POST['email'];
$password = $_POST['password'];
$confPassword = $_POST['confirmPassword'];

if(isset($_POST['avgCheck']))
{
    $avgCheck = $_POST['avgCheck'];
}
else
{
    $avgCheck = "off";
}


//zorg ervoor dat er geen sql injections of html code in de string staat
$naam = $mysqli->real_escape_string($naam);
$email = $mysqli->real_escape_string($email);
$password = $mysqli->real_escape_string($password);
$confPassword = $mysqli->real_escape_string($confPassword);

//maak een verificatie code aan
$verifiedCode = code_generator(10);

$status = "";

//variable voor de email
$subject = "Bevestig uw email";
$message =
    '<html>
        <head>
            <title>Email bevestigen</title>
        </head>
        <body>
            <p>Druk op de onderstaande link om je email de te rifiëren.</p><br/>
            <a href="localhost/email_veriefied.php?email=' . $email . '&code=' . $verifiedCode . '">Email verifiëren</a>       
        </body>
     </html>
    ';

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <briefjesboord@test.nl>' . "\r\n";



if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

}
else
{
    //wachtwoord hashen
    $password = password_hash($password, PASSWORD_BCRYPT);

    if($avgCheck == "on")
    {
        $avgCheck = true;
    }
    else
    {
        $avgCheck = false;
    }

    //gebruiker in de database zetten
    if($mysqli->query('INSERT INTO Gebruiker VALUES(NULL, "'. $naam .'", "'.$password .'", "' .  $email  . '", "'.$avgCheck. '", "' . $verifiedCode . '", false ,false)'))

    {
        $status = "gelukt";

        //mail($email, $subject, $message, $headers);

    }
    else
    {
        print_r($mysqli->error);
        $status = "Neem contact op met de beheerder";
    }
}
?>
<html>
    <head>
        <?php
            include("../template/header.php");
        ?>
    </head>
    <body>
        <div class="container-fluid pl-0 pr-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <?php
                include('../template/nav.php');
                ?>
            </nav>

            <h1><?php echo $status ?></h1>
            <h1><?php echo $verifiedCode ?></h1>

            <?php
                if($status == "gelukt")
                {
                    ?>
                    <h3>Er is een email gestuurd waar je je email moet bevestiggen.</h3>
                    <a href="email_veriefied.php?email=<?php echo $email; ?>&code=<?php echo $verifiedCode; ?>">Email verifiëren</a>
                    <?php
                }
            ?>
        </div>
    </body>
</html>
