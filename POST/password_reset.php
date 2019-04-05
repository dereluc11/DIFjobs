<?php
/**
 * Created by PhpStorm.
 * User: zico_
 * Date: 13-6-2018
 * Time: 12:08
 */

include_once('../config.php');
include_once ('../assets/php/code_generator.php');

//check of er een get aanwezig is
if(!isset($_GET['email']))
{
    //haal alle gegevens uit de post
    $email = $_POST['email'];
    $email = $mysqli->real_escape_string($email);


    $verifiedCode = code_generator(10);

//variable voor de email
    $subject = "Wachtwoord resetten";
    $message =
        '<html>
        <head>
            <title>Email bevestigen</title>
        </head>
        <body>
            <p>Druk op de onderstaande link om je email de te rifiëren.</p><br/>
            <a href="localhost/password_reset.php?email=' . $email . '&code=' . $verifiedCode . '">Email verifiëren</a>       
        </body>
     </html>
    ';

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <briefjesboord@test.nl>' . "\r\n";

    //check of het een email is
    if(filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        if($mysqli->query("UPDATE gebruiker SET verifiedCode = '$verifiedCode' WHERE email = '$email'"))
        {
            echo 'Er is een email gestuurd met een link <a href="../POST/password_reset.php?email=' . $email . '&code=' . $verifiedCode . '">Wachtwoord aanpassen</a> ';

        }
        else
        {
            echo "Er is iets fout gegaan. Neem contact op met de beheerder";
        }
    }
}
else
{

    $email = $_GET['email'];
    $code = $_GET['code'];
    $gebruiker = $mysqli->query("SELECT ID FROM gebruiker WHERE Email = '$email' AND verifiedCode = '$code'");
    $gebruikerID = $gebruiker->fetch_object()->ID;
    if($gebruiker->num_rows > 0) {
        ?>

        <!DOCTYPE html>
        <html lang="nl">
        <head>
            <?php
            session_start();
            include("../template/header.php")
            ?>
        </head>

        <body>
        <nav class="navbar navbar-expand-lg bg-dark">
            <?php
            include('../template/nav.php')
            ?>
        </nav>

        <div class="container-fluid">
            <div class="row mt-sm-4 ml-sm-2 mr-sm-2">
                <div class="col-lg-12">
                    <h1>Wachtwoord Resetten</h1>
                    <hr/>
                </div>
            </div>

            <div class="row ml-sm-2 mr-sm-2">
                <div class="col-lg-12">
                    <h3 id="errorReset" class="redLetters">Er is iets fout gegaan. Neem contact op met de
                        beheerder.</h3>
                    <h3 id="succesReset" class="greenLetters">Het is gelukt om je wachtwoord te
                        veranderen.</h3>
                    <form name="newPasswordForm">
                        <div class="form-group">
                            <label for="passwordReset">Vul hier je nieuwe wachtwoord in.</label>
                            <input id="passwordReset" type="password" class="form-control" placeholder="Wachtwoord"
                                   required>
                            <input id="ID" type="hidden" value="<?php echo $gebruikerID; ?>">
                        </div>

                        <div class="form-group">
                            <label for="passwordReset2">Herhaal Wachtwoord</label>
                            <input type="password" class="form-control" id="passwordReset2" placeholder="Wachtwoord"
                                   required>
                            <small id="passwordError" class="redLetters">Het wachtwoord is niet
                                hetzelfde.
                            </small>
                        </div>
                        <button class="btn btn-primary" type="button" onclick="resetPassword();">Submit</button>
                    </form>
                    <h3 id="reactie"></h3>
                </div>
            </div>

        </div>
        <script>
            //alles uitvoeren als het document geladen is
            $(document).ready(function(){
                $("#errorReset").hide();
                $("#succesReset").hide();
                $("#passwordError").hide();
            });

            function resetPassword() {
                //wachtwoorden vergelijken
                if ($("#passwordReset").val() !== $("#passwordReset2").val() || $("#passwordReset").val().length <= 0 || $("#passwordReset2").val().length <= 0) {
                    $("#passwordError").show();
                }
                else {
                    //maak een post naar de verwerkpagina
                    $.post("../POST/updateUserData.php?type=password", {
                            pass: $("#passwordReset").val(),
                            ID: $("#ID").val()
                        },
                        function (result) {
                            if (result == 1) {
                                $('#succesReset').show();
                            }
                            else {

                                $('#errorReset').show();
                            }

                        });
                }
            }
        </script>
        </body>
        </html>

        <?php
    }
}
?>

