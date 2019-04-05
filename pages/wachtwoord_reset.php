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
            <!--Email invullen form-->
            <form name="passwordResetForm">
                <div class="form-group">
                    <label for="emailInput">Vul hier je email adres in.</label>
                    <input id="emailInput" type="email" class="form-control" required>
                </div>
                <button class="btn btn-primary" onclick="resetPassword();" type="button">Submit</button>
            </form>
            <h3 id="reactie"></h3>
        </div>
    </div>

</div>
<script>
    function resetPassword()
    {
        //email uit de input halen
        var email = $('#emailInput').val();

        //maak een post naar de email check om te checken of de email wel bestaat
        $.post("../POST/email_check.php", {
                email: email
            },
            function (result)
            {
                //als de email bestaat vraag dan een nieuw wachtwoord aan.
                if (result == 1) {
                    $.post('../POST/password_reset.php',{
                            email: email
                        },
                        function (result2) {
                            $('#reactie').html(result2);
                        });

                }
                else {
                    $('#reactie').html('Deze email bestaat niet in onze database.');
                }

            });
    }
</script>
</body>
</html>

