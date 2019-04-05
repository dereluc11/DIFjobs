<!--Modal voor de login-->
<div class="modal fade" id="loginPopup" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <form role="loginform" id="loginform" method="POST" action="../POST/login.php">
                    <div class="form-group">
                        <label for="usrname"><span class="glyphicon glyphicon-user"></span> Email</label>
                        <input type="email" class="form-control" id="loginEmail" name="loginEmail"
                               placeholder="voer email in" required>
                        <small id="loginEmailError" class="redLetters">Dit emailadres is niet bekend of je hebt je account niet geverifieerd.</small>
                    </div>

                    <div class="form-group">
                        <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Wachtwoord</label>
                        <input type="password" class="form-control" id="loginWachtwoord" name="loginWachtwoord"
                               placeholder="voer wachtwoord in" autocomplete="off" required>
                        <small id="loginPasswordError" class="redLetters">Dit wachtwoord is incorrect</small>
                    </div>
                    <button onclick="submitForm();" type="button" class="btn btn-primary">Inloggen</button>
                </form>
            </div>
            <div class="modal-footer">
                Wachtwoord vergeten? <a class="btn btn-link" href="../pages/wachtwoord_reset.php">Klik dan hier.</a>
            </div>
        </div>
    </div>
</div>

<script>
    //variables
    var checkEmailDone = false;
    var checkPasswordDone = false;

    //alles uitvoeren als het document geladen is
    $("#loginEmailError").hide();
    $("#loginPasswordError").hide();


    //input velden checken
    function submitForm() {

        $("#loginEmailError").hide();
        $("#loginPasswordError").hide();


        if (checkEmailDone !== true || checkPasswordDone !== true) {


            //wachtwoorden vergelijken
            if ($("#loginWachtwoord").val().length > 0) {
                checkPasswordDone = true;
            }
            else {
                $("#loginPasswordError").show();
                checkPasswordDone = false;
            }


            //bestaat de email al
                $.post("../POST/email_check.php", {
                        email: $("#loginEmail").val()
                    },
                    function (result) {
                        if (result == 1) {
                            $("#loginEmailError").hide();
                            checkEmailDone = true;

                            if (checkEmailDone === true && checkPasswordDone === true) {
                                $("#loginform").submit();
                            }
                        }
                        else {
                            $("#loginEmailError").show();
                            checkEmailDone = false;
                        }

                    });




        }


    }
</script>