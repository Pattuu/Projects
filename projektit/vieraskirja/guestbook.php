<?php
    session_start();
    if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
        $type = $_SESSION['type'];
    }else{
        $type = "member";
    }
    include '../../inc/incfiles/dblink.php';

    $nameError = false;
    $emailError = false;
    $messageError = false;
    $emptyEmail = false;

    $nameErrorMsg = '';
    $emailErrorMsg = '';
    $messageErrorMsg = '';
    $yritetty = false;


    if(isset($_POST['submit'])){
        $yritetty = true;
        date_default_timezone_set('Europe/Tallinn');
        $time = date("d-m-Y");
    
        $thanks = '';

        $name = mysqli_real_escape_string($link, $_POST['name']);
        $email = mysqli_real_escape_string($link, $_POST['email']);
        $message = mysqli_real_escape_string($link, $_POST['message']);
        $name = htmlspecialchars($name);
        $email = htmlspecialchars($email);
        $message = htmlspecialchars($message);

        $name = trim($name);
        $email = trim($email);
        $message = trim($message);


        $nameError = false;
        $emailError = false;
        $messageError = false;
        $emptyEmail = false;
        if(checkName($name) == "ok"){

        }else{
            $nameError = true;
            $nameErrorMsg = checkName($name);
        }

        if(empty($email)){
            $emailError = false;
            $emptyEmail = true;
        }else if(checkEmail($email) == "Sähköpostiosoite ei ole oikea!"){
            $emailError = true;
            $emailErrorMsg = "Sähköpostiosoite ei ole oikea!";
        }

        if(checkMessage($message) == "ok"){

        }else{
            $messageError = true;
            $messageErrorMsg = checkMessage($message);
        }
    
        if($nameError || $emailError || $messageError){

        }else{
            if(!$emptyEmail){
                $sql = "INSERT INTO guestbook (name, time, message, email) VALUES (?, ?, ?, ?)";
                if ($stmt = mysqli_prepare($link, $sql)){
                    mysqli_stmt_bind_param($stmt, "ssss", $name, $time, $message, $email);
    
                    if(mysqli_stmt_execute($stmt)){
                        $thanks = "Kiitos viestistäsi!";
                        $_POST['name'] = '';
                        $_POST['email'] = '';
                        $_POST['message'] = '';
                        $name = '';
                        $email = '';
                        $message = '';
                    } else{
                        $thanks = "ERROR: Could not execute query: $sql. " . mysqli_error($link);
                    }
                } else{
                    $thanks = "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
                }
            } else {
                $email = "NULL";
                $sql = "INSERT INTO guestbook (name, time, message, email) VALUES (?, ?, ?, ?)";
                if ($stmt = mysqli_prepare($link, $sql)){
                    mysqli_stmt_bind_param($stmt, "ssss", $name, $time, $message, $email);
                    if(mysqli_stmt_execute($stmt)){
                        $thanks = "Kiitos viestistäsi!";
                        $_POST['name'] = '';
                        $_POST['email'] = '';
                        $_POST['message'] = '';
                        $name = '';
                        $email = '';
                        $message = '';
                    } else{
                        $thanks = "ERROR: Could not execute query: $sql. " . mysqli_error($link);
                    }
                } else{
                    $thanks = "ERROR: Could not prepare query: $sql. " . mysqli_error($link);

                }
            }
        }
    }

    function checkName($string){

        if(strlen($string) < 3){
            return "Nimen tulee olla vähintään 3 merkkiä pitkä!";
        }else if(strlen($string) > 30){
            return "Nimi on liian pitkä! > 30";
        }else{
            return "ok";
        }
    }
    
    function checkMessage($string){
        if(strlen($string) < 8){
            return "Viestin tulee olla vähintään 8 merkkiä pitkä!";
        }else if(strlen($string) > 300){
            return "Viesti on liian pitkä! > 300";
        }else{
            return "ok";
        }
    }
    
    function checkEmail($string){
        $string = filter_var($string, FILTER_SANITIZE_EMAIL);
        if(!filter_var($string, FILTER_VALIDATE_EMAIL)){
            return "Sähköpostiosoite ei ole oikea!";
        }else{
            return $string;
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <link href="../../inc/img/favicon2.png" rel="icon">

        <?php //$stylePath = $_SERVER['DOCUMENT_ROOT'];
            //$stylePath .= "/Projects/inc/css/style.css"; ?>
        <!--<link type="text/css" rel="stylesheet" href="<?php// echo $stylePath; ?>">-->
        <link type="text/css" rel="stylesheet" href="../../inc/css/style.css">

        <link type="text/css" rel="stylesheet" href="../css/styles.css">
        <link type="text/css" rel="stylesheet" href="../css/reset.css">
        <title>Vieraskirja</title>
</head>
<body class="bg-info bg-gradient">
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../index.php"><h2 class="text-warning">Patrik Laamanen</h2></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mob-navbar" aria-label="Toggle">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mob-navbar">
                <ul class="navbar-nav mb-2 mb-lg-0 mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../../index.php">Etusivu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Vieraskirja</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Projektini</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../pelikone/slotmachine.php">Pelikone</a></li>
                            <li><a class="dropdown-item" href="../sikanoppa/pigdice.php">Sikanoppa</a></li>
                            <li><a class="dropdown-item" href="../projects/projects.php">Projektien tallennus</a></li>
                            <li><a class="dropdown-item" href="../chatti/livechat.php">Chatti</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://patriklaamanen.com">CV</a>
                    </li>
                </ul>
                <?php if(isset($_SESSION['logged']) && $_SESSION['logged'] == true): ?>
                    <div class="d-flex">
                        <h3 class="me-3 text-info">Hei <?php echo $_SESSION['username']; ?>!</h3>
                        <a class="btn btn-danger" href="inc/incfiles/logout.php" role="button">Kirjaudu ulos</a>
                    </div>
                <?php else: ?>
                    <form class="d-flex">                    
                        <a class="btn btn-primary" href="../../reg.php" role="button">Rekisteröidy</a>
                        <a class="btn btn-primary ms-1" href="../../log.php" role="button">Kirjaudu</a>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>
    <div class="bg-dark bg-gradient text-light pb-3">
        <h2 class="">Vieraskirja</h2>
        <p class="">Tämän sivun tein, kun harjoittelin tietojen tallentamista tietokantaan ja tiedon hakemista tietokannasta sekä sen tiedon esittämistä käyttäjän käyttöliittymässä.</p>
        <div class="form-div mt-5">
            <div class="text-center">
                    <button id="formControl" class="btn btn-primary">Laita viesti vieraskirjaan</button>
            </div>
            <form id="vieras-form" class="contact-form text-light border border-primary border-2 p-3" style="display: none;" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <label class="form-label" for="name">Nimi*:</label><br>
                    <?php if($_SESSION['logged'] == TRUE): ?>
                    <input type="text" name="name" class="form-control <?php echo $nameError ? 'error-input' : ''; ?>" id="name" value="<?php echo $yritetty ? $_POST['name'] : $_SESSION['username']; ?>">
                    <?php else: ?>
                    <input type="text" class="form-control <?php echo $nameError ? 'error-input' : ''; ?>" name="name" id="name" value="">
                    <?php endif; ?>
                    <p id="nimiError" class="input-error-msg"><?php echo $nameError ? $nameErrorMsg : ''; ?></p>
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Sähköposti:</label><span>(Ei pakollinen)</span>
                    <input type="text" name="email" class="form-control <?php echo $emailError ? 'error-input' : ''; ?>" id="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}; ?>">
                    <p id="emailError" class="input-error-msg"><?php echo $emailError ? $emailErrorMsg : ''; ?></p>
                </div>
                <div class="form-group">
                    <label class="form-label" for="message">Viesti*:</label>
                    <textarea name="message" rows="3" cols="" id="message" class="form-control <?php echo $messageError ? 'error-input' : ''; ?>"><?php if(isset($_POST['message'])){echo $_POST['message'];}; ?></textarea>
                    <p id="messageError" class="input-error-msg"><?php echo $messageError ? $messageErrorMsg : ''; ?></p>
                </div>
                <div class="d-grid">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div> 
    </div>      
    <section class="guestbookMsg" style="min-height: 65vh;">
        <?php
            $sql = "SELECT * FROM guestbook;";
            $result = mysqli_query($link, $sql);
            $resultCheck = mysqli_num_rows($result);

            if ($resultCheck > 0):
                while ($row = mysqli_fetch_assoc($result)): ?>
                        <div class="card m-3" style="width: 28vw;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo $row['time']; ?></h6>
                                <p class="card-text"><?php echo $row['message']; ?></p>
                            </div>
                            <div class="card-footer">
                                <a class="btn btn-danger" href="deleteguestbook.php?id=<?php echo $row['id']; ?>">Poista</a>
                            </div>
                        </div>
                <?php endwhile; ?>
            <?php endif; ?>
    </section>

<footer class="bg-dark container-fluid text-center text-light mt-4 p-3">
    <h3>Ota yhteyttä!</h3>
    <h4><strong>Sähköposti</strong>: patrik.laamanen911@gmail.com</h4>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js" integrity="sha256-hlKLmzaRlE8SCJC1Kw8zoUbU8BxA+8kR3gseuKfMjxA=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
$(document).ready(function() {
    
    const $nimi = $("#name");
    const $email = $("#email");
    const $message = $("#message");

    const $nimiError = $("#nimiError");
    const $emailError = $("#emailError");
    const $msgError = $("#messageError");

    $('#vieras-form').on('submit', function(e){
        $nimi.removeClass("error-input");
        $email.removeClass("error-input");
        $message.removeClass("error-input");

        $nimiError.text("");
        $emailError.text("");
        $msgError.text("");

        let nimi = $nimi.val();
        let email = $email.val();
        let message = $message.val();
        nimi = nimi.trim();
        email = email.trim();
        message = message.trim();
        if(nimi.length < 3){
            e.preventDefault();
            $nimi.addClass("error-input");
            $nimiError.text("Nimen tulee olla vähintään 3 merkkiä pitkä!");
        }
        if(message.length < 8){
            e.preventDefault();
            $message.addClass("error-input");
            $msgError.text("Viestin tulee olla vähintään 8 merkkiä pitkä!");
        }
    });

    $("#formControl").on("click", function(){
        $("#vieras-form").slideToggle();
    })


    if (window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
});

</script>
</body>
</html>