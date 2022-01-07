<?php
    session_start();
    include '../../inc/incfiles/dblink.php';

    if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
        $type = $_SESSION['type'];
        if($type != "admin"){
            header('location: projects.php');
        }
    }

    $xml = new DomDocument("1.0", "UTF-8");
    $xml->preserveWhiteSpace = false;
    $xml->load("projects.xml");
    $projects = $xml->getElementsByTagName('project');


    $idnum = 0;

    foreach($projects as $project){
        $idnum++;
    };

    if(isset($_POST['newbutton'])){
        $target_dir = "imgproject/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

        if(!$xml){
            $projects = $xml->createElement("projects");
            $xml->appendChild($projects);
        } else {
            $projects = $xml->firstChild;
        }


        //$projectid = $idnum;
        $projectstatus = $_POST["projectstatus"];
        $projectvisibility = $_POST["projectvisibility"];

        $project = $xml->createElement("project");
        //$project->setAttribute("id", $projectid);
        $project->setAttribute("status", $projectstatus);
        $project->setAttribute("visibility", $projectvisibility);
        $projects->appendChild($project);


        $nameTag = $xml->createElement("name", $_POST["projectname"]);
        $project->appendChild($nameTag);

        $startTag = $xml->createElement("startdate", $_POST["projectstart"]);
        $project->appendChild($startTag);

        $endTag = $xml->createElement("enddate", $_POST["projectend"]);
        $project->appendChild($endTag);

        $requireTag = $xml->createElement("requirements", $_POST["projectrequirements"]);
        $project->appendChild($requireTag);

        $descriTag = $xml->createElement("description", $_POST["projectdescription"]);
        $project->appendChild($descriTag);

        $imageTag = $xml->createElement("image", $target_file);
        $project->appendChild($imageTag);

        $linkTag = $xml->createElement("link", $_POST["projectlink"]);
        $project->appendChild($linkTag);

        $authorTag = $xml->createElement("author", $_POST["projectauthor"]);
        $project->appendChild($authorTag);

        $xml->formatOutput = true;
        $xml->save('projects.xml');
        
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

    <title>Uuden projektin luonti</title>
</head>
<body class="bg-info bg-gradient">
    <div class="p-2">
        <h1 class="text-light">Projektien määrä: <?php echo $idnum; ?></h1>
        <a class="btn btn-secondary" href="projects.php">Projektit</a>
    </div>
    <div class="container d-flex align-items-center justify-content-center bg-light">
        
        <form class="col-md-8 bg-white" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="createform" id="createform">
            <h1>Luo uusi projekti</h1>
            <div class="form-group text-start">
                <label for="projectname" class="form-label">Projektin nimi: </label>
                <input type="text" class="form-control border-4" name="projectname" id="projectname" value="">
                <p id="nimiErr" class="input-error-msg"></p>
            </div>
            <div class="form-group text-start">
                <label for="projectstatus" class="form-label">Projektin tila: </label>
                <select name="projectstatus" id="projectstatus">
                    <option value="Aloittamaton">Ei aloitettu</option>
                    <option value="Keskeneräinen">Keskeneräinen</option>
                    <option value="Valmis">Valmis</option>
                </select>
            </div>
            <div class="form-group text-start">
                <label for="projectaccepted" class="form-label">Projektin näkyvyys: </label>
                <select name="projectvisibility" id="projectvisibility">
                    <option value="Piilotettu">Piilotettu</option>
                    <option value="Näkyvillä">Näkyvillä</option>
                </select>
            </div>
            <div class="form-group text-start">
                <label for="projectstart" class="form-label">Projektin aloituspäivä</label>
                <input type="text" class="form-control border-4" name="projectstart" value="" id="projectstart">
                <p id="startErr" class="input-error-msg"></p>
            </div>
            <div class="form-group text-start">
                <label for="projectend" class="form-label">Projektin valmistumispäivä</label>
                <input type="text" class="form-control border-4" name="projectend" value="" id="projectend">
                <p id="endErr" class="input-error-msg"></p>
            </div>
            <div class="form-group text-start">
                <label for="projectrequirements" class="form-label">Projektin vaatimukset</label>
                <textarea class="form-control border-4" name="projectrequirements" rows="3" cols="" id="projectrequirements"></textarea>
                <p id="reqErr" class="input-error-msg"></p>
            </div>
            <div class="form-group text-start">
                <label for="projectdescription" class="form-label">Projektin kuvaus</label>
                <textarea class="form-control border-4" name="projectdescription" rows="3" cols="" id="projectdescription"></textarea>
                <p id="desErr" class="input-error-msg"></p>
            </div>
            <div class="form-group text-start">
                <label for="fileToUpload" class="form-label">Lataa kuva projektista</label>
                <input type="file" name="fileToUpload" id="fileToUpload">
            </div>
            <div class="form-group text-start">
                <label for="projectlink" class="form-label">Projektin linkki</label>
                <input type="text" class="form-control border-4" name="projectlink" value="" id="projectlink">
                <p id="linErr" class="input-error-msg"></p>
            </div>
            <div class="form-group text-start">
                <label for="projectauthor" class="form-label">Projektin tekijä</label>
                <input type="text" class="form-control border-4" name="projectauthor" value="" id="projectauthor">
                <p id="autErr" class="input-error-msg"></p>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="newbutton" value="Tallenna">
            </div>
        </form>
    </div>
<footer class="bg-dark container-fluid text-center text-light p-3 mt-4">
    <h3>Ota yhteyttä!</h3>
    <h4><strong>Sähköposti</strong>: patrik.laamanen911@gmail.com</h4>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js" integrity="sha256-hlKLmzaRlE8SCJC1Kw8zoUbU8BxA+8kR3gseuKfMjxA=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
$(document).ready(function() {
    
    const $nimi = $("#projectname");
    const $startdate = $("#projectstart");
    const $enddate = $("#projectend");
    const $requirements = $("#projectrequirements");
    const $description = $("#projectdescription");
    const $link = $("#projectlink");
    const $author = $("#projectauthor");

    const $nimiErr = $("#nimiErr");
    const $startErr = $("#startErr");
    const $endErr = $("#endErr");
    const $reqErr = $("#reqErr");
    const $descErr = $("#desErr");
    const $linkErr = $("#linErr");
    const $autErr = $("#autErr");

    $('#createform').on('submit', function(e){
        let nimi = $nimi.val();
        let startdate = $startdate.val();
        let enddate = $enddate.val();
        let requirements = $requirements.val();
        let description = $description.val();
        let link = $link.val();
        let author = $author.val();


        $nimiErr.text("");
        $startErr.text("");
        $endErr.text("");
        $reqErr.text("");
        $descErr.text("");
        $linkErr.text("");
        $autErr.text("");

        $nimi.removeClass("error-input");
        $startdate.removeClass("error-input");
        $enddate.removeClass("error-input");
        $requirements.removeClass("error-input");
        $description.removeClass("error-input");
        $link.removeClass("error-input");
        $author.removeClass("error-input");

        if(checkStr(nimi)){
            e.preventDefault();
            $nimi.addClass("error-input");
            $nimiErr.text("Nimi on pakollinen!");
        }
        if(checkStr(startdate)){
            e.preventDefault();
            $startdate.addClass("error-input");
            $startErr.text("Aloituspäivä on pakollinen!");
        }
        if(checkStr(enddate)){
            e.preventDefault();
            $enddate.addClass("error-input");
            $endErr.text("Valmistumispäivä on pakollinen!");
        }
        if(checkStr(requirements)){
            e.preventDefault();
            $requirements.addClass("error-input");
            $reqErr.text("Vaatimukset ovat pakollisia!");
        }
        if(checkStr(description)){
            e.preventDefault();
            $description.addClass("error-input");
            $descErr.text("Kuvaus on pakollinen!");
        }
        if(checkStr(link)){
            e.preventDefault();
            $link.addClass("error-input");
            $linkErr.text("Linkki on pakollinen!");
        }
        if(checkStr(author)){
            e.preventDefault();
            $author.addClass("error-input");
            $autErr.text("Tekijä on pakollinen!");
        }

    });

    function checkStr(str){
        if(str == ''){
            return true;
        }else{
            return false;
        }
    }


    if (window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
});

</script>
</body>
</html>