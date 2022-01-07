<?php
    session_start();
    if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
        header('location: index.php');
    } else {
        include 'inc/incfiles/server.php';
    }





    require_once "inc/incfiles/startFile.php"
?>
 <title>Rekisteröidy</title>
</head>
<body id="user-body">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark align-items-center justify-content-center">
            <a class="btn btn-primary btn-lg" href="index.php" role="button">Takaisin etusivulle</a>
        </nav>
    </header>
    <div class="container d-flex align-items-center justify-content-center" style="height: 85vh;">
        <div id="reg-form" class="col-md-6">
            <form id="reg-user" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <h2 class="text-center">Rekisteröidy</h2>
                <div class="form-group">
                    <label>Käyttäjänimi</label>
                    <input type="text" class="form-control <?php echo $userError ? 'error-input' : ''; ?>" name="username" id="username" placeholder="Käyttäjänimi" value="<?php if(isset($_POST['username'])){echo $_POST['username'];}; ?>">
                    <p id="username-error" class="input-error-msg"><?php echo $userError ? $userMsg : ''; ?></p>
                </div>
                <div class="form-group">
                    <label>Sähköposti (Ei pakollinen)</label>
                    <input type="text" class="form-control <?php echo $emailErr ? 'error-input' : ''; ?>" name="email" id="email" placeholder="Sähköposti" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}; ?>">
                    <p id="email-error" class="input-error-msg"><?php echo $emailErr ? $emailError : ''; ?></p>
                </div>
                <div class="form-group">
                    <label>Salasana</label>
                    <input type="password" class="form-control <?php echo $passwordError ? 'error-input' : ''; ?>" name="pswd" id="password" placeholder="Salasana" value="<?php if(isset($_POST['pswd'])){echo $_POST['pswd'];}; ?>">
                    <p id="pswd-error" class="input-error-msg"><?php echo $passwordError ? $passwordMsg : ''; ?></p>
                </div>
                <div class="form-group">
                    <label>Salasana uudelleen</label>
                    <input type="password" class="form-control <?php echo $passwordMatch ? 'error-input' : ''; ?>" name="pswd2" id="password2" placeholder="Salasana uudelleen" value="<?php if(isset($_POST['pswd2'])){echo $_POST['pswd2'];}; ?>">
                    <p id="pswd2-error" class="input-error-msg"><?php echo $passwordMatch ? $password2Msg : ''; ?></p>
                </div>
                <div class="d-grid">
                    <input type="submit" name="register-user" class="btn btn-primary" value="Rekisteröidy">
                </div>
                <br>
                <p>Onko sinulla jo käyttäjä? <span><a href="log.php">Kirjaudu sisään</a></p>
            </form>
        </div>
    </div>
<?php require_once "inc/incfiles/scripts.php"; ?>
<script>


$(document).ready(function() {
    const $username = $("#username");
    const $email = $("#email");
    const $pswd = $("#password");
    const $pswd2 = $("#password2");

    const $usernameError = $("#username-error");
    const $emailError = $("#email-error");
    const $pswdError = $("#pswd-error");
    const $pswd2Error = $("#pswd2-error");





    $('#reg-form').on('submit', function(e){
        $username.removeClass("error-input");
        $email.removeClass("error-input");
        $pswd.removeClass("error-input");
        $pswd2.removeClass("error-input");
        let usernameError = '';
        let emailError = '';
        let pswdError = '';
        let pswd2Error = '';
        $usernameError.text('');
        $pswdError.text('');
        $pswd2Error.text('');
        $emailError.text('');



        let username = tidyString($username.val());
        username = username.trim();
        let pswd = $pswd.val().trim();
        let pswd2 = $pswd2.val().trim();
        if(username != $username.val()){
            e.preventDefault();
            $username.addClass("error-input");
            usernameError = "Käyttäjänimi saa sisältää vain kirjaimia ja numeroita!";
            $usernameError.text(usernameError);
        }else if(username == ''){
            e.preventDefault();
            $username.addClass("error-input");
            usernameError = "Käyttäjänimi on pakollinen!";
            $usernameError.text(usernameError);
            
        }else if($username.val().length < 5){
            e.preventDefault();
            $username.addClass("error-input");
            usernameError = "Käyttäjänimessä on oltava vähintään 5 merkkiä!";
            $usernameError.text(usernameError);
        }

        if($pswd.val() == ''){
            e.preventDefault();
            $pswd.addClass("error-input");
            pswdError = "Salasana on pakollinen!";
            $pswdError.text(pswdError);
        }else if($pswd.val().length < 5){
            e.preventDefault();
            $pswd.addClass("error-input");
            pswdError = "Salasanassa on oltava vähintään 5 merkkiä!";
            $pswdError.text(pswdError);
        }

        if($pswd.val() != $pswd2.val()){
            e.preventDefault();
            $pswd2.addClass("error-input");
            pswd2Error = "Salasanat eivät täsmää!";
            $pswd2Error.text(pswd2Error);
        }
    });


    function tidyString(str){
        return str.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');
    }



    if (window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
});

</script>
</body>
</html>