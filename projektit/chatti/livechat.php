<?php
session_start();
    if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
        $type2 = $_SESSION['type'];
    }else{
        $type2 = "member";
    }
    include '../../inc/incfiles/dblink.php';


if(isset($_POST['guest'])){
    $_SESSION['adminChecked'] = 0;
    header('location: chatroom.php?x=guest');
}

if(isset($_POST['admin'])){
    if(!empty($_POST['passu'])){
        $sql = "SELECT * FROM chatpswd";
        $result = mysqli_query($link, $sql);
        $pswd = mysqli_fetch_assoc($result);
        $testpswd = implode('', $pswd);

        checkPswd($_POST['passu'], $link);

        if($_POST['passu'] == $testpswd){
            $_SESSION['adminChecked'] = 1;
            header('location: chatroom.php?x=admin');
        } else {
            // WRONG PASSWORD
        }
    }
}

function checkPswd($string, $conn){
    $string = htmlspecialchars($string);
    $string = mysqli_real_escape_string($conn, $string);
    return $string;
}

?>
<!DOCTYPE html>
<html lang="en" class="h-100">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
        <title>Aula</title>
    </head>
    <body class="bg-dark text-light">
    <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-gradient">
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
                        <a class="nav-link active" aria-current="page" href="#">Chatti</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Projektini</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../pelikone/slotmachine.php">Pelikone</a></li>
                            <li><a class="dropdown-item" href="../sikanoppa/pigdice.php">Sikanoppa</a></li>
                            <li><a class="dropdown-item" href="../projects/projects.php">Projektien tallennus</a></li>
                            <li><a class="dropdown-item" href="../vieraskirja/guestbook.php">Vieraskirja</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">CV</a>
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
<div class="text-light">
    <div class="">
        <div class="page-header mb-5 mt-3">
            <h1 class="">Chatin aula</h1>
            <p>Tämän projektin tarkoituksena oli opetella vain tietyn kohdan päivittämistä sivulta. Lisäksi päivittämisen tulisi olla automaattista.
                Samalla sain lisäharjoitusta tietokannan kanssa toimimiseen.
            </p>
        </div>
        <div class="container d-flex justify-content-center align-items-center text-center">
            <form class="col-md-6" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <label for="guest">Kirjaudu vieraana</label>
                    <input class="btn btn-success" name="guest" type="submit" value="Vieras">
                </div>
                <div class="input-group">
                    <label for="passu">Admin</label>
                    <input type="text" name="passu" class="form-control ms-2" placeholder="Salasana" aria-label="" aria-describedby="basic-addon1">
                    <div class="input-group-append">
                        <input class="btn btn-success" id="admin" name="admin" type="submit" value="Sisään">
                    </div>
                    <p id="salasanaError" class="input-error-msg"></p>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js" integrity="sha256-hlKLmzaRlE8SCJC1Kw8zoUbU8BxA+8kR3gseuKfMjxA=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

</body>
</html>