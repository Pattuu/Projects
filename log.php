<?php
    session_start();
    if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
        header('location: index.php');
    } else {
        include 'inc/incfiles/server.php';
    }

    require_once "inc/incfiles/startFile.php"
?>
 <title>Kirjaudu sisään</title>
</head>
<body id="user-body">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark align-items-center justify-content-center">
            <a href="index.php" class="btn btn-primary btn-lg">Takaisin etusivulle</a>
        </nav>
    </header>
    <div class="container d-flex align-items-center justify-content-center" style="height: 85vh;">
        <div id="login-form" class="col-md-6">
            <form id="reg-user" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <h2 class="text-center">Kirjaudu sisään</h2>
                <h5 id ="wrong-error" class="input-error-msg"><?php echo $wrongError ? $wrongMsg : ''; ?></h5>
                <div class="form-group">
                    <label>Käyttäjänimi</label>
                    <input type="text" class="form-control <?php echo $userError ? 'error-input' : ''; ?>" name="username" id="username" placeholder="Käyttäjänimi" value="<?php if(isset($_POST['username'])){echo $_POST['username'];}; ?>">
                    <p id="username-error" class="input-error-msg"><?php echo $userError ? $userMsg : ''; ?></p>
                </div>
                <div class="form-group">
                    <label>Salasana</label>
                    <input type="password" class="form-control <?php echo $passwordError ? 'error-input' : ''; ?>" name="pswd" id="password" placeholder="Salasana" value="<?php if(isset($_POST['pswd'])){echo $_POST['pswd'];}; ?>">
                    <p id="pswd-error" class="input-error-msg"><?php echo $passwordError ? $passwordMsg : ''; ?></p>
                </div>
                <div class="d-grid">
                    <input type="submit" name="login-user" class="btn btn-primary" value="Kirjaudu sisään">
                </div>
                <br>
                <p>Eikö sinulla ole vielä käyttäjää? <span><a href="log.php">Siirry rekisteröitymiseen</a></p>
            </form>
        </div>
    </div>
<?php require_once "inc/incfiles/scripts.php"; ?>
<script>


$(document).ready(function() {
    const $username = $("#username");
    const $pswd = $("#password");

    const $usernameError = $("#username-error");
    const $pswdError = $("#pswd-error");
    const $wrongError = $("#wrong-error")

    $('#login-form').on('submit', function(e){
        $username.removeClass("error-input");
        $pswd.removeClass("error-input");

        let usernameError = '';
        let pswdError = '';
        $usernameError.text('');
        $pswdError.text('');
        $wrongError.text('');

        let username = tidyString($username.val());
        username = username.trim()
        let pswd = $pswd.val().trim();
        if(username == ''){
            e.preventDefault();
            $username.addClass("error-input");
            usernameError = "Käyttäjänimi on pakollinen!";
            $usernameError.text(usernameError);
            
        }else if(username.length < 5){
            e.preventDefault();
            $username.addClass("error-input");
            usernameError = "Käyttäjänimessä on oltava vähintään 5 merkkiä!";
            $usernameError.text(usernameError);
        }

        if(pswd == ''){
            e.preventDefault();
            $pswd.addClass("error-input");
            pswdError = "Salasana on pakollinen!";
            $pswdError.text(pswdError);
        }else if(pswd.length < 5){
            e.preventDefault();
            $pswd.addClass("error-input");
            pswdError = "Salasanassa on oltava vähintään 5 merkkiä!";
            $pswdError.text(pswdError);
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
