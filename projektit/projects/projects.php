<?php
    session_start();
    if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
        $type = $_SESSION['type'];
    }else{
        $type = "member";
    }
    include '../../inc/incfiles/dblink.php';
    $xml = simpleXML_load_file('projects.xml');
    $projects = $xml->project;
    

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
        <title>Projektien tallennus</title>
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
                        <a class="nav-link active" aria-current="page" href="#">Projektien tallennus</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Projektini</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../pelikone/slotmachine.php">Pelikone</a></li>
                            <li><a class="dropdown-item" href="../sikanoppa/pigdice.php">Sikanoppa</a></li>
                            <li><a class="dropdown-item" href="../vieraskirja/guestbook.php">Vieraskirja</a></li>
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
        <h2 class="projectstitle">Projektien tallennus</h2>
        <p>Tein tämän sivun opetellessani XML-tiedostoon tallentamista ja sieltä tiedon hakemista sivulle. Admin-oikeudet omaava käyttäjä voi luoda, muokata ja poistaa projekteja.
             Kaikki projektit ja niiden tiedot tallennetaan xml-tiedostoon. Admin voi myös ladata palvelimelle kuvan projektista.
        <?php if($type == 'admin'): ?>
        <br><a class="btn btn-primary mt-2" href="newproject.php">Create new</a>
        <?php endif; ?>
    </div>
    <div style="min-height:75vh;">
        <?php $editIndex = 0; ?>
        <?php $deleteIndex = 0; ?>
        <?php foreach($projects as $project): ?>
        <?php if($project['visibility'] == 'visible' || $type == 'admin'): ?>
        <section class="project p-4">
            <div class="projectheader">
                <h1 class="projecttitle"><?php echo $project->name; ?></h1>
                <?php if($type == 'admin'): ?>
                <div class="adminInfo">
                    <h4 class="m-2">Admin tiedot:</h4>
                    <h5 class="m-2">Projektin näkyvyys: <?php echo $project['visibility']; ?></h5>
                    <h5 class="m-2">Project tila: <?php echo $project['status']; ?></h5>
                </div>
                <?php endif; ?>
                <?php if($project['status'] == 'wip'): ?>
                <h3 class="projecttimes m-2">Aloituspäivä: <?php echo $project->startdate; ?>
                <?php elseif($project['status'] == 'done'): ?>
                <h3 class="projecttimes m-2"><?php echo $project->startdate . '-' . $project->enddate; ?></h3>
                <?php else: ?>
                <h3 class="projecttimes m-2">Ei ole aloitettu</h3>
                <?php endif; ?>
            </div>
            <div class="projectbody">
                <h2 class="projectsub m-2">Vaatimukset</h2>
                <p class="projectP m-2"><?php echo $project->requirements; ?></p>
                <h2 class="projectsub m-2">Kuvaus</h2>
                <p class="projectP m-2"><?php echo $project->description; ?></p>
                <img class="projectimg m-2" src="<?php echo $project->image; ?>" width="600" height="100%">
                <p class="projectauthor m-2">Tekijä: <?php echo $project->author; ?></p>
                <a class="btn btn-primary" href="<?php echo $project->link; ?>">Linkki projektiin</a>
                <?php if($type == 'admin'): ?>
                <a class="btn btn-info" href="editproject.php?i=<?php echo $editIndex++; ?>">Muokkaa</a><a class="btn btn-danger ms-1" href="deleteproject.php?x=<?php echo $deleteIndex++; ?>">Poista</a>
                <?php endif; ?>
            </div>
        </section>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>

<footer class="bg-dark container-fluid text-center text-light mt-4 p-3">
    <h3>Ota yhteyttä!</h3>
    <h4><strong>Sähköposti</strong>: patrik.laamanen911@gmail.com</h4>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js" integrity="sha256-hlKLmzaRlE8SCJC1Kw8zoUbU8BxA+8kR3gseuKfMjxA=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


</body>
</html>
