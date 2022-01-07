<?php
    session_start();
    include '../../inc/incfiles/dblink.php';
    $xml = simpleXML_load_file('projects.xml');
    $projects = $xml->project;

    if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
        $type = $_SESSION['type'];
        if($type != "admin"){
            header('location: projects.php');
        }
    }
    
    $idnum = 0;

    foreach($projects as $project){
        $idnum++;
    };


    if(!isset($_GET['x'])){
        header('location: projects.php');
    } else {
        $x = intval($_GET['x']);
    }

    if(isset($_POST['deleteyes'])){

        if(file_exists($projects[$x]->image)){
            unlink($projects[$x]->image);
        }

        $doc = new DomDocument("1.0", "UTF-8");
        $doc->preserveWhiteSpace = false;
        $doc->load("projects.xml");

        $delete = $doc->getElementsByTagName('project')->item($x);
        echo $x;
        $projects = $doc->documentElement;
        $projects->removeChild($delete);

        $doc->formatOutput = true;
        $doc->save('projects.xml');
        

        header('location: projects.php');
    }

    if(isset($_POST['deleteno'])){
        header('location: projects.php');
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name=”viewport” content=”width=device-width, initial-scale=1″>
    <link type="text/css" rel="stylesheet" href="../css/styles.css">
    <link type="text/css" rel="stylesheet" href="../css/reset.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="../../inc/img/favicon2.png" rel="icon">

    <?php //$stylePath = $_SERVER['DOCUMENT_ROOT'];
        //$stylePath .= "/Projects/inc/css/style.css"; ?>
    <!--<link type="text/css" rel="stylesheet" href="<?php// echo $stylePath; ?>">-->
    <link type="text/css" rel="stylesheet" href="../../inc/css/style.css">

    <title>Projektin poisto</title>
</head>
<body class="bg-info bg-gradient">
    <h1 class="text-light">Projektien määrä: <?php echo $idnum; ?></h1>
    <a class="btn btn-secondary" href="projects.php">Projektit</a>
    <section class="project p-4">
        <h1 class="">Poista tämä projekti</h1>
        <div class="projectheader">
            <h1 class="projecttitle"><?php echo $projects[$x]->name; ?></h1>
            <?php if($projects[$x]['status'] == 'Keskeneräinen'): ?>
            <h3 class="projecttimes">Aloituspäivä: <?php echo $projects[$x]->startdate; ?>
            <?php elseif($projects[$x]['status'] == 'Valmis'): ?>
            <h3 class="projecttimes">Aika: <?php echo $projects[$x]->startdate . '-' . $projects[$x]->enddate; ?></h3>
            <?php endif; ?>
        </div>
        <div class="projectbody">
            <h2 class="projectsub">Vaatimukset</h2>
            <p class="projectP"><?php echo $projects[$x]->requirements; ?></p>
            <h2 class="projectsub">Kuvaus</h2>
            <p class="projectP"><?php echo $projects[$x]->description; ?></p>
            <img class="projectimg" src="<?php echo $projects[$x]->image; ?>" width="600" height="100%">
            <p class="projectlink"><a href=""></a></p>
            <p class="projectauthor">Tekijä: <?php echo $projects[$x]->author; ?></p>
        </div>
        <form name="deleteform" action="<?php echo "deleteproject.php?x=$x" ?>" method="POST">
            <h3>Oletko varma, että haluat poistaa tämän projektin?</h3>
            <input type="submit" name="deleteyes" class="btn btn-danger" value="Kyllä"><input type="submit" name="deleteno" value="En" class="btn btn-secondary ms-1">
        </form>
    </section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js" integrity="sha256-hlKLmzaRlE8SCJC1Kw8zoUbU8BxA+8kR3gseuKfMjxA=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</body>
</html>